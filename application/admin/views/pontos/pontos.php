<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pontos de Coleta <button onclick="location.href='<?=base_url()?>admin.php/pontos/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ ponto de coleta</button></h1>
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
                        <?php if(@$pontos): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="30%">Ponto</th>
                                        <th>Local</th>
                                        <th width="15%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($pontos->result() as $row) { ?>
                                    <tr id="item-<?=$row->id_ponto?>">
                                        <td><?=$row->id_ponto?></td>
                                        <td><?=$row->ponto;?></td>
                                        <td><?php echo $row->cidade." - ".$row->estado; ?></td>
                                        <td><button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/pontos/editar/<?=$row->id_ponto?>'" type="button">Editar</button> &nbsp; <button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/pontos/apagar/<?=$row->id_ponto?>'" type="button">Excluir</button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <?php else: ?>
                        <p>Nenhum ponto encontrado</p>
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