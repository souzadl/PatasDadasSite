<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adotaveis_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getConteudo($id) {
        $this->db->cache_off();
        $sql = "SELECT *
				FROM conteudos
				WHERE id_conteudo = $id
			   ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getAnimais() {
        $this->db->cache_off();
        $this->db->select('*')->from('animais')->where('condicao', 'DI')->order_by('nome', 'asc');

        return $this->db->get();
    }

    public function getAnimaisWp() {
        $this->db->cache_off();
        $sql = "SELECT *
				FROM animais
				WHERE condicao = 'DI'
				ORDER BY RAND()
				LIMIT 12
			   ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getAnimal($id) {
        $this->db->cache_off();
        $this->db->select('*')->from('animais')->where('id_animal', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getApadrinhamentoTipo($id) {
        $this->db->cache_off();
        $this->db->select('*')->from('apadrinhamentos_tipos')->where('id_apadrinhamento_tipo', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function checkPadrinho($email) {
        $this->db->cache_off();
        $this->db->select('*')->from('padrinhos')->where('email', $email);

        $query = $this->db->get();
        return $query->row();
    }

    public function getPadrinho($id) {
        $this->db->cache_off();
        $this->db->select('*')->from('padrinhos')->where('id_padrinho', $id);

        $query = $this->db->get();
        return $query->row();
    }

    function getNext($id) {
        $this->db->cache_off();
        $sql = "select * from animais where condicao = 'DI' AND id_animal > $id ORDER BY id_animal ASC LIMIT 1";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function getPrevious($id) {
        $this->db->cache_off();
        $sql = "select * from animais where condicao = 'DI' AND id_animal < $id ORDER BY id_animal DESC LIMIT 1";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function getFotos($id) {
        $this->db->cache_off();
        $sql = "SELECT *
				FROM animais_galeria
				WHERE id_animal = $id
				ORDER BY id_animal_galeria ASC
			   ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function setPadrinho($dataPadrinho) {
        $this->db->set($dataPadrinho)->insert('padrinhos');
        return $this->db->insert_id();
    }

    function setApadrinhamento($dataApa) {
        $this->db->set($dataApa)->insert('apadrinhamentos');
        return $this->db->insert_id();
    }

    function setAdocao($data) {
        $this->db->set($data)->insert('adocoes');
        return $this->db->insert_id();
    }

    function updateApadrinhamento($idApadrinhamento, $code) {
        $this->db->set('id_pagseguro', $code)->where('id_apadrinhamento', $idApadrinhamento)->update('apadrinhamentos');
        return $this->db->insert_id();
    }

}

/* End of file contatos_model.php */
/* Location: ./system/application/model/welcome_model.php */