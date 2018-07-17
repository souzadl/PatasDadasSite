<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check();
	}
	
	function index ()
	{
		header('Location: admin.php/pedidos/lista/');
	}
	
	function lista ($offset = "")
	{
		$this->load->model('pedidos_model', 'model');
		$this->load->helper('text');
		
		$data = array (
			'titulo'		=> 'Todos os pedidos',
			'permissoes'  	=> $this->model->getPermissoes(),
    		'pedidos'  	 	=> $this->model->getPedidos($offset)
		);
		
		$this->load->view('pedidos/pedidos.php', $data);
	}
	
	function updateOrder ()
	{
		$this->load->model('pedidos_model', 'model');
		
		$i = 0;
		foreach ($this->input->post('item') as $value) 
		{
			$this->model->updateOrder($i, $value);
		    // Execute statement:
		    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
		    $i++;
		}
	}
	
	function visualizar ($id_pedido = 0)
	{
		$this->load->model('pedidos_model', 'model');
		
		try
		{
			$data = array (
				'permissoes'  		=> $this->model->getPermissoes(),
				'pedido' 			=> $this->model->getPedido($id_pedido),
				'itens'				=> $this->model->getItens($id_pedido)
			);
			
			$this->load->view('pedidos/pedidos.visualizar.php', $data);
		}
		catch (Exception $e)
		{
			show_error($e->getMessage());
		}
	}
}

/* End of file Pedidos.php */
/* Location: ./system/application/controllers/pedidos.php */