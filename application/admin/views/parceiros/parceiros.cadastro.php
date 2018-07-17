<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Parceiros <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Parceiros                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormParceiro" role="form" method="post" action="<?=base_url()?>admin.php/parceiros/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_parceiro" value="<?=@$parceiro->id_parceiro?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Nome</label>
		                                <input tabindex="1" class="form-control" name="nome" placeholder="Digite o nome da parceiro" value="<?=@$parceiro->nome?>" required>
		                            </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Logo</label>
			                                <input tabindex="3" name="logo" type="file">
			                                <?php if(@$parceiro->logo): ?>
			                                <br/><img src="<?=base_url()?>assets/uploads/parceiros/<?=$parceiro->logo?>" style="width:20%;">
			                                <?php endif; ?>
			                            </div>
									</div>		                                  
								</div>

								<div class="col-lg-6">		                            
		                            <div class="form-group">   
		                                <label>Link</label>
		                                <input tabindex="2" class="form-control" name="link" placeholder="Link para o site do parceiro" value="<?=@$parceiro->link?>">
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