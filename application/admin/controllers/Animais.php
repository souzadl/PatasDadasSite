<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Animais extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->check();
    }

    function index() {
        header('Location: admin.php/animais/lista/');
    }

    function lista($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Todos os animais',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimais($offset)
        );

        $this->load->view('animais/animais.php', $data);
    }

    function listaDisponiveis($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Animais disponíveis para adoção',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimaisCondicao('DI')
        );

        $this->load->view('animais/animais.php', $data);
    }

    function listaIndisponiveis($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Animais indisponíveis no momento',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimaisCondicao('I')
        );

        $this->load->view('animais/animais.php', $data);
    }

    function listaAdotados($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Animais adotados',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimaisCondicao('A')
        );

        $this->load->view('animais/animais.php', $data);
    }

    function listaDesaparecidos($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Animais desaparecidos',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimaisCondicao('D')
        );

        $this->load->view('animais/animais.php', $data);
    }

    function listaObitos($offset = "") {
        $this->load->model('animais_model', 'model');
        $this->load->helper('text');

        $data = array(
            'titulo' => 'Animais falecidos',
            'permissoes' => $this->model->getPermissoes(),
            'animais' => $this->model->getAnimaisCondicao('O')
        );

        $this->load->view('animais/animais.php', $data);
    }

    function cadastro() {
        $this->load->model('animais_model', 'model');

        $data = array(
            'permissoes' => $this->model->getPermissoes()
        );

        $this->load->view('animais/animais.cadastro.php', $data);
    }

    function editar($id_animal = 0) {
        $this->load->model('animais_model', 'model');        
        $this->load->model('prontuarios_model', 'prontuario');        

        try {
            $pronturario = $this->prontuario->getProntuarioByAnimal($id_animal);
            $data = array(
                'permissoes' => $this->model->getPermissoes(),
                'animal' => $this->model->getAnimal($id_animal),
                'fotos' => $this->model->getFotos($id_animal),
                'vacinas' => $this->model->getVacinas($id_animal),
                'vermifugos' => $this->model->getVermifugos($id_animal),
                'padrinhos' => $this->model->getPadrinhos(),
                'historicosPeso' => $this->prontuario->getHistoricosPeso(isset($pronturario->id_prontuario) ? $pronturario->id_prontuario : 0),
                'doencasCronicas' => $this->prontuario->getDoencasCronicas(isset($pronturario->id_prontuario) ? $pronturario->id_prontuario : 0),
                'alimentacaoEspecial' => $this->prontuario->getAlimentacaoEspecial(isset($pronturario->id_prontuario) ? $pronturario->id_prontuario : 0),
                'deficienciasFisicas' => $this->prontuario->getDeficienciasFisicas(isset($pronturario->id_prontuario) ? $pronturario->id_prontuario : 0),
                    
            );

            $this->load->view('animais/animais.cadastro.php', $data);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function updateOrder() {
        $this->load->model('animais_model', 'model');

        $i = 0;
        foreach ($this->input->post('item') as $value) {
            $this->model->updateOrder($i, $value);
            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            $i++;
        }
    }

    function editarVacina($id_animal = 0, $id_animal_vacina) {
        $this->load->model('animais_model', 'model');

        try {
            $data = array(
                'permissoes' => $this->model->getPermissoes(),
                'animal' => $this->model->getAnimal($id_animal),
                'fotos' => $this->model->getFotos($id_animal),
                'vermifugos' => $this->model->getVermifugos($id_animal),
                'vacinas' => $this->model->getVacinas($id_animal),
                'vacina' => $this->model->getVacina($id_animal_vacina)
            );

            $this->load->view('animais/animais.cadastro.php', $data);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function visualizar($id_animal = 0) {
        $this->load->model('animais_model', 'model');

        try {
            $data = array(
                'permissoes' => $this->model->getPermissoes(),
                'animal' => $this->model->getAnimal($id_animal),
                'vacinas' => $this->model->getVacinas($id_animal),
                'vermifugos' => $this->model->getVermifugos($id_animal)
            );

            $this->load->view('animais/animais.visualizar.php', $data);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }
       
    function salvarHistoricoPeso(){
        try {
            $this->load->model('historicos_peso_model','historico');       
            $dados['id_prontuario'] = $this->input->post('id_pronturario');
            $dados['id_animal'] = $this->input->post('id_animal');
            $dados['peso'] = $this->input->post('peso');
            $dados['data_afericao'] = $this->StrToDate($this->input->post('data_afericao'));
            $this->historico->setHistorico($dados);       
            echo json_encode($dados);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }    
    
    function apagarHistoricoPeso($id){
        try {
            $this->load->model('historicos_peso_model','historico');     
            $this->historico->delHistorico($id);      
            echo json_encode(true);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }    
    
    function salvarDoencaCronica(){
        try {
            $this->load->model('doencas_cronicas_model','doenca');       
            $dados['id_prontuario'] = $this->input->post('id_pronturario');
            $dados['id_animal'] = $this->input->post('id_animal');
            $dados['descricao'] = $this->input->post('descricao');
            $this->doenca->setDoenca($dados);       
            echo json_encode($dados);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }
    
    function apagarDoencaCronica($id){
        try {
            $this->load->model('doencas_cronicas_model','doenca');       
            $this->doenca->delDoenca($id);      
            echo json_encode(true);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }

    function salvarAlimentacaoEspecial(){
        try {
            $this->load->model('alimentacao_especial_model','alimentacao');       
            $dados['id_prontuario'] = $this->input->post('id_pronturario');
            $dados['id_animal'] = $this->input->post('id_animal');
            $dados['descricao'] = $this->input->post('descricao');
            $this->alimentacao->setAlimentacao($dados);       
            echo json_encode($dados);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }         
    }  
    
    function apagarAlimentacaoEspecial($id){
        try {
            $this->load->model('alimentacao_especial_model','alimentacao');      
            $this->alimentacao->delAlimentacao($id);  
            echo json_encode(true);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }    
    
    function salvarDeficienciaFisica(){
        try {
            $this->load->model('deficiencias_fisicas_model','deficiencia');       
            $dados['id_prontuario'] = $this->input->post('id_pronturario');
            $dados['id_animal'] = $this->input->post('id_animal');
            $dados['descricao'] = $this->input->post('descricao');
            $this->deficiencia->setDeficiencia($dados);       
            echo json_encode($dados);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }         
    }    
    
    function apagarDeficienciaFisica($id){
        try {
            $this->load->model('deficiencias_fisicas_model','deficiencia');       
            $this->deficiencia->delDeficiencia($id);    
            echo json_encode(true);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }        
    }    
    
    private function StrToDate($data){
        $data = str_replace('/', '-', $data);
        return date('Y-m-d', strtotime($data));        
    }

    function salvar() {
        $this->load->model('animais_model', 'model');

        try {
            if ($this->input->post('data_nascimento')) {
                $postDt = $this->input->post('data_nascimento');
                $postDt = str_replace('/', '-', $postDt);
                $nascimento = date('Y-m-d', strtotime($postDt));
            }

            if ($this->input->post('data_condicao')) {
                $postDtC = $this->input->post('data_condicao');
                $postDtC = str_replace('/', '-', $postDtC);
                $condicao = date('Y-m-d', strtotime($postDtC));
            }

            if ($this->input->post('data_aparicao')) {
                $postDtA = $this->input->post('data_aparicao');
                $postDtA = str_replace('/', '-', $postDtA);
                $aparicao = date('Y-m-d', strtotime($postDtA));
            }

            $data = array(
                'data_alteracao' => date("Y-m-d H:i:s"),
                'tipo' => $this->input->post('tipo'),
                'nome' => $this->input->post('nome'),
                'data_nascimento' => @$nascimento,
                'data_aparicao' => @$aparicao,
                'local_aparicao' => $this->input->post('local_aparicao'),
                'sexo' => $this->input->post('sexo'),
                'porte' => $this->input->post('porte'),
                'pelagem' => $this->input->post('pelagem'),
                'condicao' => $this->input->post('condicao'),
                'data_condicao' => @$condicao,
                'temperamento' => $this->input->post('temperamento'),
                'observacao' => $this->input->post('observacao'),
                'observacao_privada' => $this->input->post('observacao_privada'),
                'tratamento' => $this->input->post('tratamento'),
                'perfil_facebook' => $this->input->post('perfil_facebook'),
                'perfil_instagram' => $this->input->post('perfil_instagram'),
                'album_facebook' => $this->input->post('album_facebook'),
                'check_castrado' => $this->input->post('check_castrado'),
                'check_vacinado' => $this->input->post('check_vacinado'),
                'check_vermifugado' => $this->input->post('check_vermifugado')
            );

            $id = $this->model->setAnimal($data, $this->input->post('id_animal'));

            if ($this->input->post('id_animal'))
                redirect('animais/editar/' . $this->input->post('id_animal'));
            else
                redirect('animais/lista');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function apagar($id_animal = 0) {
        $this->load->model('animais_model', 'model');

        try {
            $this->model->delAnimal($id_animal);
            redirect('animais/lista');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function salvarVacina() {
        $this->load->model('animais_model', 'model');

        try {
            $postDtA = $this->input->post('data');
            $postDtA = str_replace('/', '-', $postDtA);
            $dt = date('Y-m-d', strtotime($postDtA));

            $data = array(
                'data_alteracao' => date("Y-m-d H:i:s"),
                'id_animal' => $this->input->post('id_animal'),
                'vacina' => $this->input->post('vacina'),
                'data' => $dt
            );

            $id = $this->model->setVacinaAnimal($data, $this->input->post('id_animal_vacina'));

            redirect('animais/editar/' . $this->input->post('id_animal') . '#VacinasAnchor');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function salvarApadrinhamento() {
        $this->load->model('animais_model', 'model');
        try {
            $data = array(
                'data_alteracao' => date("Y-m-d H:i:s"),
                'padrinho_racao' => $this->input->post('padrinho_racao'),
                'padrinho_castracao' => $this->input->post('padrinho_castracao'),
                'padrinho_vacinas' => $this->input->post('padrinho_vacinas'),
                'padrinho_pulgas' => $this->input->post('padrinho_pulgas')
            );

            $id = $this->model->setAnimalApadrinhamento($data, $this->input->post('id_animal'));

            redirect('animais/editar/' . $this->input->post('id_animal') . '#ApadrinhamentoAnchor');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function salvarImagem() {
        $this->load->model('animais_model', 'model');

        try {
            $insert_id = $this->model->setImagemAnimal($this->input->post('id_animal'));

            if ($this->input->post('id_animal'))
                redirect('animais/editar/' . $this->input->post('id_animal') . '#ImagensAnchor');
            else
                redirect('animais/lista/');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function salvarGaleria() {
        $this->load->model('animais_model', 'model');

        try {
            $animal = $this->model->getAnimal($this->input->post('id_animal'));
            $insert_id = $this->model->setGaleriaAnimal($this->input->post('id_animal'), $animal);

            if ($this->input->post('id_animal'))
                redirect('animais/editar/' . $this->input->post('id_animal') . '#FotosAnchor');
            else
                redirect('animais/lista/');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function excluirFoto($id_animal_foto, $id_animal) {
        $this->load->model('animais_model', 'model');

        try {
            $this->model->delFoto($id_animal_foto);
            redirect("animais/editar/$id_animal#FotosAnchor");
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function apagarVacina($id_animal, $id_animal_vacina) {
        $this->load->model('animais_model', 'model');

        try {
            $this->model->delVacina($id_animal_vacina);
            redirect("animais/editar/$id_animal#VacinasAnchor");
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    //== vermifugos
    function editarVermifugo($id_animal = 0, $id_animal_vermifugo) {
        $this->load->model('animais_model', 'model');

        try {
            $data = array(
                'permissoes' => $this->model->getPermissoes(),
                'animal' => $this->model->getAnimal($id_animal),
                'fotos' => $this->model->getFotos($id_animal),
                'vacinas' => $this->model->getVacinas($id_animal),
                'vermifugos' => $this->model->getVermifugos($id_animal),
                'vermifugo' => $this->model->getVermifugo($id_animal_vermifugo)
            );

            $this->load->view('animais/animais.cadastro.php', $data);
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function salvarVermifugo() {
        $this->load->model('animais_model', 'model');

        try {
            $postDtA = $this->input->post('data');
            $postDtA = str_replace('/', '-', $postDtA);
            $dt = date('Y-m-d', strtotime($postDtA));

            $data = array(
                'data_alteracao' => date("Y-m-d H:i:s"),
                'id_animal' => $this->input->post('id_animal'),
                'vermifugo' => $this->input->post('vermifugo'),
                'data' => $dt
            );

            $id = $this->model->setVermifugoAnimal($data, $this->input->post('id_animal_vermifugo'));

            redirect('animais/editar/' . $this->input->post('id_animal') . '#VermifugosAnchor');
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

    function apagarVermifugo($id_animal, $id_animal_vermifugo) {
        $this->load->model('animais_model', 'model');

        try {
            $this->model->delVermifugo($id_animal_vermifugo);
            redirect("animais/editar/$id_animal#VermifugosAnchor");
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
    }

}

/* End of file Animais.php */
/* Location: ./system/application/controllers/animais.php */