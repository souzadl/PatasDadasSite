<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Perguntas e Respostas <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
                        Cadastro de Perguntas e Respostas                         
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
	                    <form id="FormFaq" role="form" method="post" action="<?=base_url()?>admin.php/faqs/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_faq" value="<?=@$faq->id_faq?>">
		                    
							<div class="form-group">   
                                <label>Pergunta</label>
                                <input tabindex="1" class="form-control" name="pergunta" placeholder="Digite a pergunta aqui" value="<?=@$faq->pergunta?>" required>
                            </div>
                            
                            <div class="form-group">   
                                <label>Resposta</label>
                                <textarea tabindex="2" class="form-control" name="resposta" rows="6" required><?=@$faq->resposta?></textarea>
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