<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {	

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
	
	function numUsuarios ()
	{
		$this->db->select('*')->from('usuarios');
		
		return $this->db->count_all_results();
	}
	
	function getUsuarios ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('usuarios')->order_by('nome', 'asc')->limit(20, $offset);
		
		return $this->db->get();
	}
	
	function buscaUsuarios ($keyword)
	{
		$id_usuario = $this->encrypt->decode($this->session->userdata('mailing_id_usuario'));
		
		$this->db->select('*')->from('usuarios')->like('nome', $keyword)->or_like('email', $keyword);
		
		return $this->db->get();
	}
	
	function getUsuario ($id_usuario)
	{		
		$where = array ('id_usuario' => $id_usuario);		
		$this->db->select('*')->from('usuarios')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setUsuario ($data, $id_usuario = "")
	{
		if ($id_usuario)
		{
			$where = array ('id_usuario' => $id_usuario);
			$this->db->select('*')->from('usuarios')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_usuario', $id_usuario);
                $this->db->update('usuarios');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "usuarios";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso                 
			}
			
			return $id_usuario;
		}
		else
		{
			$this->db->set($data)->insert('usuarios');
			
			$this->session->set_flashdata('resposta', 'Usuário adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "usuarios";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delUsuario ($id_usuario)
	{		
		$where = array ('id_usuario' => $id_usuario);
		$this->db->select('*')->from('usuarios')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
            $this->db->where('id_usuario', $id_usuario);
            $this->db->delete('usuarios');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "usuarios";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso             
		}
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */