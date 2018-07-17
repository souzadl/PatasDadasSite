<?php $this->load->view('includes/header.php'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Animais <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <?php if (@$animal->id_animal): ?>

        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#cadastroAnimais" aria-controls="cadastroAnimais" role="tab" data-toggle="tab">Cadastro de Animais</a></li>
                <?php if (@$animal->id_animal): ?>
                    <li role="presentation"><a href="#galeriaFotos" aria-controls="galeriaFotos" role="tab" data-toggle="tab">Galeria de Fotos</a></li>
                    <li role="presentation"><a href="#apadrinhamento" aria-controls="apadrinhamento" role="tab" data-toggle="tab">Apadrinhamento</a></li>
                    <li role="presentation"><a href="#prontuario" aria-controls="prontuario" role="tab" data-toggle="tab">Prontuário</a></li>
                <?php endif; ?>
            </ul>
                        
            <!--Modais-->
            <?php $this->load->view('animais/doencaCronicaModal.php'); ?>                            
            <?php $this->load->view('animais/alimentacaoEspecialModal.php'); ?>                            
            <?php $this->load->view('animais/deficienciaFisicaModal.php'); ?>                            
            <?php $this->load->view('animais/historicoPesoModal.php'); ?>                            
            <?php $this->load->view('animais/medicacoesModal.php'); ?>                            
            <?php $this->load->view('animais/alteracoesSaudeModal.php'); ?>                            
            <?php $this->load->view('animais/vacinasModal.php'); ?>                            
            <?php $this->load->view('animais/serestosModal.php'); ?>                            
            <?php $this->load->view('animais/vermifugosModal.php'); ?>                            
            <form id="FormAnimal" role="form" method="post" action="<?= base_url() ?>admin.php/animais/salvar" enctype="multipart/form-data">                
                <!-- Tab panes -->
                <div class="tab-content">                   
                    <div role="tabpanel" class="tab-pane active" id="cadastroAnimais">
                       <?php $this->load->view('animais/cadastro.php'); ?>                        
                    </div>
                    <?php if (@$animal->id_animal): ?>
                        <div role="tabpanel" class="tab-pane" id="galeriaFotos">
                           <?php $this->load->view('animais/galeriaFotos.php'); ?>                  
                        </div>
                        <div role="tabpanel" class="tab-pane" id="apadrinhamento">
                           <?php $this->load->view('animais/apadrinhamento.php'); ?>                     
                        </div>
                        <div role="tabpanel" class="tab-pane" id="prontuario">
                            <?php $this->load->view('animais/prontuario.php'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </form>                    
        </div>
    <?php endif; ?>

    <?php if (@$this->session->flashdata('resposta')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('resposta') ?>
        </div>
    <?php endif; ?>      
</div>

<?php $this->load->view('includes/footer.php'); ?>