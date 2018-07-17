<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produtos_model extends CI_Model {	

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
	
	function numProdutos ()
	{
		$this->db->select('*')->from('produtos');
		
		return $this->db->count_all_results();
	}
	
	function getProdutos ($offset = 0)
	{
		//$this->db->join('comments', 'comments.id = blogs.id');		
		$this->db->flush_cache();
		$this->db->select('*')->from('produtos')->join('produtos_categorias', 'produtos_categorias.id_produto_categoria = produtos.id_produto_categoria')->order_by('produtos.titulo', 'asc');
		
		return $this->db->get();
	}
	
	function getProdutosCondicao ($condicao = "")
	{
		$this->db->flush_cache();
		$this->db->select('*')->from('produtos')->where('condicao', $condicao)->order_by('titulo', 'asc');
		
		return $this->db->get();
	}
	
	function getEstoques ($id_produto)
	{
		$where = array ('id_produto' => $id_produto);		
		$this->db->select('*')->from('produtos_estoque')->where($where);

		$query = $this->db->get();			
		return $query->result();
	}
	
	function getEstoque ($id_produto_estoque)
	{
		$where = array ('id_produto_estoque' => $id_produto_estoque);		
		$this->db->select('*')->from('produtos_estoque')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function getFotos ($id_produto)
	{
		$where = array ('id_produto' => $id_produto);		
		$this->db->select('*')->from('produtos_galerias')->where($where);

		$query = $this->db->get();			
		return $query->result();
	}
	
	function getProduto ($id_produto)
	{		
		$where = array ('id_produto' => $id_produto);		
		$this->db->select('*')->from('produtos')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function getImagemProduto ($id_produto_galeria)
	{
		$where = array ('id_produto_galeria' => $id_produto_galeria);		
		$this->db->select('*')->from('produtos_galerias')->where($where);

		$query = $this->db->get();			
		return $query->row();		
	}
	
	function setProduto ($data, $id_produto = "")
	{
		$this->load->library('utilidades');
		
		if ($id_produto)
		{
			$where = array ('id_produto' => $id_produto);
			$this->db->select('*')->from('produtos')->where($where);
			
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
				$beautifulFileName 	= $this->utilidades->sanitize_title_with_dashes($data['titulo'])."-".date("dmyHis");
				
				$config['upload_path']		= './assets/uploads/produtos';
		        $config['allowed_types']	= 'gif|jpg|png|bmp';
		        $config['max_size']			= '10000';
		        $config['max_width']		= '6000';
		        $config['max_height']		= '6000';
		        $config['encrypt_name']    	= FALSE;
		        $config['file_name'] 		= $beautifulFileName;
		        $config['overwrite'] 		= FALSE;
		  
		      	$this->upload->initialize($config);
		        
		        if ($this->upload->do_upload('imagem'))
		        {
		        	$imagem = $this->getProduto($id_produto);
		        	if($imagem->imagem)
					{
						unlink('./assets/uploads/produtos/' . $imagem->imagem);
					}
		        	$file_data = $this->upload->data();
					
			        $file_name = $file_data['file_name'];
			        $file_size = $file_data['file_size'];
			        
			        $beautifulFileName  = $beautifulFileName.$file_data['file_ext'];
			        
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
					
					
					$this->db->set('imagem', $beautifulFileName);
					
				}
		        //=====================================================================
				//FIM UPLOAD DA CAPA
				//=====================================================================			
				
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_produto', $id_produto);
                $this->db->update('produtos');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "produtos";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_produto;
		}
		else
		{
			$this->load->library('image_lib');
			$this->load->library('upload');	
			
			$upload = "";
			//=====================================================================
			//INICIO UPLOAD CAPA
			//=====================================================================
			$beautifulFileName 	= $this->utilidades->sanitize_title_with_dashes($data['titulo'])."-".date("dmyHis");
			
			$config['upload_path']		= './assets/uploads/produtos';
	        $config['allowed_types']	= 'gif|jpg|png|bmp';
	        $config['max_size']			= '10000';
	        $config['max_width']		= '6000';
	        $config['max_height']		= '6000';
	        $config['encrypt_name']    	= FALSE;
	        $config['file_name'] 		= $beautifulFileName;
	        $config['overwrite'] 		= FALSE;
	        
	      	$this->upload->initialize($config);
	        if ($this->upload->do_upload('imagem'))
	        {
	        	$file_data = $this->upload->data();
				
		        $file_name = $file_data['file_name'];
		        $file_size = $file_data['file_size'];
		        
		        $beautifulFileName  = $beautifulFileName.$file_data['file_ext'];
		        
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
				
				$this->db->set('imagem', $beautifulFileName);
			}
	        //=====================================================================
			//FIM UPLOAD DA CAPA
			//=====================================================================	
			$this->db->set($data)->insert('produtos');
			
			$this->session->set_flashdata('resposta', 'Produto adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "produtos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function setGaleriaProduto ($id_produto, $produto)
	{
		$this->load->library('utilidades');
		
		if ($id_produto)
		{
			$where = array ('id_produto' => $id_produto);
			$this->db->select('*')->from('produtos')->where($where);
			
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
				//INICIO UPLOAD DAS IMAGENS
				//=====================================================================
			    
			    $files = $_FILES;
                $cpt = count($_FILES['imagem']['name']);
                
/*
                echo "<pre>";
                print_r($_FILES);
                echo "</pre>";
                //exit;
*/
	
			    for($i = 0; $i < $cpt; $i ++) 
			    {
				    $beautifulFileName 	= $this->utilidades->sanitize_title_with_dashes($produto->titulo)."-".date("dmyHis")."-".$i;
				    
				    $config[$i]['upload_path']		= './assets/uploads/produtos/galeria';
			        $config[$i]['allowed_types']	= 'gif|jpg|png|bmp';
			        $config[$i]['max_size']			= '10000';
			        $config[$i]['max_width']		= '10000';
			        $config[$i]['max_height']		= '10000';
			        $config[$i]['encrypt_name']    	= FALSE;
					$config[$i]['file_name'] 		= $beautifulFileName;
					$config[$i]['overwrite'] 		= FALSE;		
					
					$_FILES['imagem']['name']		= $files['imagem']['name'][$i];
			        $_FILES['imagem']['type']		= $files['imagem']['type'][$i];
			        $_FILES['imagem']['tmp_name']	= $files['imagem']['tmp_name'][$i];
			        $_FILES['imagem']['error']		= $files['imagem']['error'][$i];
			        $_FILES['imagem']['size']		= $files['imagem']['size'][$i];  
			        
			      	$this->upload->initialize($config[$i]);

			      	
			        if ($this->upload->do_upload('imagem'))
			        {
			        	//$file_data = $this->upload->data();

						$file_name = $files['imagem']['name'][$i];
				        $file_size = $files['imagem']['size'][$i];
				     
			            $file_data[$i] = $this->upload->data();
			            
			            $beautifulFileName = $beautifulFileName.$file_data[$i]['file_ext'];	  
			            
			            $this->db->set('imagem', $beautifulFileName);
						$this->db->set('id_produto', $id_produto);
						$this->db->set('data_alteracao', date("Y-m-d H:i:s"));
			            $this->db->insert('produtos_galerias');

			            $configRz[$i]['image_library'] 	= 'GD2';
						$configRz[$i]['source_image'] 	= $file_data[$i]['full_path'];
						$configRz[$i]['create_thumb'] 	= FALSE;
						$configRz[$i]['maintain_ratio'] = TRUE;
						$configRz[$i]['new_image'] 		= $file_data[$i]['full_path'];
						$configRz[$i]['width'] 			= 850;
						$configRz[$i]['height'] 		= 650;
						
						$this->image_lib->initialize($configRz[$i]);
						$this->image_lib->resize();
			                
				        //Log Acesso
				        	$acao 		= "insert";
				           	$tabela 	= "produtos_galerias";
				            $sql 		= $this->db->last_query();
				            $this->model->inserirLogAcoes($tabela, $acao, $sql);
				        //Log Acesso 
					}
					else
					{
						//$data2 = array('upload_data' => $this->upload->data());
						$error = array('error' => $this->upload->display_errors());
						echo "<pre>";
						
							print_r($error);
						
						echo "</pre>";
						exit;
					}
			        
			        //=====================================================================
					//FIM UPLOAD DAS IMAGENS
					//=====================================================================
		        
		        }	                	        	
			}
		}
	}
	
	function delProduto ($id_produto)
	{		
		$where = array ('id_produto' => $id_produto);
		$this->db->select('*')->from('produtos')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
			$imagem = $this->getProduto($id_produto);
        	if($imagem->imagem)
			{
				unlink('./assets/uploads/produtos/' . $imagem->imagem);
			}
					
            $this->db->where('id_produto', $id_produto);
            $this->db->delete('produtos');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "produtos";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Produto excluído com sucesso (:');            
		}
	}
	
	function delFoto ($id_produto_galeria)
	{
		$where = array ('id_produto_galeria' => $id_produto_galeria);
		$this->db->select('*')->from('produtos_galerias')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
			$imagem = $this->getImagemProduto($id_produto_galeria);
        	if($imagem->imagem)
			{
				unlink('./assets/uploads/produtos/galeria/' . $imagem->imagem);
			}
					
            $this->db->where('id_produto_galeria', $id_produto_galeria);
            $this->db->delete('produtos_galerias');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "produtos_galerias";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Foto excluída com sucesso!');            
		}
	}
	
	function updateOrder ($ordem, $id)
	{
		$this->db->set('order', $ordem);
        $this->db->where('id_produto', $id);
        $this->db->update('produtos');
	}
	
	
	function numProdutosCategorias ()
	{
		$this->db->select('*')->from('produtos_categorias');
		
		return $this->db->count_all_results();
	}
	
	function getProdutosCategorias ()
	{		
		$this->db->flush_cache();
		$this->db->select('*')->from('produtos_categorias')->order_by('categoria', 'asc');
		
		return $this->db->get();
	}
	
	function getProdutoCategorias ($id_produto_categoria)
	{		
		$where = array ('id_produto_categoria' => $id_produto_categoria);		
		$this->db->select('*')->from('produtos_categorias')->where($where);

		$query = $this->db->get();			
		return $query->row();
	}
	
	function setProdutoCategorias ($data, $id_produto_categoria = "")
	{
		if ($id_produto_categoria)
		{
			$where = array ('id_produto_categoria' => $id_produto_categoria);
			$this->db->select('*')->from('produtos_categorias')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_produto_categoria', $id_produto_categoria);
                $this->db->update('produtos_categorias');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "produtos_categorias";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso  
			}
			//exit;
			
			return $id_produto_categoria;
		}
		else
		{
			$this->db->set($data)->insert('produtos_categorias');
			
			$this->session->set_flashdata('resposta', 'Categorias de Produtos adicionado com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "produtos_categorias";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delProdutoCategorias ($id_produto_categoria)
	{		
		$where = array ('id_produto_categoria' => $id_produto_categoria);
		$this->db->select('*')->from('produtos_categorias')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{
					
            $this->db->where('id_produto_categoria', $id_produto_categoria);
            $this->db->delete('produtos_categorias');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "produtos_categorias";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Categoria de produto excluída com sucesso (:');            
		}
	}
	
	function setEstoqueProduto ($data, $id_produto_estoque = "")
	{
		if ($id_produto_estoque)
		{
			$where = array ('id_produto_estoque' => $id_produto_estoque);
			$this->db->select('*')->from('produtos_estoque')->where($where);
			
			if ( ! $this->db->count_all_results())
			{
				throw new Exception('Acesso negado.');
			}
			else
			{
				$this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');
				
				$this->db->set($data);
                $this->db->where('id_produto_estoque', $id_produto_estoque);
                $this->db->update('produtos_estoque');
                
	             //Log Acesso
	            	$acao 		= "update";
	            	$tabela 	= "produtos_estoque";
	            	$sql 		= $this->db->last_query();
	            	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	            //Log Acesso                 
			}
			
			return $id_produto_estoque;
		}
		else
		{
			$this->db->set($data)->insert('produtos_estoque');
			$this->session->set_flashdata('resposta', 'Estoque adicionada com sucesso (:');
			
	        //Log Acesso
	        	$acao 		= "insert";
	        	$tabela 	= "produtos_estoque";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 			
			
			return $this->db->insert_id();
		}
	}
	
	function delEstoque ($id_produto_estoque)
	{
		$where = array ('id_produto_estoque' => $id_produto_estoque);
		$this->db->select('*')->from('produtos_estoque')->where($where);
		
		if ( ! $this->db->count_all_results())
		{
			throw new Exception('Acesso negado.');
		}
		else
		{			
            $this->db->where('id_produto_estoque', $id_produto_estoque);
            $this->db->delete('produtos_estoque');
            
	        //Log Acesso
	        	$acao 		= "delete";
	        	$tabela 	= "produtos_estoque";
	        	$sql 		= $this->db->last_query();
	        	$this->model->inserirLogAcoes($tabela, $acao, $sql);
	        //Log Acesso 
	        
	        $this->session->set_flashdata('resposta', 'Plano / Valor excluído com sucesso!');            
		}
	}
}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */