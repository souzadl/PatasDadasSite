<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acessos_model extends CI_Model {	

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
	
	function numAcessos ()
	{		
		$this->db->select('*')->from('acessos_corretor');
		
		return $this->db->count_all_results();
	}
#-----------------------------------------------------------------------------------#
	function numAcessosBusca ($keyword)
	{		
		$sql = "SELECT *
				FROM acessos_corretor
				WHERE ip LIKE '%$keyword%'
				OR user_agent LIKE '%$keyword%'
				GROUP BY id_acesso_corretor
				ORDER BY data_acesso DESC
			   ";
		
		$this->db->query($sql);		
		
		return $this->db->count_all_results();
	}	
#-----------------------------------------------------------------------------------#
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
				FROM acessos_corretor
				ORDER BY data_acesso DESC
				LIMIT $offset, 20
			   ";
		
		
		$query = $this->db->query($sql);
		
		return $query->result();		
	}
	
	function getAcessoVisualizar ($id_acesso)
	{		
		$this->db->flush_cache();

		$sql = "SELECT *
				FROM acessos_corretor
				WHERE id_acesso_corretor = $id_acesso
			   ";
			
		$query = $this->db->query($sql);
		
		return $query->row();
	}
	
	function buscaAcessos ($keyword,$offset = 0)
	{
		
		$this->db->flush_cache();	
		if($offset)
		{
			
		}
		else {
			$offset = 0;
		}	
		$sql = "SELECT *
				FROM acessos_corretor
				WHERE ip LIKE '%$keyword%'
				OR user_agent LIKE '%$keyword%'
				GROUP BY id_acesso_corretor
				ORDER BY data_acesso DESC
				LIMIT $offset, 20				
			   ";
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function delAcesso ($id_acesso)
	{		
		$where = array ('id_acesso_corretor' => $id_acesso);
		$this->db->select('*')->from('acessos_corretor')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
            $this->db->where('id_acesso_corretor', $id_acesso);
            $this->db->delete('acessos_corretor');
            
            //Log Acesso
            	$acao 		= "delete";
            	$tabela 	= "acessos";
            	$sql 		= $this->db->last_query();
            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso              
		}
	}
}

/* End of file falecom_model.php */
/* Location: ./system/application/model/falecom_model.php */