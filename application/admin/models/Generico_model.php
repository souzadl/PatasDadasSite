<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class Generico_model extends CI_Model {
    protected $tabela;
    
    public function __construct() {
        // Call the Model constructor
        parent::__construct();        
    }    
    
    protected function inserir($data){
        $this->db->set($data)->insert($this->tabela);
        $this->inserirLogAcoes("Insert", $this->db->last_query());
    }
    
    
    protected function inserirLogAcoes($acao, $sql) {
        $id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));

        $data = array(
            'data_hora' => date('Y-m-d H:i:s'),
            'id_usuario' => $id_usuario,
            'tabela' => $this->tabela,
            'acao' => $acao,
            'sql' => $sql,
            'ip' => $this->input->ip_address()
        );

        $this->db->set($data)->insert('logs_acoes');
        return $this->db->insert_id();
    }    
    
}

?>

