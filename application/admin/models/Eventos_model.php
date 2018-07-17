<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos_model extends CI_Model {	

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
	
	function numEventos ()
	{
		$this->db->select('*')->from('eventos');
		
		return $this->db->count_all_results();
	}
	
	function getEventos ($offset = 0)
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('eventos')->order_by('data', 'desc');
		
		return $this->db->get();
	}
	
	function getEvento ($id_evento)
	{		
		$where = array ('id_evento' => $id_evento);		
		$this->db->select('*')->from('eventos')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setEvento ($data, $id_evento = "")
	{
		if ($id_evento)
		{
			$where = array ('id_evento' => $id_evento);
			$this->db->select('*')->from('eventos')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->load->library('image_lib');
				$this->load->library('upload');	
				$this->load->library('utilidades');
				
				$upload = "";
				//=====================================================================
				//INICIO UPLOAD CAPA
				//=====================================================================
				$titleF 	= $this->utilidades->sanitize_title_with_dashes($data['evento']);
				$dt_hj 		= date("dmyHis");
				
				$config['upload_path']		= './assets/uploads/eventos';
		        $config['allowed_types']	= 'gif|jpg|png|bmp';
		        $config['max_size']			= '10000';
		        $config['max_width']		= '6000';
		        $config['max_height']		= '6000';
		        $config['encrypt_name']    	= FALSE;
		        $config['file_name'] 		= $titleF.'-'.$dt_hj;
		        $config['overwrite'] 		= FALSE;
		  
		      	$this->upload->initialize($config);
		        
		        if ($this->upload->do_upload('imagem'))
		        {
		        	$imagem = $this->getEvento($id_evento);
		        	if($imagem->imagem)
					{
						unlink('./assets/uploads/eventos/' . $imagem->imagem);
					}
		        	$file_data = $this->upload->data();
					
			        $file_name = $file_data['file_name'];
			        $file_size = $file_data['file_size'];
			        
			        // new file name
		        	$newfilename  = $titleF.'-'.$dt_hj.$file_data['file_ext'];
		        	// new file name
			        
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
					
					
					$this->db->set('imagem', $newfilename);
					
				}
		        //=====================================================================
				//FIM UPLOAD DA CAPA
				//=====================================================================			
				
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_evento', $id_evento);
                $this->db->update('eventos');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "eventos";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_evento;
		}
		else
		{
			$this->load->library('image_lib');
			$this->load->library('upload');	
			$this->load->library('utilidades');
			
			$upload = "";
			//=====================================================================
			//INICIO UPLOAD CAPA
			//=====================================================================
			
			$titleF 	= $this->utilidades->sanitize_title_with_dashes($data['evento']);
			$dt_hj 		= date("dmyHis");
				
			$config['upload_path']		= './assets/uploads/eventos';
	        $config['allowed_types']	= 'gif|jpg|png|bmp';
	        $config['max_size']			= '10000';
	        $config['max_width']		= '6000';
	        $config['max_height']		= '6000';
	        $config['encrypt_name']    	= FALSE;
		    $config['file_name'] 		= $titleF.'-'.$dt_hj;
		    $config['overwrite'] 		= FALSE;
	        
	      	$this->upload->initialize($config);
	        if ($this->upload->do_upload('imagem'))
	        {
	        	$file_data = $this->upload->data();
				
		        $file_name = $file_data['file_name'];
		        $file_size = $file_data['file_size'];
		        
		        // new file name
	        	$newfilename  = $titleF.'-'.$dt_hj.$file_data['file_ext'];
	        	// new file name
		        
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
				
				$this->db->set('imagem', $newfilename);
			}
	        //=====================================================================
			//FIM UPLOAD DA CAPA
			//=====================================================================	
			$this->db->set($data)->insert('eventos');
			
			$this->session->set_flashdata('resposta', 'Evento adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "eventos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delEvento ($id_evento)
	{		
		$where = array ('id_evento' => $id_evento);
		$this->db->select('*')->from('eventos')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
			$imagem = $this->getEvento($id_evento);
        	if($imagem->imagem)
			{
				unlink('./assets/uploads/eventos/' . $imagem->imagem);
			}
					
            $this->db->where('id_evento', $id_evento);
            $this->db->delete('eventos');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "eventos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Evento excluído com sucesso (:');            
		}
	}
		
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_evento', $id);
        $this->db->update('eventos');
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */