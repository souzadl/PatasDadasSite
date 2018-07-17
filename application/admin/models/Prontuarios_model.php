<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH.'models/Generico_Model.php';
class Prontuarios_model extends Generico_Model {           
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->tabela = 'prontuarios';        
    }    
    
    public function getProntuario($idProntuario){
        $where = array('id_prontuario' => $idProntuario);
        $this->db->select('*')->from($this->tabela)->where($where);
        return $this->db->get()->row();        
    }
    
    public function getProntuarioByAnimal($idAnimal){
        $where = array('id_animal' => $idAnimal);
        $this->db->select('*')->from($this->tabela)->where($where);
        return $this->db->get()->row();        
    }    
    
    public function getHistoricosPeso($id_prontuario){
        $where = array('id_prontuario' => $id_prontuario);
        $this->db->select('*')->from('historicos_peso')->where($where)->order_by('data_afericao', 'asc'); 

        $query = $this->db->get();
        return $query->result();        
    }
    
    public function getDoencasCronicas($id_prontuario){
        $where = array('id_prontuario' => $id_prontuario);
        $this->db->select('*')->from('doencas_cronicas')->where($where)->order_by('descricao', 'asc'); 

        $query = $this->db->get();
        return $query->result();        
    }    

    public function getAlimentacaoEspecial($id_prontuario){
        $where = array('id_prontuario' => $id_prontuario);
        $this->db->select('*')->from('alimentacao_especial')->where($where)->order_by('descricao', 'asc'); 

        $query = $this->db->get();
        return $query->result();        
    }    
    
    public function getDeficienciasFisicas($id_prontuario){
        $where = array('id_prontuario' => $id_prontuario);
        $this->db->select('*')->from('deficiencias_fisicas')->where($where)->order_by('descricao', 'asc'); 

        $query = $this->db->get();
        return $query->result();        
    }    
    
    public function setProntuario($data){
        $where = array('id_animal' => $data['id_animal']);
        $this->db->select('id_prontuario')->from($this->tabela)->where($where); 
        $row = $this->db->get()->row();
        $idProntuario = $row->id_prontuario;
        if (!isset($idProntuario)) {
            $this->inserir($data);
            $this->session->set_flashdata('resposta', 'Prontuário adicionado com sucesso.');
            $idProntuario = $this->db->insert_id();
        }
        return $idProntuario;
    }   
       
}

