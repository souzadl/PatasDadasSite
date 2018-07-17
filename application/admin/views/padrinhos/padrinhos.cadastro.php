<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Padrinhos <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cadastro de Padrinhos                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormPadrinho" role="form" method="post" action="<?=base_url()?>admin.php/padrinhos/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_padrinho" value="<?=@$padrinho->id_padrinho?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Nome</label>
		                                <input tabindex="1" class="form-control" name="nome" placeholder="Digite o nome do padrinho" value="<?=@$padrinho->nome?>" required>
		                            </div>
		                            <div class="form-group">   
		                                <label>Telefone</label>
		                                <input tabindex="3" class="form-control" name="telefone" placeholder="Digite o telefone do padrinho" value="<?=@$padrinho->telefone?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>RG</label>
		                                <input tabindex="5" class="form-control" name="rg" placeholder="Digite o RG do padrinho" value="<?=@$padrinho->rg?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Cidade</label>
		                                <input tabindex="7" class="form-control" name="cidade" placeholder="Digite a cidade do padrinho" value="<?=@$padrinho->cidade?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>CEP</label>
		                                <input tabindex="9" class="form-control" name="cep" placeholder="Digite o cep do padrinho" value="<?=@$padrinho->cep?>">
		                            </div>
		                                                              
								</div>

								<div class="col-lg-6">		                            
		                            
		                            <div class="form-group">   
		                                <label>E-mail</label>
		                                <input type="email" tabindex="2" class="form-control" name="email" placeholder="Digite o e-mail do padrinho" value="<?=@$padrinho->email?>">
		                            </div>	
		                            
		                            <div class="form-group">   
		                                <label>CPF</label>
		                                <input tabindex="4" class="form-control" name="cpf" placeholder="Digite o CPF do padrinho" value="<?=@$padrinho->cpf?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Endereço</label>
		                                <input tabindex="6" class="form-control" name="endereco" placeholder="Digite o endereco do padrinho" value="<?=@$padrinho->endereco?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Estado</label>
		                                <input tabindex="8" class="form-control" name="estado" placeholder="Digite o estado" value="<?=@$padrinho->estado?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Peril do Facebook</label>
		                                <input tabindex="10" class="form-control" name="facebook" placeholder="Digite o perfil do facebook" value="<?=@$padrinho->facebook?>">
		                            </div>
		                             
								</div>
		                    </div>
		                    <div class="form-group">
	                            <input type="submit" id="passsword2" class="btn btn-success" style="float:right;" value="Salvar">
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