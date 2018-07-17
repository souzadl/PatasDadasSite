<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH.'models/Generico_Model.php';
class Doencas_Cronicas_model extends Generico_Model {   
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->tabela = 'doencas_cronicas';  
    }    
    
    public function setDoenca($data){
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

        $this->session->set_flashdata('resposta', 'Doença adicionada com sucesso.');	
        
        $this->db->trans_complete();
        
        return $this->db->insert_id();
    }
 
    public function delDoenca($id) {
        $data['id'] = $id;
        $this->apagar($data);
    }
    
}

