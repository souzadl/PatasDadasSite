<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pessoas <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Pessoas                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormPessoa" role="form" method="post" action="<?=base_url()?>admin.php/pessoas/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_pessoa" value="<?=@$pessoa->id_pessoa?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Nome</label>
		                                <input tabindex="1" class="form-control" name="nome" placeholder="Digite o nome da pessoa" value="<?=@$pessoa->nome?>" required>
		                            </div>
		                            <div class="form-group">   
		                                <label>Telefone</label>
		                                <input tabindex="3" class="form-control" name="telefone" placeholder="Digite o telefone da pessoa" value="<?=@$pessoa->telefone?>">
		                            </div>
		                                                              
								</div>

								<div class="col-lg-6">		                            
		                            
		                            <div class="form-group">   
		                                <label>E-mail</label>
		                                <input type="email" tabindex="2" class="form-control" name="email" placeholder="Digite o e-mail da pessoa" value="<?=@$pessoa->email?>">
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