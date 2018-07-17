<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoas_model extends CI_Model {	

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
	
	function numPessoas ()
	{
		$this->db->select('*')->from('pessoas');
		
		return $this->db->count_all_results();
	}
	
	function getPessoas ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('pessoas')->order_by('nome', 'asc');
		
		return $this->db->get();
	}
	
	function getPessoa ($id_pessoa)
	{		
		$where = array ('id_pessoa' => $id_pessoa);		
		$this->db->select('*')->from('pessoas')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setPessoa ($data, $id_pessoa = "")
	{
		if ($id_pessoa)
		{
			$where = array ('id_pessoa' => $id_pessoa);
			$this->db->select('*')->from('pessoas')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_pessoa', $id_pessoa);
                $this->db->update('pessoas');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "pessoas";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_pessoa;
		}
		else
		{
			$this->db->set($data)->insert('pessoas');
			
			$this->session->set_flashdata('resposta', 'Pessoa adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "pessoas";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delPessoa ($id_pessoa)
	{		
		$where = array ('id_pessoa' => $id_pessoa);
		$this->db->select('*')->from('pessoas')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
					
            $this->db->where('id_pessoa', $id_pessoa);
            $this->db->delete('pessoas');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "pessoas";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Pessoa excluído com sucesso (:');            
		}
	}
		
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_pessoa', $id);
        $this->db->update('pessoas');
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */