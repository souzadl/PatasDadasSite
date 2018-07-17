<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=@$titulo?> <button onclick="location.href='<?=base_url()?>admin.php/animais/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ animal</button></h1>
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
                        Cadastro de Animais
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?php if(@$animais): ?>
                        <div class="table-responsive" style="overflow:hidden;">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Porte</th>
                                        <th>Condição</th>
                                        <th width="15%">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <?php foreach ($animais->result() as $row) { ?>
                                    <tr id="item-<?=$row->id_animal?>">
                                        <td><?=$row->id_animal?></td>
                                        <td><?=$row->nome;?></td>
                                        <td><?php if($row->sexo == 'M') echo "Macho"; else echo "Fêmea"; ?></td>
                                        <td><?=$row->porte?></td>
                                        <td><?php if($row->condicao == 'A') echo 'Adotado'; if($row->condicao == 'O') echo 'Óbito'; if($row->condicao == 'D') echo 'Desaparecido'; if($row->condicao == 'DI') echo 'Disponível'; if($row->condicao == 'I') echo 'Indisponível'; ?></td>
                                        <td><button data-toggle="modal" data-target="#myModal<?=$row->id_animal?>" class="btn btn-primary btn-xs" href="<?=base_url()?>admin.php/animais/visualizar/<?=$row->id_animal?>" type="button">Visualizar</button> &nbsp; <button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/animais/editar/<?=$row->id_animal?>'" type="button">Editar</button> <!--<button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/animais/apagar/<?=$row->id_animal?>'" type="button">Excluir</button>--></td>
                                    </tr>
                                    <!-- Modal -->
									<div class="modal fade" id="myModal<?=$row->id_animal?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <p>Nenhum animal encontrado</p>
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