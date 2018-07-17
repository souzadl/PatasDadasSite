<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adotaveis extends CI_Controller {

    public function index($url, $id) {
        $this->load->model('Adotaveis_model', 'model');

        $animal = $this->model->getAnimal($id);

        $tipo = "";
        $sexo = "";

        if ($animal->tipo == 'C')
            $tipo = "Cão";
        else
            $tipo = "Gato";
        if ($animal->sexo == "M")
            $sexo = "Macho";
        else
            $sexo = "Fêmea";

        $data = array(
            'titulo' => "$animal->nome, $tipo, $sexo - Adotáveis - Patas Dadas",
            'description' => "$animal->temperamento $animal->observacao",
            'keywords' => "$animal->nome, $tipo, @$sexo, adote, adotaveis, patas dadas",
            'imageog' => base_url() . "assets/uploads/animais/" . $animal->foto,
            'page' => 'adotaveis',
            'pageCheck' => 'adotaveisvisualizar',
            'conteudo' => $this->model->getConteudo(1),
            'next' => $this->model->getNext($id),
            'previous' => $this->model->getPrevious($id),
            'animal' => $this->model->getAnimal($id),
            'fotos' => $this->model->getFotos($id)
        );

        $this->load->view('adotavel.php', $data);
    }

    public function gererate_array_to_wp($code) {
        if ($code == '987') {
            $this->load->model('Adotaveis_model', 'model');

            $animais = $this->model->getAnimaisWp();
            $animais = serialize($animais);
            print_r($animais);
            exit;
        }
    }

    public function lista() {
        $this->load->model('Adotaveis_model', 'model');

        $data = array(
            'titulo' => 'Adotáveis - Patas Dadas',
            'description' => 'Entre seu amigo, adote!',
            'keywords' => 'encontre seu amigo, adote, amigo, patas dadas, ong, adoção, adoção de animais, animais, cães, gatos',
            'pagescript' => 'listaadotaveis',
            'page' => 'adotaveis',
            'conteudo' => $this->model->getConteudo(1),
            'animais' => $this->model->getAnimais()
        );

        $this->load->view('adotaveis', $data);
    }

    public function apadrinhar($idTipo, $id_animal) {
        $this->load->model('Adotaveis_model', 'model');

        $data = array(
            'titulo' => 'a',
            'page' => 'adotaveis',
            'padrinho' => $this->model->getApadrinhamentoTipo($idTipo),
            'id_animal' => $id_animal
        );

        $this->load->view('includes/adocoes.ajax.php', $data);
    }

    public function adocao() {
        $this->load->model('Adotaveis_model', 'model');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

        $ani = $this->model->getAnimal($this->input->post('id_animal'));

        if ($this->form_validation->run() == FALSE):

            $titlePrev = $this->utilidades->sanitize_title_with_dashes($ani->nome);
            $url = site_url() . "adotaveis/$titlePrev/$ani->id_animal";
            redirect($url . "/adocao-nao-realizada");

        else:



            $data = array(
                'data_alteracao' => date("Y-m-d H:i:s"),
                'ip' => $this->input->ip_address(),
                'user_agent' => $this->input->user_agent(),
                'origem_url' => $_SESSION['url'],
                'origem_campanha' => $_SESSION['origem'],
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'telefone' => $this->input->post('telefone'),
                'id_animal' => $this->input->post('id_animal')
            );

            try {
                $id = $this->model->setAdocao($data);

                //Inicia o envio do email
                //===================================================================

                $configGmail = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'dadaspataspoa@gmail.com',
                    'smtp_pass' => '#n9.97483615[[Y',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                );

                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.patasdadas.com.br',
                    'smtp_port' => 587,
                    'smtp_user' => 'noreply@patasdadas.com.br',
                    'smtp_pass' => 'salsal13',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                );
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                $this->load->library('email', $config);

                //Inicio da Mensagem
                $name = $this->input->post('nome');
                $email = $this->input->post('email');
                $phone = $this->input->post('telefone');
                $animal = $this->model->getAnimal($this->input->post('id_animal'));
                $data = date("d/m/Y H:i:s");

                ob_start();
                ?>
                <html>
                    <head>
                        <title>Patas Dadas</title>
                    </head>
                    <body>
                        <table>
                            <tr align="center">
                                <td align="center" colspan="2">
                                    <a target="_blank" href="http://www.patasdadas.com.br/">
                                        <img width="140px" border="0" alt="PatasDadas" src="http://www.patasdadas.com.br/assets/public/img/patasdadas-header-logo.png">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>Intenção de ADOÇÃO enviada em <?php echo $data; ?></td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Nome:</td>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <td>Telefone:</td>
                                <td><?php echo $phone; ?></td>
                            </tr>
                            <tr>
                                <td>Animal:</td>
                                <td>
                <?php echo $animal->nome; ?><br/>
                                    <img width="400px;" src="<?= base_url() ?>assets/uploads/animais/<?= $animal->foto ?>">

                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan='2'>This is an automatic message, please do not reply it.</td>
                            </tr>
                        </table>
                    </body>
                </html>
                <?php
                $conteudo = ob_get_contents();
                ob_end_clean();
                //Fim da Mensagem


                $this->email->from("noreply@patasdadas.com.br", "Patas Dadas");
                $this->email->to('adocoes@patasdadas.com.br');
                $this->email->cc('engel.laureen@gmail.com');
                $this->email->bcc('freibergergarcia@gmail.com');

                $this->email->reply_to("$email");

                $this->email->subject("[ADOÇÕES] $ani->nome - Intenção enviada pelo website");
                $this->email->message("$conteudo");
                $this->email->send();

                //===================================================================
                //Termina o envio do email

                $titlePrev = $this->utilidades->sanitize_title_with_dashes($ani->nome);
                $url = site_url() . "adotaveis/$titlePrev/$ani->id_animal";
                redirect($url . "/adocao-realizada");
            } catch (Exception $e) {
                show_error($e->getMessage());
            }

        endif;
    }

    public function apadrinhamento() {
        $this->load->model('Adotaveis_model', 'model');

        $nome = $this->input->post('nome');
        $email = $this->input->post('email');

        $tipo_apadrinhamento = $this->model->getApadrinhamentoTipo($this->input->post('id_apadrinhamento_tipo'));

        $animal = $this->model->getAnimal($this->input->post('id_animal'));
        $titlePrev = $this->utilidades->sanitize_title_with_dashes($animal->nome);

        $urlReturn = site_url() . "adotaveis/$titlePrev/$animal->id_animal/apadrinhamento-realizado";

        $dataPadrinho = array(
            'data_alteracao' => date("Y-m-d H:i:s"),
            'nome' => $nome,
            'email' => $email
        );
        $padrinho = $this->model->checkPadrinho($email);
        if (@$padrinho) {
            $idPadrinho = $padrinho->id_padrinho;
        } else {
            $idPadrinho = $this->model->setPadrinho($dataPadrinho);
        }


        $dataApa = array(
            'data_alteracao' => date("Y-m-d H:i:s"),
            'id_apadrinhamento_tipo' => $this->input->post('id_apadrinhamento_tipo'),
            'id_animal' => $this->input->post('id_animal'),
            'id_padrinho' => $idPadrinho,
            'status' => 'waiting'
        );
        $idApadrinhamento = $this->model->setApadrinhamento($dataApa);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'application/x-www-form-urlencoded',
            'charset=utf-8'
        ));

        if ($tipo_apadrinhamento->periodicidade == 'U') {
            curl_setopt($ch, CURLOPT_URL, "https://ws.pagseguro.uol.com.br/v2/checkout");
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'email' => "engel.laureen@gmail.com",
                'token' => "3A641C47DFF542E6A26974069E5DF5E6",
                'currency' => "BRL",
                'senderName' => $nome,
                'senderEmail' => $email,
                'itemId1' => $idApadrinhamento,
                'itemDescription1' => "PATAS DADAS - Pagamento de apadrinhamento de $tipo_apadrinhamento->tipo_apadrinhamento",
                'itemAmount1' => $tipo_apadrinhamento->valor,
                'itemQuantity1' => "1",
                'itemWeight1' => "0",
                'reference' => $idApadrinhamento,
                'redirectURL' => $urlReturn
            )));
        } else {
            if ($tipo_apadrinhamento->periodicidade == 'A') {
                $periodicidade = "YEARLY";
            }
            if ($tipo_apadrinhamento->periodicidade == 'M') {
                $periodicidade = "MONTHLY";
            }
            if ($tipo_apadrinhamento->periodicidade == 'W') {
                $periodicidade = "WEEKLY";
            }
            if ($tipo_apadrinhamento->periodicidade == 'T') {
                $periodicidade = "TRIMONTHLY";
            }
            if ($tipo_apadrinhamento->periodicidade == 'S') {
                $periodicidade = "SEMIANNUALLY";
            }

            $year = date('Y') + 1;
            $data = $year . date("-m-d\TH:i:s.000P");

            curl_setopt($ch, CURLOPT_URL, "https://ws.pagseguro.uol.com.br/v2/pre-approvals/request");
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'email' => "engel.laureen@gmail.com",
                'token' => "3A641C47DFF542E6A26974069E5DF5E6",
                'currency' => "BRL",
                'senderName' => $nome,
                'senderEmail' => $email,
                'preApprovalName' => $tipo_apadrinhamento->tipo_apadrinhamento,
                'preApprovalDetails' => "PATAS DADAS - Assinatura de apadrinhamento de $tipo_apadrinhamento->tipo_apadrinhamento",
                'preApprovalAmountPerPayment' => $tipo_apadrinhamento->valor,
                'preApprovalPeriod' => $periodicidade,
                'preApprovalFinalDate' => $data,
                'preApprovalMaxTotalAmount' => '10000.00',
                'preApprovalCharge' => "auto",
                'reference' => $idApadrinhamento,
                'redirectURL' => $urlReturn
            )));
        }

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        $xml = simplexml_load_string($server_output);

        if (count($xml->error) > 0) {
            print_r($xml);
        } else {
            $this->model->updateApadrinhamento($idApadrinhamento, $xml->code);
            if ($tipo_apadrinhamento->periodicidade == 'U') {
                header("Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=" . $xml->code);
            } else {
                header("Location: https://pagseguro.uol.com.br/v2/pre-approvals/request.html?code=" . $xml->code);
            }
        }
    }

}
