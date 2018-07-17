<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Conteúdos <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Conteúdos                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormMidia" role="form" method="post" action="<?=base_url()?>admin.php/dashboard/salvarConteudo" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_conteudo" value="<?=@$conteudo->id_conteudo?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Link da Facebook Page</label>
		                                <input tabindex="1" class="form-control" name="facebook" placeholder="Link para a página do Facebook" value="<?=@$conteudo->facebook?>">
		                            </div>  
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Foto da página de QUEM SOMOS</label>
			                                <input tabindex="3" name="imagem" type="file">
			                                <?php if(@$conteudo->imagem): ?>
			                                <br/><img src="<?=base_url()?>assets/uploads/conteudos/<?=$conteudo->imagem?>" style="width:20%;">
			                                <?php endif; ?>
			                            </div>
									</div>
									
									<div class="form-group">   
		                                <label>E-mail</label>
		                                <input tabindex="5" class="form-control" name="email" placeholder="Digite o e-mail" value="<?=@$conteudo->email?>">
		                            </div>                                  
								</div>

								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Link da Twitter Page</label>
		                                <input tabindex="2" class="form-control" name="twitter" placeholder="Link para a página do Twitter" value="<?=@$conteudo->twitter?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Link do Instagram Page</label>
		                                <input tabindex="4" class="form-control" name="instagram" placeholder="Link para a página do Instagram" value="<?=@$conteudo->instagram?>">
		                            </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Última prestação de contas</label>
			                                <input tabindex="6" name="arquivo" type="file">
			                                <?php if(@$conteudo->arquivo): ?>
			                                <br/><a target="_blank" href="<?=base_url()?>assets/uploads/conteudos/<?=$conteudo->arquivo?>"><?=$conteudo->arquivo?></a>
			                                <?php endif; ?>
			                            </div>
									</div>
									  
								</div>
		                    </div>
		                    
		                    <div class="form-group">
								<label>Missão</label>
								<textarea tabindex="7" class="form-control" name="missao" rows="5"><?=@$conteudo->missao?></textarea>
							</div>
							
							<div class="form-group">
								<label>História</label>
								<textarea tabindex="8" class="form-control" name="historia" rows="5"><?=@$conteudo->historia?></textarea>
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