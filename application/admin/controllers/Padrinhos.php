<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Padrinhos extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/padrinhos/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('padrinhos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os padrinhos',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'padrinhos'  	 	=> $this->model->getPadrinhos($offset)
		);
		
		$this->load->view('padrinhos/padrinhos.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('padrinhos_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('padrinhos/padrinhos.cadastro.php', $data);
	}
	
	function editar ($id_padrinho = 0)
	{
		$this->load->model('padrinhos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'padrinho' 			=> $this->model->getPadrinho($id_padrinho)
			);
			
			$this->load->view('padrinhos/padrinhos.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('padrinhos_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_padrinho = 0)
	{
		$this->load->model('padrinhos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'padrinho' 		=> $this->model->getPadrinho($id_padrinho)
			);
			
			$this->load->view('padrinhos/padrinhos.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('padrinhos_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'nome'					=> $this->input->post('nome'),
				'email'					=> $this->input->post('email'),
				'telefone'				=> $this->input->post('telefone'),
				'cpf'					=> $this->input->post('cpf'),
				'rg'					=> $this->input->post('rg'),
				'endereco'				=> $this->input->post('endereco'),
				'cidade'				=> $this->input->post('cidade'),
				'estado'				=> $this->input->post('estado'),
				'cep'					=> $this->input->post('cep'),
				'facebook'				=> $this->input->post('facebook')
			);
			
			$id = $this->model->setPadrinho($data, $this->input->post('id_padrinho'));
				
			if ($this->input->post('id_padrinho'))
				redirect('padrinhos/editar/' . $this->input->post('id_padrinho'));
			else
				redirect('padrinhos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_padrinho = 0)
	{
		$this->load->model('padrinhos_model', 'model');

		try
		{
			$this->model->delPadrinho($id_padrinho);
			redirect('padrinhos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Padrinhos.php */
/* Location: ./system/application/controllers/padrinhos.php */