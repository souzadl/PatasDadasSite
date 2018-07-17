<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adocoes extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/adocoes/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('adocoes_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os adocoes',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'adocoes'  	 	=> $this->model->getAdocoes($offset)
		);
		
		$this->load->view('adocoes/adocoes.php', $data);
	}
	
	function updateOrder ()
	{
		$this->load->model('adocoes_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_adocao = 0)
	{
		$this->load->model('adocoes_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'adocao' 			=> $this->model->getAdocao($id_adocao)
			);
			
			$this->load->view('adocoes/adocoes.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Adocoes.php */
/* Location: ./system/application/controllers/adocoes.php */