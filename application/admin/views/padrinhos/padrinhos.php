<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Padrinhos <button onclick="location.href='<?=base_url()?>admin.php/padrinhos/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ padrinho</button></h1>
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
                        Cadastro de Padrinhos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php if(@$padrinhos): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="30%">Nome</th>
                                        <th width="25%">E-mail</th>
                                        <th width="25%">Telefone</th>
                                        <th width="15%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($padrinhos->result() as $row) { ?>
                                    <tr id="item-<?=$row->id_padrinho?>">
                                        <td><?=$row->id_padrinho?></td>
                                        <td><?=$row->nome;?></td>
                                        <td><?=$row->email;?></td>
                                        <td><?=$row->telefone;?></td>
                                        <td><button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/padrinhos/editar/<?=$row->id_padrinho?>'" type="button">Editar</button> &nbsp; <button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/padrinhos/apagar/<?=$row->id_padrinho?>'" type="button">Excluir</button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <?php else: ?>
                        <p>Nenhuma padrinho encontrada</p>
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