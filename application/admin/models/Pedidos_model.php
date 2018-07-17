<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model {	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getPermissoes()
	{
		$this->db->flush_cache();		
		
		$id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));		
		$sql = "SELECT *
				FROM permissoes
				WHERE id_usuario = $id_usuario
			   ";		
		
		$query = $this->db->query($sql);		
		return $query->result();		
	}
	
	function inserirLogAcoes ($tabela, $acao, $sql)
	{
		$id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));
		
		$data = array (
			'data_hora'  	=> date('Y-m-d H:i:s'),
			'id_usuario'    => $id_usuario,
			'tabela'    	=> $tabela,
			'acao'    		=> $acao,
			'sql'    		=> $sql,
			'ip'			=> $this->input->ip_address()
		);
		
		$this->db->set($data)->insert('logs_acoes');
		return $this->db->insert_id();
	}

	//=======================================================================
	//Outras Funções=========================================================
	//=======================================================================	
	
	
	
	function numPedidos ()
	{
		$this->db->select('*')->from('pedidos');
		
		return $this->db->count_all_results();
	}
	
	function getPedidos ($offset = 0)
	{		
		$this->db->flush_cache();
		
		$sql = "SELECT *
				FROM pedidos
				ORDER BY data_alteracao DESC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function getItens ($id_pedido)
	{		
		$this->db->flush_cache();
		
		$sql = "SELECT *, pt.valor as ValorNoPedido
				FROM pedidos p, pedidos_itens pt, produtos pr, produtos_estoque pe
				WHERE p.id_pedido = pt.id_pedido
				AND pt.id_produto = pr.id_produto
				AND pt.id_produto_estoque = pe.id_produto_estoque
				AND pt.id_pedido = $id_pedido
				ORDER BY pr.titulo ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function getPedido ($id_pedido)
	{		
		$this->db->flush_cache();
		
		$sql = "SELECT *
				FROM pedidos
				WHERE id_pedido = $id_pedido
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */