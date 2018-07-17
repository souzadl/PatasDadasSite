<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends CI_Model {	

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
	
	function numAcessos ()
	{		
		$this->db->select('*')->from('logs_acessos');
		
		return $this->db->count_all_results();
	}
	
	function numAcoes ()
	{		
		$this->db->select('*')->from('logs_acoes');
		
		return $this->db->count_all_results();
	}	
	
	function getAcessos ($offset = 0)
	{		
		$this->db->flush_cache();

		if($offset)
		{
			
		}
		else {
			$offset = 0;
		}			
		
		$sql = "SELECT *
				FROM logs_acessos a, usuarios b
				WHERE a.id_usuario = b.id_usuario
				ORDER BY a.data_hora DESC
				LIMIT $offset, 20
				";		
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function getAcoes ($offset = 0)
	{		
		$this->db->flush_cache();

		if($offset)
		{
			
		}
		else {
			$offset = 0;
		}			
		
		$sql = "SELECT *
				FROM logs_acoes a, usuarios b
				WHERE a.id_usuario = b.id_usuario
				ORDER BY a.data_hora DESC
				LIMIT $offset, 20
				";		
		
		$query = $this->db->query($sql);		
		return $query->result();
	}

	function buscaAcoes ($keyword)
	{		
		$this->db->flush_cache();		
		
		$sql = "SELECT *
				FROM logs_acoes a, usuarios b
				WHERE a.id_usuario = b.id_usuario
				AND b.nome LIKE '%$keyword%'
				ORDER BY a.data_hora DESC
				LIMIT 20
				";		
		
		$query = $this->db->query($sql);		
		return $query->result();
	}	
	
	function buscaAcessos ($keyword)
	{		
		$this->db->flush_cache();		
		
		$sql = "SELECT *
				FROM logs_acessos a, usuarios b
				WHERE a.id_usuario = b.id_usuario
				AND b.nome LIKE '%$keyword%'
				ORDER BY a.data_hora DESC
				LIMIT 20
				";		
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function inserirLogAcesso ($id_usuario)
	{
		$data = array (
			'data_hora'  	=> date('Y-m-d H:i:s'),
			'id_usuario'    => $id_usuario,
			'ip'			=> $this->input->ip_address()
		);
		
		$this->db->set($data)->insert('logs_acessos');
		return $this->db->insert_id();
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
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */