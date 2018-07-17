<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parceiros_model extends CI_Model {	

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
	
	function numParceiros ()
	{
		$this->db->select('*')->from('parceiros');
		
		return $this->db->count_all_results();
	}
	
	function getParceiros ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('parceiros')->order_by('nome', 'asc');
		
		return $this->db->get();
	}
	
	function getParceiro ($id_parceiro)
	{		
		$where = array ('id_parceiro' => $id_parceiro);		
		$this->db->select('*')->from('parceiros')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setParceiro ($data, $id_parceiro = "")
	{
		if ($id_parceiro)
		{
			$where = array ('id_parceiro' => $id_parceiro);
			$this->db->select('*')->from('parceiros')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->load->library('image_lib');
				$this->load->library('upload');	
				
				$upload = "";
				//=====================================================================
				//INICIO UPLOAD CAPA
				//=====================================================================
				$config['upload_path']		= './assets/uploads/parceiros';
		        $config['allowed_types']	= 'gif|jpg|png|bmp';
		        $config['max_size']			= '10000';
		        $config['max_width']		= '6000';
		        $config['max_height']		= '6000';
		        $config['encrypt_name']     = TRUE;
		  
		      	$this->upload->initialize($config);
		        
		        if ($this->upload->do_upload('logo'))
		        {
		        	$imagem = $this->getParceiro($id_parceiro);
		        	if($imagem->logo)
					{
						unlink('./assets/uploads/parceiros/' . $imagem->logo);
					}
		        	$file_data = $this->upload->data();
					
			        $file_name = $file_data['file_name'];
			        $file_size = $file_data['file_size'];
			        
			        //chmod ($file_data['full_path'], 777);
			        
			       //echo $file_data['full_path'];
			      // exit;
			        
			        //ZOOM
			        $configR['image_library'] 	= 'GD2';
					$configR['source_image']	= $file_data['full_path'];
					$configR['create_thumb']    = FALSE;
					$configR['maintain_ratio']	= TRUE;
					$configR['new_image']		= $file_data['full_path'];
					$configR['width']			= 800;
					$configR['height']			= 650;
					$configR['quality']			= 100;
					
					
					$this->image_lib->initialize($configR);
					
					if (!$this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();   
					}
					
					
					$this->db->set('logo', $file_name);
					
				}
		        //=====================================================================
				//FIM UPLOAD DA CAPA
				//=====================================================================			
				
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_parceiro', $id_parceiro);
                $this->db->update('parceiros');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "parceiros";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_parceiro;
		}
		else
		{
			$this->load->library('image_lib');
			$this->load->library('upload');	
			
			$upload = "";
			//=====================================================================
			//INICIO UPLOAD CAPA
			//=====================================================================
			$config['upload_path']		= './assets/uploads/parceiros';
	        $config['allowed_types']	= 'gif|jpg|png|bmp';
	        $config['max_size']			= '10000';
	        $config['max_width']		= '6000';
	        $config['max_height']		= '6000';
	        $config['encrypt_name']     = TRUE;
	        
	      	$this->upload->initialize($config);
	        if ($this->upload->do_upload('logo'))
	        {
	        	$imagem = $this->getParceiro($id_parceiro);
	        	if($imagem->logo)
				{
					unlink('./assets/uploads/parceiros/' . $imagem->logo);
				}
	        	$file_data = $this->upload->data();
				
		        $file_name = $file_data['file_name'];
		        $file_size = $file_data['file_size'];
		        
		        //ZOOM
		        $configR['image_library'] 	= 'GD2';
				$configR['create_thumb']    = FALSE;
				$configR['source_image']	= $file_data['full_path'];
				$configR['maintain_ratio']	= TRUE;
				$configR['new_image']		= $file_data['full_path'];
				$configR['width']			= 800;
				$configR['height']			= 650;
				$configR['quality']			= 100;
				
				$this->image_lib->initialize($configR);
				$this->image_lib->resize();        
				
				$this->db->set('logo', $file_name);
			}
	        //=====================================================================
			//FIM UPLOAD DA CAPA
			//=====================================================================	
			$this->db->set($data)->insert('parceiros');
			
			$this->session->set_flashdata('resposta', 'Parceiro adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "parceiros";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delParceiro ($id_parceiro)
	{		
		$where = array ('id_parceiro' => $id_parceiro);
		$this->db->select('*')->from('parceiros')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
			$imagem = $this->getParceiro($id_parceiro);
        	if($imagem->logo)
			{
				unlink('./assets/uploads/parceiros/' . $imagem->logo);
			}
					
            $this->db->where('id_parceiro', $id_parceiro);
            $this->db->delete('parceiros');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "parceiros";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Parceiro excluído com sucesso (:');            
		}
	}
		
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_parceiro', $id);
        $this->db->update('parceiros');
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */