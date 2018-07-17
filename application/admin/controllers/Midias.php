<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midias extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/midias/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('midias_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'			=> 'Todas as mídias',
			'permissoes'  		=> $this->model->getPermissoes(),
    		'midias'  	 		=> $this->model->getMidias($offset)
		);
		
		$this->load->view('midias/midias.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('midias_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('midias/midias.cadastro.php', $data);
	}
	
	function editar ($id_midia = 0)
	{
		$this->load->model('midias_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'midia' 			=> $this->model->getMidia($id_midia)
			);
			
			$this->load->view('midias/midias.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('midias_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_midia = 0)
	{
		$this->load->model('midias_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'midia' 		=> $this->model->getMidia($id_midia)
			);
			
			$this->load->view('midias/midias.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('midias_model', 'model');
		
		try
		{
			$postDtA = $this->input->post('data');
			$postDtA = str_replace('/', '-', $postDtA);
			$dt = date('Y-m-d', strtotime($postDtA));
				
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'data'					=> $dt,
				'titulo'				=> $this->input->post('titulo'),
				'tipo'					=> $this->input->post('tipo'),
				'link'					=> $this->input->post('link')
			);
			
			$id = $this->model->setMidia($data, $this->input->post('id_midia'));
				
			if ($this->input->post('id_midia'))
				redirect('midias/editar/' . $this->input->post('id_midia'));
			else
				redirect('midias/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_midia = 0)
	{
		$this->load->model('midias_model', 'model');

		try
		{
			$this->model->delMidia($id_midia);
			redirect('midias/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Midias.php */
/* Location: ./system/application/controllers/midias.php */