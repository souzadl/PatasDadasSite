<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/faqs/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('faqs_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os faqs',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'faqs'  	 	=> $this->model->getFaqs($offset)
		);
		
		$this->load->view('faqs/faqs.php', $data);
	}
		
	function cadastro()
	{
		$this->load->model('faqs_model', 'model');
		
		$data = array (
			'permissoes'  	=> $this->model->getPermissoes()
		);

		$this->load->view('faqs/faqs.cadastro.php', $data);
	}
	
	function editar ($id_faq = 0)
	{
		$this->load->model('faqs_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'faq' 				=> $this->model->getFaq($id_faq)
			);
			
			$this->load->view('faqs/faqs.cadastro.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function updateOrder ()
	{
		$this->load->model('faqs_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_faq = 0)
	{
		$this->load->model('faqs_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  	=> $this->model->getPermissoes(),
				'faq' 			=> $this->model->getFaq($id_faq)
			);
			
			$this->load->view('faqs/faqs.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function salvar ()
	{
		$this->load->model('faqs_model', 'model');
		
		try
		{	
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'pergunta'				=> $this->input->post('pergunta'),
				'resposta'				=> $this->input->post('resposta')
			);
			
			$id = $this->model->setFaq($data, $this->input->post('id_faq'));
				
			if ($this->input->post('id_faq'))
				redirect('faqs/editar/' . $this->input->post('id_faq'));
			else
				redirect('faqs/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
	
	function apagar ($id_faq = 0)
	{
		$this->load->model('faqs_model', 'model');

		try
		{
			$this->model->delFaq($id_faq);
			redirect('faqs/lista');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Faqs.php */
/* Location: ./system/application/controllers/faqs.php */