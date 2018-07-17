<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Patas Dadas para mudar o mundo',
			'description'	=> 'Somos voluntários e nosso trabalho é proteger, tratar, vacinar, castrar e encaminhar para adoção cães e gatos abandonados. Nos mantemos exclusivamente de doações, brechós e venda de produtos com a marca Patas Dadas.',
			'keywords'		=> 'patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-01.png",
			
			'page'			=> 'home',
			'conteudo'		=> $this->model->getConteudo(1)
		);
		
		$this->load->view('welcome', $data);
	}
	
	public function error()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Ops, algo deu errado - Patas Dadas para mudar o mundo',
			'description'	=> 'Somos voluntários e nosso trabalho é proteger, tratar, vacinar, castrar e encaminhar para adoção cães e gatos abandonados. Nos mantemos exclusivamente de doações, brechós e venda de produtos com a marca Patas Dadas.',
			'keywords'		=> 'patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-01.png",
			
			'page'			=> 'home',
			'conteudo'		=> $this->model->getConteudo(1)
		);
		
		$this->load->view('error', $data);
	}
	
	public function como_ajudar()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Como ajudar - Patas Dadas',
			'description'	=> 'Se você quer ajudar os nossos cães e não sabe como, tornar-se um padrinho é uma boa opção.',
			'keywords'		=> 'como ajudar, doações, apadrinhamento, vacinas, ração, anti pulgas, vermifugo',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-02.png",
			
			'page'			=> 'como_ajudar',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'pontos'		=> $this->model->getPontosDeColeta()
		);
		
		$this->load->view('como_ajudar', $data);
	}
	
	public function eventos()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Eventos - Patas Dadas',
			'description'	=> 'Confira a nossa agenda e venha participar de nossos eventos!',
			'keywords'		=> 'eventos, patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-03.png",
			
			'page'			=> 'eventos',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'eventos'		=> $this->model->getEventos()
		);
		
		$this->load->view('eventos', $data);
	}
	
	public function quem_somos()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Quem somos - Patas Dadas',
			'description'	=> 'O Patas Dadas surgiu em resposta a uma série de maus tratos que aconteceram em um Campus da UFRGS em 2009, onde mais de 10 animais foram envenenados, um foi morto a pauladas e outro jogado em um tanque de tratamento de água.',
			'keywords'		=> 'quem somos, equipe, nosso time, patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-01.png",
			
			'page'			=> 'quem_somos',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'pessoas'		=> $this->model->getPessoas(),
			'midias'		=> $this->model->getMidias(),
			'parceiros'		=> $this->model->getParceiros()
		);
		
		$this->load->view('quem_somos', $data);
	}
	
	public function contato()
	{
		$this->load->model('Welcome_model', 'model');
		
		$data = array (
			'titulo'		=> 'Contato - Patas Dadas',
			'description'	=> 'Dúvias? Sugestões? Idéias? Entre em contato conosco, será um prazer ouvir você!',
			'keywords'		=> 'contato, fale conosco, faq, duvidas, sugestoes, patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
			'imageog'		=> base_url()."assets/public/img/marcacao/patas-ogimage-01.png",
			
			'page'			=> 'contato',
			'conteudo'		=> $this->model->getConteudo(1),
			
			'faqs'			=> $this->model->getFaqs()
		);
		
		$this->load->view('contato', $data);
	}
}