<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parceiros extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/parceiros/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('parceiros_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os parceiros',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'parceiros'  	 	=> $this->model->getParceiros($offset)
		);
		
		$this->load->view('parceiros/parceiros.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('parceiros_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('parceiros/parceiros.cadastro.php', $data);
	}
	
	function editar ($id_parceiro = 0)
	{
		$this->load->model('parceiros_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'parceiro' 			=> $this->model->getParceiro($id_parceiro)
			);
			
			$this->load->view('parceiros/parceiros.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('parceiros_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_parceiro = 0)
	{
		$this->load->model('parceiros_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'parceiro' 		=> $this->model->getParceiro($id_parceiro)
			);
			
			$this->load->view('parceiros/parceiros.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('parceiros_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'nome'					=> $this->input->post('nome'),
				'link'					=> $this->input->post('link')
			);
			
			$id = $this->model->setParceiro($data, $this->input->post('id_parceiro'));
				
			if ($this->input->post('id_parceiro'))
				redirect('parceiros/editar/' . $this->input->post('id_parceiro'));
			else
				redirect('parceiros/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_parceiro = 0)
	{
		$this->load->model('parceiros_model', 'model');

		try
		{
			$this->model->delParceiro($id_parceiro);
			redirect('parceiros/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Parceiros.php */
/* Location: ./system/application/controllers/parceiros.php */