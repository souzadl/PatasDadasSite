<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pontos de Coleta <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Pontos de Coleta                         
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormPonto" role="form" method="post" action="<?=base_url()?>admin.php/pontos/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_ponto" value="<?=@$ponto->id_ponto?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Ponto de Coleta</label>
		                                <input tabindex="1" class="form-control" name="ponto" placeholder="Digite o ponto de coleta" value="<?=@$ponto->ponto?>" required>
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Cidade</label>
		                                <input tabindex="3" class="form-control" name="cidade" placeholder="Cidade do ponto de coleta" value="<?=@$ponto->cidade?>" required>
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Link</label>
		                                <input tabindex="5" class="form-control" name="link" placeholder="Link para o site do ponto" value="<?=@$ponto->link?>">
		                            </div>
		                            	                                  
								</div>

								<div class="col-lg-6">		                            
		                            <div class="form-group">   
		                                <label>Endereço</label>
		                                <input tabindex="2" class="form-control" name="endereco" placeholder="Endereço do ponto de coleta" value="<?=@$ponto->endereco?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Estado</label>
		                                <input tabindex="4" maxlength="2" class="form-control" name="estado" placeholder="Estado do ponto de coleta" value="<?=@$ponto->estado?>" required>
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