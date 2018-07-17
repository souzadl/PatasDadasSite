<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pontos extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/pontos/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('pontos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os pontos',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'pontos'  	 	=> $this->model->getPontos($offset)
		);
		
		$this->load->view('pontos/pontos.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('pontos_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('pontos/pontos.cadastro.php', $data);
	}
	
	function editar ($id_ponto = 0)
	{
		$this->load->model('pontos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'ponto' 			=> $this->model->getPonto($id_ponto)
			);
			
			$this->load->view('pontos/pontos.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('pontos_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_ponto = 0)
	{
		$this->load->model('pontos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'ponto' 		=> $this->model->getPonto($id_ponto)
			);
			
			$this->load->view('pontos/pontos.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('pontos_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'ponto'					=> $this->input->post('ponto'),
				'endereco'				=> $this->input->post('endereco'),
				'cidade'				=> $this->input->post('cidade'),
				'estado'				=> $this->input->post('estado'),
				'link'					=> $this->input->post('link')
			);
			
			$id = $this->model->setPonto($data, $this->input->post('id_ponto'));
				
			if ($this->input->post('id_ponto'))
				redirect('pontos/editar/' . $this->input->post('id_ponto'));
			else
				redirect('pontos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_ponto = 0)
	{
		$this->load->model('pontos_model', 'model');

		try
		{
			$this->model->delPonto($id_ponto);
			redirect('pontos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Pontos.php */
/* Location: ./system/application/controllers/pontos.php */