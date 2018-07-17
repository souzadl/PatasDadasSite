<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Produtos <button onclick="location.href='<?=base_url()?>admin.php/produtos/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ produto</button></h1>
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
                        Cadastro de Produtos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php if(@$produtos): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="20%">Produto</th>
                                        <th width="20%">Categoria</th>
                                        <th width="15%">Imagem</th>
                                        <th width="15%">Valor</th>
                                        <th width="10%">Ativo</th>
                                        <th width="7%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($produtos->result() as $row) { ?>
                                    <tr id="item-<?=$row->id_produto?>">
                                        <td><?=$row->id_produto?></td>
                                        <td><?=$row->titulo;?></td>
                                        <td><?=$row->categoria?></td>
                                        <td><?php if($row->imagem): ?><img src="<?=base_url()?>assets/uploads/produtos/<?=$row->imagem?>" style="width: 50%" /><?php endif; ?></td>
                                        <td><?=$row->valor?></td>
                                        <td><?php if($row->ativo == "S") echo "Sim"; elseif($row->ativo == "Não") echo "Não"; ?></td>
                                        <td><!-- <button data-toggle="modal" data-target="#myModal<?=$row->id_produto?>" class="btn btn-primary btn-xs" href="<?=base_url()?>admin.php/produtos/visualizar/<?=$row->id_produto?>" type="button">Visualizar</button> &nbsp; --> <button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/produtos/editar/<?=$row->id_produto?>'" type="button">Editar</button> <!--<button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/produtos/apagar/<?=$row->id_produto?>'" type="button">Excluir</button>--></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <?php else: ?>
                        <p>Nenhum produto encontrado</p>
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