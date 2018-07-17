<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {
	
	public function index($var = "")
	{
		$this->load->model('Produtos_model', 'model');
		
		$data = array (
			'titulo'		=> "Lojinha - Patas Dadas",
			'description'	=> "Conheça nossos produtos de Cãolidade e nos ajude!",
			'keywords'		=> "lojinha, produtos, caolidade, compre",
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-04.png",
			
			'page'			=> 'lojinha',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'destaques'		=> $this->model->getDestaques(),
			'categorias'	=> $this->model->getCategorias()
		);
		
		$this->load->view('produtos/produtos', $data);
	}
	
	public function buscaGeneros ()
	{
		$this->load->model('Produtos_model', 'model');
		
		$tamanho = $this->input->post('tamanho');
		$id_produto = $this->input->post('id_produto');
		
		$data = array (
			'generos'		=> $this->model->getGeneros($tamanho, $id_produto)
		);
		
		$this->load->view('produtos/ajax.generos.php', $data);
	}
	
	public function checkEstoque () 
	{
		$this->load->model('Produtos_model', 'model');
		
		$tamanho 		= $this->input->post('tamanho');
		$id_produto 	= $this->input->post('id_produto');
		$genero			= $this->input->post('genero');
		
		$checar_estoque = $this->model->checkEstoque($id_produto, $tamanho, $genero);
		
		echo $checar_estoque->estoque;
	}
	
	public function visualizar ($categoria, $produto, $id)
	{
		$this->load->model('Produtos_model', 'model');
		
		$produto = $this->model->getProduto($id);
		
		$data = array (
			'titulo'		=> "$produto->titulo - Lojinha - Patas Dadas",
			'description'	=> "$produto->descricao",
			'keywords'		=> "$produto->titulo, lojinha, produtos, caolidade, compre",
			'imageog'		=> base_url()."assets/uploads/produtos/".$produto->imagem,
			
			'page'			=> 'lojinha',
			'pageloja'		=> 'interna',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'tamanhos'		=> $this->model->getTamanhos($id),
    		'produto'		=> $this->model->getProduto($id),
    		'fotos'			=> $this->model->getFotos($id),
    		'outros'		=> $this->model->getOutros($id),
    		
    		'destaques'		=> $this->model->getDestaques(),
			'categorias'	=> $this->model->getCategorias()
		);
		
		$this->load->view('produtos/produtos.visualizar.php', $data);
	}
	
	function adicionar_produto ()
	{
		$this->load->model('Produtos_model', 'model');
			
		$produto = $this->model->getProduto($this->input->post('id_produto'));
		$data = array(
		        'id'      => $produto->id_produto,
		        'qty'     => $this->input->post('quantidade'),
		        'price'   => $produto->valor,
		        'name'    => "$produto->titulo",
		        'img'	  => $produto->imagem,
		        'genero'  => $this->input->post('genero')
		);
		
		$cart_products 							= $this->session->userdata('cart_products');
		$cart_products[$produto->id_produto] 	= $data;
		
/*
				echo "<pre>";
		print_r($cart_products);
		echo "</pre>";
		exit;
*/
		
		$this->session->set_userdata('cart_products', $cart_products);
		
		redirect('lojinha/carrinho-de-compras');
	}
	
	function remover_produto ($id)
	{
		$this->load->model('Produtos_model', 'model');
		
		unset($_SESSION['cart_products'][$id]);
		
		redirect('lojinha/carrinho-de-compras');
	}
	
	public function carrinho ()
	{
		$this->load->model('Produtos_model', 'model');
		$this->load->library('cart');
		
		$data = array (
			'titulo'		=> "Sua sacola - Lojinha - Patas Dadas",
			'description'	=> "Compre os produtos da sua sacola agora :)",
			'keywords'		=> "sacola, lojinha, produtos, caolidade, compre",
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-04.png",
			
			'page'			=> 'lojinha',
			'pageloja'		=> 'interna',
			'conteudo'		=> $this->model->getConteudo(1),
    		
    		'destaques'		=> $this->model->getDestaques(),
			'categorias'	=> $this->model->getCategorias()
		);
		
		$this->load->view('produtos/carrinho.php', $data);
	}
	
	public function fechar_pedido()
	{
		$this->load->model('Produtos_model', 'model');
		
		$urlReturn = site_url()."lojinha/pedido-realizado";
		
/*
				echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		exit;
*/
		
		$dataPedido = array (
			'data_alteracao'			=> date("Y-m-d H:i:s"),
			'data_pedido'				=> date("Y-m-d H:i:s"),
			'valor_total'				=> $this->input->post('total'),
			'status'					=> 'waiting'
		);
		$idPedido = $this->model->setPedido($dataPedido);
		
		$dataCurl =  array (
				'email' 			=> "engel.laureen@gmail.com",
				'token'				=> "3A641C47DFF542E6A26974069E5DF5E6",
				'currency'			=> "BRL"
		);
		
		$countItem = 0;
		foreach ($_POST['itens'] as $item)
		{
			$countItem++;
			$dataItens = array (
				'data_alteracao'			=> date("Y-m-d H:i:s"),
				'id_pedido'					=> $idPedido,
				'id_produto'				=> $item['Id'],
				'id_produto_estoque'		=> $item['Genero'],
				'valor'						=> $item['Amount'],
				'quantidade'				=> $item['Quantity']
			);
			$this->model->setItensPedido($dataItens);
			$produto = $this->model->getProduto($item['Id']);
			$dataCurl += array (
				"itemId$countItem"				=> $item['Id']."-".$item['Genero'],
				"itemDescription$countItem"		=> $item['Description'],
				"itemAmount$countItem"			=> $item['Amount'],
				"itemQuantity$countItem"		=> $item['Quantity'],
				"itemWeight$countItem"			=> $produto->peso
			);
		}
		$dataCurl += array ('reference'			=> 'pedido-'.$idPedido);
		$dataCurl += array ('redirectURL'		=> $urlReturn);

		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'application/x-www-form-urlencoded',
                                            'charset=utf-8'
                                            ));
                                       
		curl_setopt($ch, CURLOPT_URL,"https://ws.pagseguro.uol.com.br/v2/checkout");
		curl_setopt($ch, CURLOPT_POST, 3);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            http_build_query($dataCurl));
		
		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$server_output = curl_exec ($ch);
		
		curl_close ($ch);
		
		$xml = simplexml_load_string($server_output);
		
		if(count($xml->error) > 0) {
			print_r($xml);	
		}
		else
		{
			$this->model->updatePedido($idPedido, $xml->code);
			$this->session->sess_destroy();
			header("Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=".$xml->code);
		}
	}
}