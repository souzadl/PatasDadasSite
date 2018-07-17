<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pontos_model extends CI_Model {	

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
	
	function numPontos ()
	{
		$this->db->select('*')->from('pontos');
		
		return $this->db->count_all_results();
	}
	
	function getPontos ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('pontos')->order_by('ponto', 'asc');
		
		return $this->db->get();
	}
	
	function getPonto ($id_ponto)
	{		
		$where = array ('id_ponto' => $id_ponto);		
		$this->db->select('*')->from('pontos')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setPonto ($data, $id_ponto = "")
	{
		if ($id_ponto)
		{
			$where = array ('id_ponto' => $id_ponto);
			$this->db->select('*')->from('pontos')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{	
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_ponto', $id_ponto);
                $this->db->update('pontos');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "pontos";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_ponto;
		}
		else
		{
			$this->db->set($data)->insert('pontos');
			$this->session->set_flashdata('resposta', 'Ponto de coleta adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "pontos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delPonto ($id_ponto)
	{		
		$where = array ('id_ponto' => $id_ponto);
		$this->db->select('*')->from('pontos')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
					
            $this->db->where('id_ponto', $id_ponto);
            $this->db->delete('pontos');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "pontos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Ponto de coleta excluído com sucesso (:');            
		}
	}
		
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_ponto', $id);
        $this->db->update('pontos');
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */