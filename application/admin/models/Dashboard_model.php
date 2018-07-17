<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {	

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
	
	function totalAnimais ()
	{
		$this->db->select('*')->from('animais');
		return $this->db->count_all_results();
	}
	
	function totalAnimaisTipo ($tipo = "")
	{
		$this->db->select('*')->from('animais')->where('tipo', $tipo);
		return $this->db->count_all_results();
	}
	
	function getAnimaisCondicao ($condicao = "")
	{
		$this->db->flush_cache();
		$this->db->select('*')->from('animais')->where('condicao', $condicao)->order_by('nome', 'asc');
		
		return $this->db->count_all_results();
	}
	
	function getConteudo ($id)
	{
		$this->db->flush_cache();
		
		$sql = "SELECT *
				FROM conteudos
				WHERE id_conteudo = $id
			   ";	
		
		$query = $this->db->query($sql);		
		return $query->row();
	}
	
	function setConteudo ($data, $id_conteudo = "")
	{
		if ($id_conteudo)
		{
			$where = array ('id_conteudo' => $id_conteudo);
			$this->db->select('*')->from('conteudos')->where($where);
			
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
				$title 	= $this->utilidades->sanitize_title_with_dashes("quem-somos");
				$dt_hj 		= date("dmyHis");
				
				$config['upload_path']		= './assets/uploads/conteudos';
		        $config['allowed_types']	= 'gif|jpg|png|bmp';
		        $config['max_size']			= '10000';
		        $config['max_width']		= '6000';
		        $config['max_height']		= '6000';
		        $config['encrypt_name']    	= FALSE;
		        $config['file_name'] 		= $title.'-'.$dt_hj;
		        $config['overwrite'] 		= FALSE;
		  
		      	$this->upload->initialize($config);
		        
		        if ($this->upload->do_upload('imagem'))
		        {
		        	$imagem = $this->getConteudo($id_conteudo);
		        	if($imagem->imagem)
					{
						unlink('./assets/uploads/conteudos/' . $imagem->imagem);
					}
		        	$file_data = $this->upload->data();
					
			        $file_name = $file_data['file_name'];
			        $file_size = $file_data['file_size'];
			        
			        // new file name
			        
		        	$newfilename  = $title.'-'.$dt_hj.$file_data['file_ext'];
		        	// new file name
			        
			        //ZOOM
			        $configR['image_library'] 	= 'GD2';
					$configR['source_image']	= $file_data['full_path'];
					$configR['create_thumb']    = FALSE;
					$configR['maintain_ratio']	= TRUE;
					$configR['new_image']		= $file_data['full_path'];
					$configR['width']			= 800;
					$configR['height']			= 650;
					$configR['quality']			= 80;
					
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
				
				$upload = "";
				//=====================================================================
				//INICIO UPLOAD CAPA
				//=====================================================================
				$titleF 	= $this->utilidades->sanitize_title_with_dashes("prestacao-de-contas");
				$dt_hj 		= date("dmyHis");
				
				$configF['upload_path']		= './assets/uploads/conteudos';
		        $configF['allowed_types']	= 'pdf|doc|docx';
		        $configF['max_size']		= '10000';
		        $configF['encrypt_name']    = FALSE;
		        $configF['file_name'] 		= $titleF.'-'.$dt_hj;
		        $configF['overwrite'] 		= FALSE;
		  
		      	$this->upload->initialize($configF);
		        
		        if ($this->upload->do_upload('arquivo'))
		        {
		        	$imagem = $this->getConteudo($id_conteudo);
		        	if($imagem->arquivo)
					{
						unlink('./assets/uploads/conteudos/' . $imagem->arquivo);
					}
		        	$file_data = $this->upload->data();
		        	
		        	// new file name
		        	$newfilename  = $titleF.'-'.$dt_hj.$file_data['file_ext'];
		        	// new file name
					
			        $file_name = $file_data['file_name'];
			        $file_size = $file_data['file_size'];
					
					$this->db->set('arquivo', $newfilename);
					
				}
		        //=====================================================================
				//FIM UPLOAD DA CAPA
				//=====================================================================			
				
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_conteudo', $id_conteudo);
                $this->db->update('conteudos');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "conteudos";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_conteudo;
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
			$title 	= $this->utilidades->sanitize_title_with_dashes("quem-somos");
			$dt_hj 		= date("dmyHis");
			
			$config['upload_path']		= './assets/uploads/conteudos';
	        $config['allowed_types']	= 'gif|jpg|png|bmp';
	        $config['max_size']			= '10000';
	        $config['max_width']		= '6000';
	        $config['max_height']		= '6000';
	        $config['encrypt_name']    	= FALSE;
	        $config['file_name'] 		= $title.'-'.$dt_hj;
	        $config['overwrite'] 		= FALSE;
	  
	      	$this->upload->initialize($config);
	        
	        if ($this->upload->do_upload('imagem'))
	        {
	        	$file_data = $this->upload->data();
				
		        $file_name = $file_data['file_name'];
		        $file_size = $file_data['file_size'];
		        
		        // new file name
		        
	        	$newfilename  = $title.'-'.$dt_hj.$file_data['file_ext'];
	        	// new file name
		        
		        //ZOOM
		        $configR['image_library'] 	= 'GD2';
				$configR['source_image']	= $file_data['full_path'];
				$configR['create_thumb']    = FALSE;
				$configR['maintain_ratio']	= TRUE;
				$configR['new_image']		= $file_data['full_path'];
				$configR['width']			= 800;
				$configR['height']			= 650;
				$configR['quality']			= 80;
				
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
			
			$upload = "";
			//=====================================================================
			//INICIO UPLOAD CAPA
			//=====================================================================
			$titleF 	= $this->utilidades->sanitize_title_with_dashes("prestacao-de-contas");
			$dt_hj 		= date("dmyHis");
			
			$configF['upload_path']		= './assets/uploads/conteudos';
	        $configF['allowed_types']	= 'pdf|doc|docx';
	        $configF['max_size']		= '10000';
	        $configF['encrypt_name']    = FALSE;
	        $configF['file_name'] 		= $titleF.'-'.$dt_hj;
	        $configF['overwrite'] 		= FALSE;
	  
	      	$this->upload->initialize($configF);
	        
	        if ($this->upload->do_upload('arquivo'))
	        {
	        	$file_data = $this->upload->data();
	        	
	        	// new file name
	        	$newfilename  = $titleF.'-'.$dt_hj.$file_data['file_ext'];
	        	// new file name
				
		        $file_name = $file_data['file_name'];
		        $file_size = $file_data['file_size'];
				
				$this->db->set('arquivo', $newfilename);
				
			}
	        //=====================================================================
			//FIM UPLOAD DA CAPA
			//=====================================================================	
			
			
			$this->db->set($data)->insert('conteudos');
			
			$this->session->set_flashdata('resposta', 'Conteúdo adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "conteudos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */