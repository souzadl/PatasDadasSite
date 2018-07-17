<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model {	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getConteudo ($id)
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM conteudos
				WHERE id_conteudo = $id
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	function getTamanhos ($id)
	{
		$this->db->cache_off();
		
		$sql = "SELECT pe.id_produto_estoque, pe.id_produto, pe.tamanho
				FROM produtos_estoque pe, produtos p
				WHERE pe.id_produto = p.id_produto
				AND pe.estoque >0
				AND pe.id_produto = $id
				GROUP BY pe.tamanho
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function checkEstoque ($id_produto, $tamanho, $genero) 
	{
		$this->db->cache_off();
		
		$sql = "SELECT pe.estoque, pe.id_produto
				FROM produtos_estoque pe, produtos p
				WHERE pe.id_produto = p.id_produto
				AND pe.id_produto =$id_produto
				AND pe.tamanho = '$tamanho'
				AND pe.genero = '$genero'
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();
	}
	
	public function getDestaques ()
	{		
		$this->db->cache_off();
		$this->db->select('*')->from('produtos')->join('produtos_categorias', 'produtos.id_produto_categoria = produtos_categorias.id_produto_categoria')->where('produtos.destaque', 'S')->where('produtos.ativo', 'S');
		
		$query = $this->db->get();			
		return $query->result();
	}

	public function getProduto ($id)
	{		
		$this->db->cache_off();
		$this->db->select('*')->from('produtos')->join('produtos_categorias', 'produtos.id_produto_categoria = produtos_categorias.id_produto_categoria')->where('produtos.id_produto', $id)->where('produtos.ativo', 'S');
		
		$query = $this->db->get();			
		return $query->row();
	}
	
	public function getOutros ($id)
	{		
		$this->db->cache_off();
		$this->db->select('*')->from('produtos')->join('produtos_categorias', 'produtos.id_produto_categoria = produtos_categorias.id_produto_categoria')->where('produtos.id_produto !=', $id)->where('produtos.ativo', 'S')->order_by('produtos.titulo', 'RANDOM')->limit(4);
		
		$query = $this->db->get();			
		return $query->result();
	}
	
	public function getGeneros ($tamanho, $id_produto)
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM produtos_estoque
				WHERE 
					tamanho = '$tamanho'
				AND id_produto = $id_produto
				ORDER BY genero ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();			
	}

	public function getCategorias ()
	{		
		$this->db->cache_off();
		$this->db->select('*')->from('produtos_categorias')->join('produtos', 'produtos.id_produto_categoria = produtos_categorias.id_produto_categoria')->join('produtos_estoque', 'produtos.id_produto = produtos_estoque.id_produto')->where('produtos.ativo','S')->where('produtos_estoque.estoque >','0')->group_by('produtos_categorias.id_produto_categoria');;
		
		$query = $this->db->get();
		return $query->result();
		
	}
	
	function getProdutosCategorias ($id_produto_categoria)
	{
		$this->db->cache_off();
		$this->db->select('*')->from('produtos')->join('produtos_categorias', 'produtos.id_produto_categoria = produtos_categorias.id_produto_categoria')->where('produtos.id_produto_categoria', $id_produto_categoria)->where('produtos.ativo', 'S');
		
		$query = $this->db->get();			
		return $query->result();
	}
	
	function getFotos ($id)
	{
		$this->db->flush_cache();
		$sql = "SELECT *
				FROM produtos_galerias
				WHERE 
					id_produto = $id
				ORDER BY RAND()
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();		
	}
	
	function setPedido($dataPedido)
	{
		$this->db->set($dataPedido)->insert('pedidos');
		return $this->db->insert_id();
	}
	
	function setItensPedido($dataItens)
	{
		$this->db->set($dataItens)->insert('pedidos_itens');
		return $this->db->insert_id();
	}
	
	function updatePedido ($idPedido, $code)
	{
		$this->db->set('id_pagseguro', $code)->where('id_pedido', $idPedido)->update('pedidos');
		return $this->db->insert_id();
	}
	
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/welcome_model.php */