<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/eventos/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('eventos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os eventos',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'eventos'  	 	=> $this->model->getEventos($offset)
		);
		
		$this->load->view('eventos/eventos.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('eventos_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('eventos/eventos.cadastro.php', $data);
	}
	
	function editar ($id_evento = 0)
	{
		$this->load->model('eventos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'evento' 			=> $this->model->getEvento($id_evento)
			);
			
			$this->load->view('eventos/eventos.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('eventos_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_evento = 0)
	{
		$this->load->model('eventos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'evento' 		=> $this->model->getEvento($id_evento)
			);
			
			$this->load->view('eventos/eventos.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('eventos_model', 'model');
		
		try
		{
			$postDtA = $this->input->post('data');
			$postDtA = str_replace('/', '-', $postDtA);
			$dt = date('Y-m-d', strtotime($postDtA));
				
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'data'					=> $dt,
				'horario'				=> $this->input->post('horario'),
				'local'					=> $this->input->post('local'),
				'evento'				=> $this->input->post('evento'),
				'link'					=> $this->input->post('link')
			);
			
			$id = $this->model->setEvento($data, $this->input->post('id_evento'));
				
			if ($this->input->post('id_evento'))
				redirect('eventos/editar/' . $this->input->post('id_evento'));
			else
				redirect('eventos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_evento = 0)
	{
		$this->load->model('eventos_model', 'model');

		try
		{
			$this->model->delEvento($id_evento);
			redirect('eventos/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Eventos.php */
/* Location: ./system/application/controllers/eventos.php */