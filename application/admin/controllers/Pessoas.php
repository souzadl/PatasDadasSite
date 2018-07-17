<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pessoas extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/pessoas/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('pessoas_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os pessoas',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'pessoas'  	 	=> $this->model->getPessoas($offset)
		);
		
		$this->load->view('pessoas/pessoas.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('pessoas_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('pessoas/pessoas.cadastro.php', $data);
	}
	
	function editar ($id_pessoa = 0)
	{
		$this->load->model('pessoas_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'pessoa' 			=> $this->model->getPessoa($id_pessoa)
			);
			
			$this->load->view('pessoas/pessoas.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('pessoas_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_pessoa = 0)
	{
		$this->load->model('pessoas_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'pessoa' 		=> $this->model->getPessoa($id_pessoa)
			);
			
			$this->load->view('pessoas/pessoas.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('pessoas_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'nome'					=> $this->input->post('nome'),
				'email'					=> $this->input->post('email'),
				'telefone'				=> $this->input->post('telefone')
			);
			
			$id = $this->model->setPessoa($data, $this->input->post('id_pessoa'));
				
			if ($this->input->post('id_pessoa'))
				redirect('pessoas/editar/' . $this->input->post('id_pessoa'));
			else
				redirect('pessoas/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_pessoa = 0)
	{
		$this->load->model('pessoas_model', 'model');

		try
		{
			$this->model->delPessoa($id_pessoa);
			redirect('pessoas/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Pessoas.php */
/* Location: ./system/application/controllers/pessoas.php */