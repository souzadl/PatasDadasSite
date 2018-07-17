<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mídias <button onclick="location.href='<?=base_url()?>admin.php/midias/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ midia</button></h1>
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
                        Cadastro de Midias
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php if(@$midias): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="30%">Título</th>
                                        <th width="20%">Tipo</th>
                                        <th width="30%">Arquivo / Link</th>
                                        <th width="15%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($midias->result() as $row) { ?>
                                    <tr id="item-<?=$row->id_midia?>">
                                        <td><?=$row->id_midia?></td>
                                        <td><?=$row->titulo;?></td>
                                        <td><?php if($row->tipo == 'A') echo "Arquivo"; else echo "Link"; ?></td>
                                        <td><?php if($row->tipo == 'L'): ?><a target="_blank" href="<?=$row->link?>">Acesse aqui</a><?php elseif($row->tipo == 'A'): ?><a target="_blank" href="<?=base_url()?>assets/uploads/midias/<?=$row->arquivo?>">Acesse aqui</a><?php endif; ?></td>
                                        <td><button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/midias/editar/<?=$row->id_midia?>'" type="button">Editar</button> &nbsp; <button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/midias/apagar/<?=$row->id_midia?>'" type="button">Excluir</button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <?php else: ?>
                        <p>Nenhum midia encontrado</p>
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