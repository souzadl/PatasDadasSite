<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {
	
	public function index()
	{
		$this->load->model('Welcome_model', 'model');
		
		//$this->PagSeguro->teste();
		
		$data = array (
			'titulo'		=> 'a',
			'page'			=> 'home',
			
			'test'			=> $this->PagSeguro->teste()
		);
		
		$this->load->view('welcome_pagseguro', $data);
	}
}