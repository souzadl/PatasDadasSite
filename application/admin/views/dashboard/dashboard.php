<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard <!--<button onclick="location.href='<?=base_url()?>admin.php/magics/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ agendar novo curso</button>--></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
	        <div class="col-lg-4 col-md-6">
	            <div class="panel panel-primary">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-paw fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge"><?=@$animais?></div>
	                            <div>animais</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="<?=base_url()?>admin.php/animais/lista">
	                    <div class="panel-footer">
	                        <span class="pull-left">Veja os detalhes</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>

	        <div class="col-lg-4 col-md-6">
	            <div class="panel panel-red">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-frown-o fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge"><?=@$disponiveis?></div>
	                            <div>disponíveis</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="<?=base_url()?>admin.php/animais/listaDisponiveis">
	                    <div class="panel-footer">
	                        <span class="pull-left">Veja os detalhes</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>
	        <div class="col-lg-4 col-md-6">
	            <div class="panel panel-green">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-check-square-o fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge"><?=@$adotados?></div>
	                            <div>adotados</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="<?=base_url()?>admin.php/animais/listaAdotados">
	                    <div class="panel-footer">
	                        <span class="pull-left">Veja os detalhes</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>

	    </div>
	    



<?php $this->load->view('includes/footer.php'); ?>