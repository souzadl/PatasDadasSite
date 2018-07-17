<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apadrinhamentos_model extends CI_Model {	

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
	
	
	
	function numApadrinhamentos ()
	{
		$this->db->select('*')->from('apadrinhamentos');
		
		return $this->db->count_all_results();
	}
	
	function getApadrinhamentos ($offset = 0)
	{		
		$this->db->flush_cache();
		
		$sql = "SELECT *, an.nome as Animal, p.nome as Padrinho, a.data_alteracao as DataStatus
				FROM apadrinhamentos a, apadrinhamentos_tipos at, animais an, padrinhos p
				WHERE a.id_apadrinhamento_tipo = at.id_apadrinhamento_tipo
				AND a.id_animal = an.id_animal
				AND a.id_padrinho = p.id_padrinho
				ORDER BY a.data_alteracao DESC
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function getApadrinhamento ($id_apadrinhamento)
	{		
		$this->db->flush_cache();
		
		$sql = "SELECT *, an.nome as Animal, p.nome as Padrinho, a.data_alteracao as DataStatus
				FROM apadrinhamentos a, apadrinhamentos_tipos at, animais an, padrinhos p
				WHERE a.id_apadrinhamento_tipo = at.id_apadrinhamento_tipo
				AND a.id_animal = an.id_animal
				AND a.id_padrinho = p.id_padrinho
				AND a.id_apadrinhamento = $id_apadrinhamento
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */