<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/produtos/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('produtos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os produtos',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'produtos'  	=> $this->model->getProdutos($offset)
		);
		
		$this->load->view('produtos/produtos.php', $data);
	}
	
	function cadastro()
	{
		$this->load->model('produtos_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes(),
			'categorias'  	=> $this->model->getProdutosCategorias()
		);

		$this->load->view('produtos/produtos.cadastro.php', $data);
	}
	
	function editar ($id_produto = 0)
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'produto' 			=> $this->model->getProduto($id_produto),
				'categorias'  		=> $this->model->getProdutosCategorias(),
				'fotos' 			=> $this->model->getFotos($id_produto),
				'estoques'			=> $this->model->getEstoques($id_produto)
			);
			
			$this->load->view('produtos/produtos.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('produtos_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function salvar ()
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
				
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'id_produto_categoria'	=> $this->input->post('id_produto_categoria'),
				'titulo'				=> $this->input->post('titulo'),
				'descricao'				=> $this->input->post('descricao'),
				'valor'					=> $this->input->post('valor'),
				'ativo'					=> $this->input->post('ativo'),
				'destaque'				=> $this->input->post('destaque'),
				'peso'					=> (int)$this->input->post('peso')
			);
			
			$id = $this->model->setProduto($data, $this->input->post('id_produto'));
				
			if ($this->input->post('id_produto'))
				redirect('produtos/editar/' . $this->input->post('id_produto'));
			else
				redirect('produtos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_produto = 0)
	{
		$this->load->model('produtos_model', 'model');

		try
		{
			$this->model->delProduto($id_produto);
			redirect('produtos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvarImagem ()
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
			$insert_id = $this->model->setImagemProduto($this->input->post('id_produto'));
			
			if ($this->input->post('id_produto'))
				redirect('produtos/editar/' . $this->input->post('id_produto').'#ImagensAnchor');
			else
				redirect('produtos/lista/');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvarGaleria ()
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
			$produto = $this->model->getProduto($this->input->post('id_produto'));
			
			$insert_id = $this->model->setGaleriaProduto($this->input->post('id_produto'), $produto);
			
			if ($this->input->post('id_produto'))
				redirect('produtos/editar/' . $this->input->post('id_produto').'#FotosAnchor');
			else
				redirect('produtos/lista/');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function excluirFoto ($id_produto_foto, $id_produto)
	{
		$this->load->model('produtos_model', 'model');

		try
		{
			$this->model->delFoto($id_produto_foto);
			redirect("produtos/editar/$id_produto#FotosAnchor");
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	// categorias
	// ==========================================================================
	function listaCategorias ($offset = "")
	{
		$this->load->model('produtos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes(),
			'categorias'  	=> $this->model->getProdutosCategorias()
		);
		
		$this->load->view('produtos/categorias.php', $data);
	}
	
	function cadastroCategorias()
	{
		$this->load->model('produtos_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('produtos/categorias.cadastro.php', $data);
	}
	
	function editarCategorias ($id_produto_categoria = 0)
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'categoria' 		=> $this->model->getProdutoCategorias($id_produto_categoria)
			);
			
			$this->load->view('produtos/categorias.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvarCategorias ()
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'categoria'				=> $this->input->post('categoria')
			);
			
			$id = $this->model->setProdutoCategorias($data, $this->input->post('id_produto_categoria'));
				
			if ($this->input->post('id_produto_categoria'))
				redirect('produtos/editarCategorias/' . $this->input->post('id_produto_categoria'));
			else
				redirect('produtos/listaCategorias');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagarCategorias ($id_produto_categoria = 0)
	{
		$this->load->model('produtos_model', 'model');

		try
		{
			$this->model->delProdutoCategorias($id_produto_categoria);
			redirect('produtos/listaCategorias');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	// categorias
	// ==========================================================================
	
	function editarEstoque ($id_produto = 0, $id_produto_estoque)
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				
				'produto' 			=> $this->model->getProduto($id_produto),
				'categorias'  		=> $this->model->getProdutosCategorias(),
				'fotos' 			=> $this->model->getFotos($id_produto),
				'estoque' 			=> $this->model->getEstoque($id_produto_estoque),
				'estoques'			=> $this->model->getEstoques($id_produto)
			);
			
			$this->load->view('produtos/produtos.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvarEstoque ()
	{
		$this->load->model('produtos_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'id_produto'			=> $this->input->post('id_produto'),
				'tamanho'				=> $this->input->post('tamanho'),
				'genero'				=> $this->input->post('genero'),
				'estoque'				=> $this->input->post('estoque')
			);
			
			$id = $this->model->setEstoqueProduto($data, $this->input->post('id_produto_estoque'));
			
			redirect('produtos/editar/' . $this->input->post('id_produto').'#EstoquesAnchor');	
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagarEstoque ($id_produto, $id_produto_estoque)
	{
		$this->load->model('produtos_model', 'model');

		try
		{
			$this->model->delEstoque($id_produto_estoque);
			redirect("produtos/editar/$id_produto#EstoquesAnchor");
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Produtos.php */
/* Location: ./system/application/controllers/produtos.php */