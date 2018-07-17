<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Adoções <button onclick="location.href='<?=base_url()?>admin.php/adocoes/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ adocao</button></h1>
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
                        Cadastro de Adoções
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php if(@$adocoes): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="20%">Animal</th>
                                        <th width="20%">Quem enviou?</th>
                                        <th width="15%">E-mail</th>
                                        <th width="20%">Data Atualização</th>
                                        <th width="15%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($adocoes as $row) { ?>
                                    <tr id="item-<?=$row->id_adocao?>">
	                                    <td><?=$row->id_adocao?></td>
                                        <td><?=$row->Animal?></td>
                                        <td><?=$row->Adotador;?></td>
                                        <td><?=$row->email;?></td>
                                        <td><?=$row->data_alteracao;?></td>
                                        <td><button data-toggle="modal" data-target="#myModal<?=$row->id_adocao?>" class="btn btn-primary btn-xs" href="<?=base_url()?>admin.php/adocoes/visualizar/<?=$row->id_adocao?>" type="button">Visualizar</button></td>
                                    </tr>
                                    <!-- Modal -->
									<div class="modal fade" id="myModal<?=$row->id_adocao?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									    <div class="modal-dialog">
									        <div class="modal-content">
									            <div class="modal-header">
									                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									                 <h4 class="modal-title">Modal title</h4>
									
									            </div>
									            <div class="modal-body"><div class="te" id="conteudoModal"></div></div>
									            <div class="modal-footer">
									                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									                <button type="button" class="btn btn-primary">Save changes</button>
									            </div>
									        </div>
									        <!-- /.modal-content -->
									    </div>
									    <!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <?php else: ?>
                        <p>Nenhuma adoção encontrada</p>
                        <?php endif; ?>
                    </div>
                    
                    
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div>
                	<?//$paginacao?>
                </div>
            </div>
            <!-- /.col-lg-6 -->
        </div>            
	</div>


<?php $this->load->view('includes/footer.php'); ?>