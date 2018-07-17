<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Eventos <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Eventos                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormEvento" role="form" method="post" action="<?=base_url()?>admin.php/eventos/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_evento" value="<?=@$evento->id_evento?>">
		                    <div class="row">
								<div class="col-lg-6">
									
									<div class="form-group">
										<?php
				                        	//$postDt = $this->input->post('data_nascimento');
											//$postDt = str_replace('/', '-', $postDt);
											if(@$evento->data) { $dataEvento = date('d/m/Y', strtotime(@$evento->data)); }    
				                        ?>   
		                                <label>Data do evento</label>
		                                <input data-date-format="dd/mm/yyyy" tabindex="1" class="form-control datepicker" name="data" placeholder="Selecione a data do evento" value="<?=@$dataEvento?>">
		                            </div> 
									
									<div class="form-group">   
		                                <label>Local</label>
		                                <input tabindex="3" class="form-control" name="local" placeholder="Digite o local da evento" value="<?=@$evento->local?>" required>
		                            </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Imagem</label>
			                                <input tabindex="5" name="imagem" type="file">
			                                <?php if(@$evento->imagem): ?>
			                                <br/><img src="<?=base_url()?>assets/uploads/eventos/<?=$evento->imagem?>" style="width:20%;">
			                                <?php endif; ?>
			                            </div>
									</div>		                                  
								</div>

								<div class="col-lg-6">		                            
		                            <div class="form-group">   
		                                <label>Horário</label>
		                                <input tabindex="2" class="form-control" name="horario" placeholder="Digite o horário do evento" value="<?=@$evento->horario?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Evento</label>
		                                <input tabindex="4" class="form-control" name="evento" placeholder="Digite o nome do evento" value="<?=@$evento->evento?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Link</label>
		                                <input tabindex="6" class="form-control" name="link" placeholder="Link para o evento" value="<?=@$evento->link?>">
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