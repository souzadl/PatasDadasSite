<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notificacoes_model extends CI_Model {	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getPedido ($id)
	{
		$this->db->cache_off();
		
		$sql = "SELECT *
				FROM pedidos
				WHERE id_pedido = $id
			   ";
			   	
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	function getEstoque ($id)
	{
		$this->db->cache_off();

		$sql = "SELECT *
				FROM produtos_estoque
				WHERE id_produto_estoque = $id
			   ";

		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	function getApadrinhamento ($id)
	{
		$this->db->cache_off();

		$sql = "SELECT *
				FROM apadrinhamentos a, apadrinhamentos_tipos t
				WHERE a.id_apadrinhamento_tipo = t.id_apadrinhamento_tipo
				AND a.id_apadrinhamento = $id
			   ";
		
		$query = $this->db->query($sql);		
		return $query->row();	
	}
	
	function getPadrinho ($id)
	{
		$this->db->cache_off();
		
		$sql = "SELECT *
				FROM padrinhos
				WHERE id_padrinho = $id
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();	
	}
	
	function updatePedido ($id, $data2)
	{
		$this->db->set($data2)->where('id_pedido', $id)->update('pedidos');
	}
	
	function updateApadrinhamento ($id, $data2)
	{
		$this->db->set($data2)->where('id_apadrinhamento', $id)->update('apadrinhamentos');
	}
	
	function updateEstoque ($id, $estoque)
	{
		$this->db->set('estoque', $estoque)->where('id_produto_estoque', $id)->update('produtos_estoque');
	}
	
	function updateEstoqueAtualizado ($id_pedido)
	{
		$this->db->set('estoque_atualizado', 'S')->where('id_pedido', $id_pedido)->update('pedidos');
	}
	
	function updatePadrinho ($id_padrinho, $id_animal, $tipo)
	{
		if($tipo >= 1 || $tipo <= 5)
		{
			$tipo_sql = "padrinho_racao";
		}
		if ($tipo == 6)
		{
			$tipo_sql = "padrinho_castracao";
		}
		if ($tipo == 7)
		{
			$tipo_sql = "padrinho_vacinas";
		}
		if ($tipo == 8)
		{
			$tipo_sql = "padrinho_pulgas";
		}
		
		$this->db->set($tipo_sql, $id_padrinho)->where('id_animal', $id_animal)->update('animais');
	}
	
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/welcome_model.php */