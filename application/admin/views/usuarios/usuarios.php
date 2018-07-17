<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Usuários <button onclick="location.href='<?=base_url()?>admin.php/usuarios/cadastro'" style="float:right;" class="btn btn-primary" type="button">+ usuário</button></h1>
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
                            Usuários com acesso ao sistema
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        <?php if(@$usuarios): ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Ativo</th>
                                            <th width="15%">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php foreach ($usuarios->result() as $row) { ?>
                                        <tr>
                                            <td><?=$row->id_usuario;?></td>
                                            <td><?=$row->nome;?></td>
                                            <td><?=$row->email;?></td>
											<td><?php if($row->ativo == "S"): echo "Sim"; else: echo "Não"; endif; ?></td>
                                            <td><button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/usuarios/editar/<?=$row->id_usuario?>'" type="button">Editar</button><!-- <button class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/usuarios/apagar/<?=$row->id_usuario?>'" type="button">Excluir</button>--></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <?php else: ?>
                            <p>Nenhum usuário encontrado</p>
                            <?php endif; ?>
                        </div>
                        
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div>
                    	<?=@$paginacao?>
                    </div>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            
	</div>


<?php $this->load->view('includes/footer.php'); ?>