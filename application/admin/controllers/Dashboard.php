<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		$this->load->model('dashboard_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'animais'			=> $this->model->totalAnimais(),
			'disponiveis'		=> $this->model->getAnimaisCondicao('DI'),
			'adotados'			=> $this->model->getAnimaisCondicao('A')
		);
		
		$this->load->view('dashboard/dashboard.php', $data);
	}
	
	function conteudos ()
	{
		$this->load->model('dashboard_model', 'model');
		
		$data = array (
			'conteudo'			=> $this->model->getConteudo(1)
		);
		
		$this->load->view('dashboard/conteudos.php', $data);
	}
	
	function salvarConteudo ()
	{
		$this->load->model('dashboard_model', 'model');
		
		try
		{		
			$data = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'missao'				=> $this->input->post('missao'),
				'historia'				=> $this->input->post('historia'),
				'facebook'				=> $this->input->post('facebook'),
				'twitter'				=> $this->input->post('twitter'),
				'email'					=> $this->input->post('email'),
				'instagram'				=> $this->input->post('instagram')
			);
			
			$id = $this->model->setConteudo($data, $this->input->post('id_conteudo'));
				
			if ($this->input->post('id_conteudo'))
				redirect('conteudos');
			else
				redirect('conteudos');
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Usuarios.php */
/* Location: ./system/application/controllers/usuarios.php */