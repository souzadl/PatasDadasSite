<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mídias <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Mídias                           
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormMidia" role="form" method="post" action="<?=base_url()?>admin.php/midias/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_midia" value="<?=@$midia->id_midia?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">
			                            <?php
				                        	//$postDt = $this->input->post('data_nascimento');
											//$postDt = str_replace('/', '-', $postDt);
											if(@$midia->data) { $data = date('d/m/Y', strtotime(@$midia->data)); }  
				                        ?>     
		                                <label>Data</label>
		                                <input data-date-format="dd/mm/yyyy" tabindex="1" class="form-control datepicker" name="data" placeholder="Selecione a data" value="<?=@$data?>">
		                            </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Imagem</label>
			                                <input tabindex="3" name="imagem" type="file">
			                                <?php if(@$midia->imagem): ?>
			                                <br/><img src="<?=base_url()?>assets/uploads/midias/<?=$midia->imagem?>" style="width:20%;">
			                                <?php endif; ?>
			                            </div>
									</div>
									
									<div class="form-group">   
		                                <label>Link</label>
		                                <input tabindex="2" class="form-control" name="link" placeholder="Link para o site do midia" value="<?=@$midia->link?>">
		                            </div>                                  
								</div>

								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Título</label>
		                                <input tabindex="2" class="form-control" name="titulo" placeholder="Digite o nome da midia" value="<?=@$midia->titulo?>" required>
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Tipo (redirecionar para?)</label>
		                                <select tabindex="4" name="tipo" class="form-control" required>
			                                <option value="">Selecione</option>
		                                	<option <?php if(@$midia->tipo == "L") echo "selected='selected'"; ?> value="L">Link</option>
		                                	<option <?php if(@$midia->tipo == "A") echo "selected='selected'"; ?> value="A">Arquivo</option>
		                                </select>
		                            </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Arquivo</label>
			                                <input tabindex="6" name="arquivo" type="file">
			                                <?php if(@$midia->arquivo): ?>
			                                <br/><a target="_blank" href="<?=base_url()?>assets/uploads/midias/<?=$midia->arquivo?>"><?=$midia->arquivo?></a>
			                                <?php endif; ?>
			                            </div>
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