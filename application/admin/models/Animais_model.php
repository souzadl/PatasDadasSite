<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Animais_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getPermissoes() {
        $this->db->flush_cache();

        $id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));
        $sql = "SELECT *
				FROM permissoes
				WHERE id_usuario = $id_usuario
			   ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function inserirLogAcoes($tabela, $acao, $sql) {
        $id_usuario = $this->encrypt->decode($this->session->userdata('lavie_id_usuario'));

        $data = array(
            'data_hora' => date('Y-m-d H:i:s'),
            'id_usuario' => $id_usuario,
            'tabela' => $tabela,
            'acao' => $acao,
            'sql' => $sql,
            'ip' => $this->input->ip_address()
        );

        $this->db->set($data)->insert('logs_acoes');
        return $this->db->insert_id();
    }

    //=======================================================================
    //Outras Funções=========================================================
    //=======================================================================	

    function numAnimais() {
        $this->db->select('*')->from('animais');

        return $this->db->count_all_results();
    }

    function getAnimais($offset = 0) {
        $this->db->flush_cache();
        $this->db->select('*')->from('animais')->order_by('nome', 'asc');

        return $this->db->get();
    }

    function getAnimaisCondicao($condicao = "") {
        $this->db->flush_cache();
        $this->db->select('*')->from('animais')->where('condicao', $condicao)->order_by('nome', 'asc');

        return $this->db->get();
    }

    function getPadrinhos() {
        $this->db->flush_cache();
        $this->db->select('*')->from('padrinhos')->order_by('nome', 'asc');

        return $this->db->get();
    }

    function getFotos($id_animal) {
        $where = array('id_animal' => $id_animal);
        $this->db->select('*')->from('animais_galeria')->where($where);

        $query = $this->db->get();
        return $query->result();
    }
    
    function getVacinas($id_animal) {
        /*
          $where = array ('id_animal' => $id_animal);
          $this->db->select('*')->from('animais_valores')->where($where);

          $query = $this->db->get();
          return $query->result();
         */

        $this->db->flush_cache();

        $sql = "SELECT *
				FROM animais a, animais_vacinas v
				WHERE a.id_animal = v.id_animal
				AND v.id_animal = $id_animal
			   ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getVacina($id_animal_vacina) {
        $where = array('id_animal_vacina' => $id_animal_vacina);
        $this->db->select('*')->from('animais_vacinas')->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    function getAnimal($id_animal) {
        $where = array('id_animal' => $id_animal);
        $this->db->select('*')->from('animais')->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    function getImagemAnimal($id_animal_galeria) {
        $where = array('id_animal_galeria' => $id_animal_galeria);
        $this->db->select('*')->from('animais_galeria')->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    function setAnimalApadrinhamento($data, $id_animal = "") {
        $this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');

        $this->db->set($data);
        $this->db->where('id_animal', $id_animal);
        $this->db->update('animais');

        //Log Acesso
        $acao = "update";
        $tabela = "animais";
        $sql = $this->db->last_query();
        $this->model->inserirLogAcoes($tabela, $acao, $sql);
        //Log Acesso  
    }

    function setAnimal($data, $id_animal = "") {
        $this->load->library('utilidades');

        if ($id_animal) {
            $where = array('id_animal' => $id_animal);
            $this->db->select('*')->from('animais')->where($where);

            if (!$this->db->count_all_results()) {
                throw new Exception('Acesso negado.');
            } else {
                $this->load->library('image_lib');
                $this->load->library('upload');

                $upload = "";
                //=====================================================================
                //INICIO UPLOAD CAPA
                //=====================================================================
                $beautifulFileName = $this->utilidades->sanitize_title_with_dashes($data['nome']) . "-" . date("dmyHis");

                $config['upload_path'] = './assets/uploads/animais';
                $config['allowed_types'] = 'gif|jpg|png|bmp';
                $config['max_size'] = '10000';
                $config['max_width'] = '6000';
                $config['max_height'] = '6000';
                $config['encrypt_name'] = FALSE;
                $config['file_name'] = $beautifulFileName;
                $config['overwrite'] = FALSE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto')) {
                    $imagem = $this->getAnimal($id_animal);
                    if ($imagem->foto) {
                        unlink('./assets/uploads/animais/' . $imagem->foto);
                    }
                    $file_data = $this->upload->data();

                    $file_name = $file_data['file_name'];
                    $file_size = $file_data['file_size'];

                    $beautifulFileName = $beautifulFileName . $file_data['file_ext'];

                    //chmod ($file_data['full_path'], 777);
                    //echo $file_data['full_path'];
                    // exit;
                    //ZOOM
                    $configR['image_library'] = 'GD2';
                    $configR['source_image'] = $file_data['full_path'];
                    $configR['create_thumb'] = FALSE;
                    $configR['maintain_ratio'] = TRUE;
                    $configR['new_image'] = $file_data['full_path'];
                    $configR['width'] = 800;
                    $configR['height'] = 650;
                    $configR['quality'] = 100;


                    $this->image_lib->initialize($configR);

                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }


                    $this->db->set('foto', $beautifulFileName);
                }
                //=====================================================================
                //FIM UPLOAD DA CAPA
                //=====================================================================			

                $this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');

                $this->db->set($data);
                $this->db->where('id_animal', $id_animal);
                $this->db->update('animais');

                //Log Acesso
                $acao = "update";
                $tabela = "animais";
                $sql = $this->db->last_query();
                $this->model->inserirLogAcoes($tabela, $acao, $sql);
                //Log Acesso  
            }
            //exit;

            return $id_animal;
        } else {
            $this->load->library('image_lib');
            $this->load->library('upload');

            $upload = "";
            //=====================================================================
            //INICIO UPLOAD CAPA
            //=====================================================================
            $beautifulFileName = $this->utilidades->sanitize_title_with_dashes($data['nome']) . "-" . date("dmyHis");

            $config['upload_path'] = './assets/uploads/animais';
            $config['allowed_types'] = 'gif|jpg|png|bmp';
            $config['max_size'] = '10000';
            $config['max_width'] = '6000';
            $config['max_height'] = '6000';
            $config['encrypt_name'] = FALSE;
            $config['file_name'] = $beautifulFileName;
            $config['overwrite'] = FALSE;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto')) {
                $imagem = $this->getAnimal($id_animal);
                if ($imagem->foto) {
                    unlink('./assets/uploads/animais/' . $imagem->foto);
                }
                $file_data = $this->upload->data();

                $file_name = $file_data['file_name'];
                $file_size = $file_data['file_size'];

                $beautifulFileName = $beautifulFileName . $file_data['file_ext'];

                //ZOOM
                $configR['image_library'] = 'GD2';
                $configR['create_thumb'] = FALSE;
                $configR['source_image'] = $file_data['full_path'];
                $configR['maintain_ratio'] = TRUE;
                $configR['new_image'] = $file_data['full_path'];
                $configR['width'] = 800;
                $configR['height'] = 650;
                $configR['quality'] = 100;

                $this->image_lib->initialize($configR);
                $this->image_lib->resize();

                $this->db->set('foto', $beautifulFileName);
            }
            //=====================================================================
            //FIM UPLOAD DA CAPA
            //=====================================================================	
            $this->db->set($data)->insert('animais');

            $this->session->set_flashdata('resposta', 'Animal adicionado com sucesso (:');

            //Log Acesso
            $acao = "insert";
            $tabela = "animais";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 			

            return $this->db->insert_id();
        }
    }

    function setVacinaAnimal($data, $id_animal_vacina = "") {
        if ($id_animal_vacina) {
            $where = array('id_animal_vacina' => $id_animal_vacina);
            $this->db->select('*')->from('animais_vacinas')->where($where);

            if (!$this->db->count_all_results()) {
                throw new Exception('Acesso negado.');
            } else {
                $this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');

                $this->db->set($data);
                $this->db->where('id_animal_vacina', $id_animal_vacina);
                $this->db->update('animais_vacinas');

                //Log Acesso
                $acao = "update";
                $tabela = "animais_vacinas";
                $sql = $this->db->last_query();
                $this->model->inserirLogAcoes($tabela, $acao, $sql);
                //Log Acesso                 
            }

            return $id_animal_vacina;
        } else {
            $this->db->set($data)->insert('animais_vacinas');
            $this->session->set_flashdata('resposta', 'Vacina adicionada com sucesso (:');

            //Log Acesso
            $acao = "insert";
            $tabela = "animais_vacinas";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 			

            return $this->db->insert_id();
        }
    }

    function setGaleriaAnimal($id_animal, $animal) {
        $this->load->library('utilidades');

        if ($id_animal) {
            $where = array('id_animal' => $id_animal);
            $this->db->select('*')->from('animais')->where($where);

            if (!$this->db->count_all_results()) {
                throw new Exception('Acesso negado.');
            } else {
                $this->load->library('image_lib');
                $this->load->library('upload');

                $upload = "";
                //=====================================================================
                //INICIO UPLOAD DAS IMAGENS
                //=====================================================================

                $files = $_FILES;
                $cpt = count($_FILES['imagem']['name']);

                /*
                  echo "<pre>";
                  print_r($_FILES);
                  echo "</pre>";
                  //exit;
                 */

                for ($i = 0; $i < $cpt; $i ++) {
                    $beautifulFileName = $this->utilidades->sanitize_title_with_dashes($animal->nome) . "-" . date("dmyHis") . "-" . $i;

                    $config[$i]['upload_path'] = './assets/uploads/animais/galeria';
                    $config[$i]['allowed_types'] = 'gif|jpg|png|bmp';
                    $config[$i]['max_size'] = '10000';
                    $config[$i]['max_width'] = '10000';
                    $config[$i]['max_height'] = '10000';
                    $config[$i]['encrypt_name'] = FALSE;
                    $config[$i]['file_name'] = $beautifulFileName;
                    $config[$i]['overwrite'] = FALSE;

                    $_FILES['imagem']['name'] = $files['imagem']['name'][$i];
                    $_FILES['imagem']['type'] = $files['imagem']['type'][$i];
                    $_FILES['imagem']['tmp_name'] = $files['imagem']['tmp_name'][$i];
                    $_FILES['imagem']['error'] = $files['imagem']['error'][$i];
                    $_FILES['imagem']['size'] = $files['imagem']['size'][$i];

                    $this->upload->initialize($config[$i]);


                    if ($this->upload->do_upload('imagem')) {
                        //$file_data = $this->upload->data();

                        $file_name = $files['imagem']['name'][$i];
                        $file_size = $files['imagem']['size'][$i];

                        $file_data[$i] = $this->upload->data();

                        $beautifulFileName = $beautifulFileName . $file_data[$i]['file_ext'];

                        $this->db->set('imagem', $beautifulFileName);
                        $this->db->set('id_animal', $id_animal);
                        $this->db->insert('animais_galeria');

                        $configRz[$i]['image_library'] = 'GD2';
                        $configRz[$i]['source_image'] = $file_data[$i]['full_path'];
                        $configRz[$i]['create_thumb'] = FALSE;
                        $configRz[$i]['maintain_ratio'] = TRUE;
                        $configRz[$i]['new_image'] = $file_data[$i]['full_path'];
                        $configRz[$i]['width'] = 850;
                        $configRz[$i]['height'] = 650;

                        $this->image_lib->initialize($configRz[$i]);
                        $this->image_lib->resize();

                        //Log Acesso
                        $acao = "insert";
                        $tabela = "animais_galeria";
                        $sql = $this->db->last_query();
                        $this->model->inserirLogAcoes($tabela, $acao, $sql);
                        //Log Acesso 
                    } else {
                        //$data2 = array('upload_data' => $this->upload->data());
                        $error = array('error' => $this->upload->display_errors());
                        echo "<pre>";

                        print_r($error);

                        echo "</pre>";
                        exit;
                    }

                    //=====================================================================
                    //FIM UPLOAD DAS IMAGENS
                    //=====================================================================
                }
            }
        }
    }

    function delAnimal($id_animal) {
        $where = array('id_animal' => $id_animal);
        $this->db->select('*')->from('animais')->where($where);

        if (!$this->db->count_all_results()) {
            throw new Exception('Acesso negado.');
        } else {
            $imagem = $this->getAnimal($id_animal);
            if ($imagem->foto) {
                unlink('./assets/uploads/animais/' . $imagem->foto);
            }

            $this->db->where('id_animal', $id_animal);
            $this->db->delete('animais');

            //Log Acesso
            $acao = "delete";
            $tabela = "animais";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 

            $this->session->set_flashdata('resposta', 'Animal excluído com sucesso (:');
        }
    }

    function delVacina($id_animal_vacina) {
        $where = array('id_animal_vacina' => $id_animal_vacina);
        $this->db->select('*')->from('animais_vacinas')->where($where);

        if (!$this->db->count_all_results()) {
            throw new Exception('Acesso negado.');
        } else {
            $this->db->where('id_animal_vacina', $id_animal_vacina);
            $this->db->delete('animais_vacinas');

            //Log Acesso
            $acao = "delete";
            $tabela = "animais_vacinas";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 

            $this->session->set_flashdata('resposta', 'Plano / Valor excluído com sucesso!');
        }
    }

    function delFoto($id_animal_galeria) {
        $where = array('id_animal_galeria' => $id_animal_galeria);
        $this->db->select('*')->from('animais_galeria')->where($where);

        if (!$this->db->count_all_results()) {
            throw new Exception('Acesso negado.');
        } else {
            $imagem = $this->getImagemAnimal($id_animal_galeria);
            if ($imagem->imagem) {
                unlink('./assets/uploads/animais/galeria/' . $imagem->imagem);
            }

            $this->db->where('id_animal_galeria', $id_animal_galeria);
            $this->db->delete('animais_galeria');

            //Log Acesso
            $acao = "delete";
            $tabela = "animais_galeria";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 

            $this->session->set_flashdata('resposta', 'Foto excluída com sucesso!');
        }
    }

    function updateOrder($ordem, $id) {
        $this->db->set('order', $ordem);
        $this->db->where('id_animal', $id);
        $this->db->update('animais');
    }

    // == vermifugos
    function getVermifugos($id_animal) {
        /*
          $where = array ('id_animal' => $id_animal);
          $this->db->select('*')->from('animais_valores')->where($where);

          $query = $this->db->get();
          return $query->result();
         */

        $this->db->flush_cache();

        $sql = "SELECT *
				FROM animais a, animais_vermifugos v
				WHERE a.id_animal = v.id_animal
				AND v.id_animal = $id_animal
			   ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function getVermifugo($id_animal_vermifugo) {
        $where = array('id_animal_vermifugo' => $id_animal_vermifugo);
        $this->db->select('*')->from('animais_vermifugos')->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    function setVermifugoAnimal($data, $id_animal_vermifugo = "") {
        if ($id_animal_vermifugo) {
            $where = array('id_animal_vermifugo' => $id_animal_vermifugo);
            $this->db->select('*')->from('animais_vermifugos')->where($where);

            if (!$this->db->count_all_results()) {
                throw new Exception('Acesso negado.');
            } else {
                $this->session->set_flashdata('resposta', 'Informações editadas com sucesso (:');

                $this->db->set($data);
                $this->db->where('id_animal_vermifugo', $id_animal_vermifugo);
                $this->db->update('animais_vermifugos');

                //Log Acesso
                $acao = "update";
                $tabela = "animais_vermifugos";
                $sql = $this->db->last_query();
                $this->model->inserirLogAcoes($tabela, $acao, $sql);
                //Log Acesso                 
            }

            return $id_animal_vermifugo;
        } else {
            $this->db->set($data)->insert('animais_vermifugos');
            $this->session->set_flashdata('resposta', 'Vermifugo adicionada com sucesso (:');

            //Log Acesso
            $acao = "insert";
            $tabela = "animais_vermifugos";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 			

            return $this->db->insert_id();
        }
    }

    function delVermifugo($id_animal_vermifugo) {
        $where = array('id_animal_vermifugo' => $id_animal_vermifugo);
        $this->db->select('*')->from('animais_vermifugos')->where($where);

        if (!$this->db->count_all_results()) {
            throw new Exception('Acesso negado.');
        } else {
            $this->db->where('id_animal_vermifugo', $id_animal_vermifugo);
            $this->db->delete('animais_vermifugos');

            //Log Acesso
            $acao = "delete";
            $tabela = "animais_vermifugos";
            $sql = $this->db->last_query();
            $this->model->inserirLogAcoes($tabela, $acao, $sql);
            //Log Acesso 

            $this->session->set_flashdata('resposta', 'Plano / Valor excluído com sucesso!');
        }
    }

}

/* End of file contatos_model.php */
/* Location: ./system/application/model/contatos_model.php */