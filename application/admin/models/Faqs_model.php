<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs_model extends CI_Model {	

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
	
	function numFaqs ()
	{
		$this->db->select('*')->from('faqs');
		
		return $this->db->count_all_results();
	}
	
	function getFaqs ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('faqs')->order_by('pergunta', 'asc');
		
		return $this->db->get();
	}
	
	function getFaq ($id_faq)
	{		
		$where = array ('id_faq' => $id_faq);		
		$this->db->select('*')->from('faqs')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setFaq ($data, $id_faq = "")
	{
		if ($id_faq)
		{
			$where = array ('id_faq' => $id_faq);
			$this->db->select('*')->from('faqs')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{	
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_faq', $id_faq);
                $this->db->update('faqs');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "faqs";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_faq;
		}
		else
		{
			$this->db->set($data)->insert('faqs');
			$this->session->set_flashdata('resposta', 'Perguntas e Respostas adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "faqs";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delFaq ($id_faq)
	{		
		$where = array ('id_faq' => $id_faq);
		$this->db->select('*')->from('faqs')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
					
            $this->db->where('id_faq', $id_faq);
            $this->db->delete('faqs');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "faqs";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Perguntas e Respostas excluída com sucesso (:');            
		}
	}
		
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_faq', $id);
        $this->db->update('faqs');
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */