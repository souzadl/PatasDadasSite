<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	public function getAnimais ()
	{		
		$this->db->cache_off();
		$this->db->select('*')->from('animais')->where('condicao', 'DI')->order_by('nome', 'asc');
		
		return $this->db->get();
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
	
	function getEventos ()
	{
		$this->db->cache_off();		
		$hj = date("Y-m-d");
		$sql = "SELECT *
				FROM eventos
				WHERE 1=1
				AND data >= '$hj'
				ORDER BY data ASC, horario ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();		
	}
	
	function getParceiros ()
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM parceiros
				WHERE 1=1
				ORDER BY nome ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function getFaqs ()
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM faqs
				WHERE 1=1
				ORDER BY id_faq ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();		
	}
	
	function getPessoas ()
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM pessoas
				WHERE 1=1
				ORDER BY nome ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();	
	}
	
	function getMidias ()
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM midias
				WHERE 1=1
				ORDER BY data DESC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();	
	}
	
	function getPontosDeColeta ()
	{
		$this->db->cache_off();
		$sql = "SELECT *
				FROM pontos
				WHERE 1=1
				ORDER BY estado ASC, cidade ASC, ponto ASC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/welcome_model.php */