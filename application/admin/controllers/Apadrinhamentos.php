<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Apadrinhamentos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check();
    }

    function index() {
        header('Location: admin.php/apadrinhamentos/lista/');
    }

    function lista($offset = "") {
        $this->load->model('apadrinhamentos_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Todos os apadrinhamentos',
            'permissoes' => $this->model->getPermissoes(),
            'apadrinhamentos' => $this->model->getApadrinhamentos($offset)
        );

        $this->load->view('apadrinhamentos/apadrinhamentos.php', $data);
    }

    function updateOrder() {
        $this->load->model('apadrinhamentos_model', 'model');

        $i = 0;
        foreach ($this->input->post('item') as $value) {
            $this->model->updateOrder($i, $value);
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            $i++;
        }
    }

    function visualizar($id_apadrinhamento = 0) {
        $this->load->model('apadrinhamentos_model', 'model');

        try {
            $data = array(
                'permissoes' => $this->model->getPermissoes(),
                'apadrinhamento' => $this->model->getApadrinhamento($id_apadrinhamento)
            );

            $this->load->view('apadrinhamentos/apadrinhamentos.visualizar.php', $data);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

}

/* End of file Apadrinhamentos.php */
/* Location: ./system/application/controllers/apadrinhamentos.php */