<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Usuários <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php if(@$this->session->flashdata('resposta')): ?>
            <div class="alert alert-success">
               <?=$this->session->flashdata('resposta')?><!--<a class="alert-link" href="#">Alert Link</a>.-->
            </div>
            <?php endif; ?>
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cadastro de Usuários                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        <form id="FormUser" role="form" onsubmit="return ValidaFormUser();" method="post" action="<?=base_url()?>admin.php/usuarios/salvar">
	                           <input type="hidden" name="id_usuario" value="<?=@$usuario->id_usuario?>">
	                           <div class="form-group">
                                    <label>Ativo</label>
                                    
                                    <label class="radio-inline">
                                        <input type="radio" <?php if (@$usuario->ativo == "S"): echo 'checked="checked"'; endif; ?> value="S" id="optionsRadiosInline2" name="ativo">Sim
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" <?php if (@$usuario->ativo == "N"): echo 'checked="checked"'; endif; ?> value="N" id="optionsRadiosInline3" name="ativo">Não
                                    </label>
                                </div>
	                            <div class="form-group">   
	                                <label>Nome</label>
	                                <input class="form-control" name="nome" placeholder="Digite o nome" value="<?=@$usuario->nome?>" required>
	                            </div>
	                            <div class="form-group">
	                                <label>E-mail</label>
	                                <input class="form-control" name="email" placeholder="Digite o e-mail" type="email" value="<?=@$usuario->email?>" required>
	                            </div>
	                            
	                            <div class="form-group">
	                                <label>Senha</label>
	                                <input class="form-control" name="senha" placeholder="Digite a senha" type="password">
	                            </div>
	                            
	                            <div class="form-group">
		                            <input type="submit" id="passsword2" class="btn btn-success" style="float:right;" value="Enviar">
	                            </div>
	                        </form>
                        </div>
                        
                        
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            
	</div>


<?php $this->load->view('includes/footer.php'); ?>