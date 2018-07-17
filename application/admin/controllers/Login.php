<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}
	
	function entrar ()
	{
		$username = $this->input->post('login');
		$password = $this->input->post('senha');
		
		if ($this->auth->try_login($username, $password))
		{
			$this->load->model('logs_model', 'model');
			$id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));
			$this->model->inserirLogAcesso($id_usuario);
			
			redirect('dashboard');
		}
		else
		{
			redirect('login');
		}
	}
	
	function certo ()
	{
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	}
	
	function sair ()
	{
		$this->auth->logout();
		redirect('login/');
	}
}