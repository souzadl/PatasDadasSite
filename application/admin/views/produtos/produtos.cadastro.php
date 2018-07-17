<?php $this->load->view('includes/header.php'); ?>


	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Produtos <button onclick="history.go(-1);" style="float:right;" class="btn btn-primary" type="button">< voltar</button></h1>
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
	                    <form id="FormProduto" role="form" method="post" action="<?=base_url()?>admin.php/produtos/salvar" enctype="multipart/form-data">
	                    	<input type="hidden" name="id_produto" value="<?=@$produto->id_produto?>">
		                    <div class="row">
								<div class="col-lg-6">
									<div class="form-group">   
		                                <label>Título</label>
		                                <input tabindex="1" class="form-control" name="titulo" placeholder="Digite o título da produto" value="<?=@$produto->titulo?>" required>
		                            </div>
		                            
		                            <div class="form-group">
	                                    <label>Ativo</label>
	                                    <br/>
	                                    <label class="radio-inline">
	                                        <input tabindex="3" type="radio" <?php if (@$produto->ativo == "S"): echo 'checked="checked"'; endif; ?> value="S" id="optionsRadiosInline2" name="ativo">Sim
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input tabindex="3" type="radio" <?php if (@$produto->ativo == "N"): echo 'checked="checked"'; endif; ?> value="N" id="optionsRadiosInline3" name="ativo">Não
	                                    </label>
	                                </div>
		                            
		                            <div class="form-group" id="insercaoDeFotos">
			                            <div class="form-group" id="inputDeFotos">   
			                                <label>Imagem</label>
			                                <input tabindex="5" name="imagem" type="file">
			                                <?php if(@$produto->imagem): ?>
			                                <br/><img src="<?=base_url()?>assets/uploads/produtos/<?=$produto->imagem?>" style="width:20%;">
			                                <?php endif; ?>
			                            </div>
									</div>
		                            
		                                  
								</div>

								<div class="col-lg-6">
									<div class="form-group">
		                                <label>Categoria</label>
		                                <select tabindex="2" name="id_produto_categoria" class="form-control" required>
			                                <option value="">Selecione</option>
			                                <?php if($categorias): foreach ($categorias->result() as $row): ?>
		                                	<option <?php if(@$produto->id_produto_categoria == $row->id_produto_categoria) echo "selected='selected'"; ?> value="<?=$row->id_produto_categoria?>"><?=$row->categoria?></option>
											<?php endforeach; endif; ?>
		                                </select>
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Valor</label>
		                                <input tabindex="6" id="valor" class="form-control" name="valor" placeholder="Digite o valor do produto" value="<?=number_format(@$produto->valor, 2, ',', '.');?>">
		                            </div>
		                            
		                            <div class="form-group">   
		                                <label>Peso</label>
		                                <input type="number" tabindex="8" class="form-control" name="peso" placeholder="Digite o peso do produto" value="<?=@$produto->peso?>">
										<p class="help-block">Em gramas, somente números. Exemplo para 1KG - <b>1000</b> -</p>
		                            </div>
		                            
		                            <div class="form-group">
	                                    <label>Mostrar esse produto como DESTAQUE?</label>
	                                    <br/>
	                                    <label class="radio-inline">
	                                        <input tabindex="8" type="radio" <?php if (@$produto->destaque == "S"): echo 'checked="checked"'; endif; ?> value="S" id="optionsRadiosInline2" name="destaque">Sim
	                                    </label>
	                                    <label class="radio-inline">
	                                        <input tabindex="8" type="radio" <?php if (@$produto->destaque == "N"): echo 'checked="checked"'; endif; ?> value="N" id="optionsRadiosInline3" name="destaque">Não
	                                    </label>
	                                </div>
		                             
								</div>
		                    </div>
		                    
		                    <div class="form-group">
								<label>Descrição</label>
								<textarea tabindex="5" class="form-control" name="descricao" rows="5"><?=@$produto->descricao?></textarea>
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
           
           <?php if(@$produto->id_produto): ?>
           
           <div class="col-lg-12" id="EstoquesAnchor">
				<div class="panel panel-default">
					<div class="panel-heading">
						Estoque                          
					</div>
					<div class="panel-body">
			            <div class="col-lg-6" >
			                <div class="panel panel-default">
			                    <div class="panel-heading">
			                        Cadastro de Estoque                          
			                    </div>
			                    
			                    <!-- /.panel-heading -->
			                    <div class="panel-body">
			                        <form id="FormItem" role="form" method="post" action="<?=base_url()?>admin.php/produtos/salvarEstoque" enctype="multipart/form-data">
			                            <input type="hidden" name="id_produto" value="<?=@$produto->id_produto?>">
			                            <?php if(@$estoque->id_produto_estoque): ?>
			                            <input type="hidden" name="id_produto_estoque" value="<?=@$estoque->id_produto_estoque?>">
			                           
			                            <div class="alert alert-warning">
			                                Quando você estiver editando um item de estoque, salve o mesmo<br/>
			                                antes de tentar inserir um novo
			                            </div>
										
										<?php endif; ?>
			                           
			                            <div class="form-group">   
			                                <label>Tamanho</label>
			                                <select class="form-control" name="tamanho" required>
				                                <option <?php if(@$estoque->tamanho == "Unico") echo "selected='selected'"; ?> value="Unico">Único</option>
				                                <option <?php if(@$estoque->tamanho == "PP") echo "selected='selected'"; ?> value="PP">PP</option>
				                                <option <?php if(@$estoque->tamanho == "P") echo "selected='selected'"; ?> value="P">P</option>
				                                <option <?php if(@$estoque->tamanho == "M") echo "selected='selected'"; ?>value="M">M</option>
				                                <option <?php if(@$estoque->tamanho == "G") echo "selected='selected'"; ?> value="G">G</option>
				                                <option <?php if(@$estoque->tamanho == "GG") echo "selected='selected'"; ?> value="GG">GG</option>
			                                </select>
			                            </div>
			                            
			                             <div class="form-group">   
			                                <label>Genero</label>
			                                <select class="form-control" name="genero" required>
				                                <option <?php if(@$estoque->genero == "Unisex") echo "selected='selected'"; ?> value="Unisex">Unisex</option>
				                                <option <?php if(@$estoque->genero == "Masculino") echo "selected='selected'"; ?> value="Masculino">Masculino</option>
				                                <option <?php if(@$estoque->genero == "Feminino") echo "selected='selected'"; ?> value="Feminino">Feminino</option>
			                                </select>
			                            </div>
			                            
			                             <div class="form-group">   
			                                <label>Estoque</label>
			                                <input tabindex="4" type="number" class="form-control" name="estoque" placeholder="Digite o estoque do produto" value="<?=@$estoque->estoque?>" required>
			                            </div>
			                            
			                            <div class="form-group">
				                            <?php if(@$estoque->id_produto_estoque): ?>
				                            <input type="submit" id="enviar" class="btn btn-success" style="float:right;" value="Salvar">
				                            <?php else: ?>
				                            <input type="submit" id="enviar" class="btn btn-success" style="float:right;" value="Inserir">
				                            <?php endif; ?>
			                            </div>
			                        </form>
			                    </div>
			                    
			                </div>
			            </div>
			            <!-- /.col-lg-6 -->
			            
			            <div class="col-lg-6">
			                <div class="panel panel-default">
			                    <div class="panel-heading">
			                        Lista de Estoque
			                    </div>
			                    <!-- /.panel-heading -->
			                    <div class="panel-body">
			                        <?php if(@$estoques): ?>
			                        <div class="table-responsive">
			                            <table class="table table-striped">
			                                <thead>
			                                    <tr>
			                                        <th>Tamanho</th>
			                                        <th>Genero</th>
			                                        <th>Estoque</th>
			                                        <th width="15%">Ações</th>
			                                    </tr>
			                                </thead>
			                                <tbody>
			                                    <?php foreach ($estoques as $row) { ?>
			                                    <tr>
			                                        <td><? echo $row->tamanho; ?></td>
			                                        <td><? echo $row->genero; ?></td>
			                                        <td><? echo $row->estoque; ?></td>
			                                        <td><button class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()?>admin.php/produtos/editarEstoque/<?=@$produto->id_produto?>/<?=$row->id_produto_estoque?>#EstoquesAnchor'" type="button">Editar</button> <button name="excluirValorBt" class="btn btn-danger btn-xs" onclick="location.href='<?=base_url()?>admin.php/produtos/apagarEstoque/<?=@$produto->id_produto?>/<?=$row->id_produto_estoque?>#EstoquesAnchor'" type="button">Excluir</button></td>
			                                    </tr>
			                                    <?php } ?>
			                                </tbody>
			                            </table>
			                        </div>
			                        <!-- /.table-responsive -->
			                        <?php else: ?>
			                        <p>Nenhum estoque encontrado</p>
			                        <?php endif; ?>
			                    </div>
			                    
			                    
			                    <!-- /.panel-body -->
			                </div>
			            </div>
						<!-- /.col-lg-6 -->
					</div>
				</div>
			</div>
            
            <div class="col-lg-12" id="FotosAnchor">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Galeria de Fotos                           
                    </div>
                    
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form id="FormItem" role="form" method="post" action="<?=base_url()?>admin.php/produtos/salvarGaleria" enctype="multipart/form-data">
                            <input type="hidden" name="id_produto" value="<?=@$produto->id_produto?>">

                            <div class="alert alert-warning">
                            	Tamanho ideal para imagens: 1000px (JPG otimizado para web)
                            </div>
							
							<div id="insercaoDeFotos">
	                            <div class="form-group" id="inputDeFotos">   
	                                <label>Fotos (selecione as imagens segurando CONTROL)</label>
	                                <input tabindex="19" multiple name="imagem[]" type="file">
	                            </div>
							</div>                   
                            <div class="form-group">
	                            <input type="submit" id="enviar" class="btn btn-success" style="float:right;" value="Salvar">
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-body">
                    	<?php if(@$fotos): echo "<ul style='display:inline;' width:100%>"; foreach($fotos as $row): ?>
                    		<li class="text-center" style="display:inline; float:left; width: 20%">
                    			<img class="img-thumbnail" width="90%" src="<?=base_url()?>assets/uploads/produtos/galeria/<?=$row->imagem?>" /><br/>
								<button onclick="location.href='<?=base_url()?>admin.php/produtos/excluirFoto/<?=$row->id_produto_galeria?>/<?=$produto->id_produto?>';" class="btn btn-outline btn-danger btn-xs" type="button">EXCLUIR</button>
                            
                    		</li>
                    	<?php endforeach;  ?>
                    	</ul>
                    	
                    	<?php endif; ?>
                    </div>
                    
                </div>
            </div>
            <!-- /.col-lg-12 -->
            
			
			

            <?php endif; ?>

        </div>       
	</div>

<?php $this->load->view('includes/footer.php'); ?>