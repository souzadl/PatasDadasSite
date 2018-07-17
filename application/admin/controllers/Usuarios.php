<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/usuarios/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('usuarios_model', 'model');
		$this->load->helper('text');
		
		$config = array (
			'base_url'		=> 'http://www.pilateslavie.com.br/beta/admin.php/usuarios/lista/',
			'total_rows'	=> $this->model->numUsuarios(),
			'per_page'		=> '20'
		);
		
		$this->pagination->initialize($config); 
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes(),
			'cadastrados' 	=> $this->model->numUsuarios(),
    		'usuarios'    	=> ($this->input->post('keyword')) ? $this->model->buscaUsuarios($this->input->post('keyword')) : $this->model->getUsuarios($offset),
			'paginacao'	  	=> $this->pagination->create_links()
		);
		
		$this->load->view('usuarios/usuarios.php', $data);
	}
	
	function cadastro()
	{
		$this->load->model('usuarios_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('usuarios/usuarios.cadastro.php', $data);
	}
	
	function editar ($id_usuario = 0)
	{
		$this->load->model('usuarios_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'usuario' 		=> $this->model->getUsuario($id_usuario)
			);
			
			$this->load->view('usuarios/usuarios.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function visualizar ($id_usuario = 0)
	{
		$this->load->model('usuarios_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'usuario' 		=> $this->model->getUsuario($id_usuario)
			);
			
			$this->load->view('usuarios/usuarios.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('usuarios_model', 'model');
		
		try
		{
			if($this->input->post('senha'))
			{
				$data = array (
					'nome'				=> $this->input->post('nome'),
					'email'				=> $this->input->post('email'),
					'login'				=> $this->input->post('email'),
					'ativo'				=> $this->input->post('ativo'),
					'senha'				=> $this->encrypt->encode($this->input->post('senha'))
				);							
			}
			else 
			{
				$data = array (
					'nome'				=> $this->input->post('nome'),
					'email'				=> $this->input->post('email'),
					'login'				=> $this->input->post('email'),
					'ativo'				=> $this->input->post('ativo')
					
				);				
			}
			
			$user = $this->model->setUsuario($data, $this->input->post('id_usuario'));
				
			if ($this->input->post('id_usuario'))
				redirect('usuarios/editar/' . $this->input->post('id_usuario'));
			else
				redirect('usuarios/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_usuario = 0)
	{
		$this->load->model('usuarios_model', 'model');

		try
		{
			$this->model->delUsuario($id_usuario);
			redirect('usuarios/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Usuarios.php */
/* Location: ./system/application/controllers/usuarios.php */