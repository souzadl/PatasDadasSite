<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH.'models/Generico_Model.php';
class Historicos_Peso_model extends Generico_Model {   
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->tabela = 'historicos_peso';  
    }    
    
    public function setHistorico($data){
        $this->db->trans_start();
        $idProntuario = trim($data['id_prontuario']);
        if(empty($idProntuario)){
            $CI = &get_instance();
            $CI->load->model('prontuarios_model','prontuario');
            $prontuario['id_animal'] = $this->input->post('id_animal');
            $data['id_prontuario'] = $this->prontuario->setProntuario($prontuario);
        }   
        unset($data['id_animal']);
        
        $this->inserir($data);        

        $this->session->set_flashdata('resposta', 'Histórico adicionado com sucesso.');	
        
        $this->db->trans_complete();
        
        return $this->db->insert_id();
    }
 
    
}

