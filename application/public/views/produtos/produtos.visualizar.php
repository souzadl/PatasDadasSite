<?php $this->load->view('includes/header.php'); ?>

	<?php
		$tituloProd = $this->utilidades->sanitize_title_with_dashes($produto->titulo);
		$tituloCat 	= $this->utilidades->sanitize_title_with_dashes($produto->categoria);
	?>
		
	<!-- ************ SETOR ************ -->
	<section id="lojinha" class="lojinha-interna">
		
		<div id="container2"></div>
		<div id="listagem">
			<ul class="menuLateral right">
				<li>
					<a href="<?=site_url()?>lojinha/carrinho-de-compras">
						<i class="todos"></i>
						<p><?=count($this->session->userdata('cart_products'));?></p>
					</a>
				</li>
				<div class="line"></div>
			</ul>
			
			<!-- ************ SETOR ************ -->
			<section id="setor1">
				<div class="row">
					<div id="bread">
						<a title="Lojinha" href="<?=site_url()?>lojinha">Lojinha</a>
						<p>/</p>
						<p class="atual"><?=$produto->categoria?></p>
						<p>/</p>
						<p class="atual"><?=$produto->titulo?></p>
					</div>
		
		
					<div class="produto">
						<?php if(@$fotos): ?>
						<div class="left">
							<?php $cont = 0; $total = count($fotos); foreach ($fotos as $foto): $cont++; ?>
							<?php if($cont == 1): ?>
							<img id="zoom" src="<?=base_url()?>assets/uploads/produtos/galeria/<?=$foto->imagem?>" data-zoom-image="<?=base_url()?>assets/uploads/produtos/galeria/<?=$foto->imagem?>"/>
							<div id="gal1">
								<?php endif; ?>
								<a <?php if($cont == 1) echo "class='active'"; ?> href="#" data-image="<?=base_url()?>assets/uploads/produtos/galeria/<?=$foto->imagem?>" data-zoom-image="<?=base_url()?>assets/uploads/produtos/galeria/<?=$foto->imagem?>">
									<img id="zoom" src="<?=base_url()?>assets/uploads/produtos/galeria/<?=$foto->imagem?>" />
								</a>
							<?php if($cont == $total): ?>
							</div>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<?php else: ?>
						<div class="left">
							<img id="zoom" src="<?=base_url()?>assets/uploads/produtos/<?=$produto->imagem?>" data-zoom-image="<?=base_url()?>assets/uploads/produtos/<?=$produto->imagem?>"/>
						</div>
						<?php endif; ?>
		
						<div class="right">
							<h3><?=$produto->titulo?></h3>
							<p class="price">R$ <b><?=number_format($produto->valor, 2, ',', '.');?></b> cada</p>
						
							<div class="bottom">
								<p>Compartilhar</p>
								<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="facebook"></i></a>
								<a target="_blank" href="https://twitter.com/home?status=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="twitter"></i></a>
								<a target="_blank" href="https://plus.google.com/share?url=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="gplus"></i></a>
							</div>    
		
							<p><?=nl2br($produto->descricao)?></p>
		
							<form id="FormProduto" method="post" action="<?=site_url()?>lojinha/comprar-produto">
								<input type="hidden" name="id_produto" value="<?=$produto->id_produto?>">
								<ul>
									<li>
										<label>Tamanho:</label>
										<select id="InputTamanho" name="tamanho" onchange="buscaGeneros(this.value, <?=$produto->id_produto?>);">
											<option value="">Selecione</option>
											<?php foreach(@$tamanhos as $row): ?>
											<option value="<?=$row->tamanho?>"><?=$row->tamanho?></option>
											<?php endforeach; ?>
<!--
											<option value="">Selecione</option>
											<option value="Unico">Único</option>
											<option value="PP">PP</option>
											<option value="P">P</option>
											<option disabled="disabled" value="M">M</option>
											<option value="G">G</option>
											<option value="GG">GG</option>
-->
										</select>
									</li>
									<li>
										<label>Gênero:</label>
										<select name="genero" id="AjaxGeneros">
											<option value="">Selecione</option>
											<!--

											<option value="Unisex">Unisex</option>
											<option value="Masculino">Masculino</option>
											<option value="Feminino">Feminino</option>
-->
										</select>
									</li>
									<li>
										<label>Quantidade:</label>
										<select name="quantidade" id="inputQuantidade">
											<option value="1">01</option>
											<option value="2">02</option>
											<option value="3">03</option>
											<option value="4">04</option>
											<option value="5">05</option>
											<option value="6">06</option>
											<option value="7">07</option>
											<option value="8">08</option>
											<option value="9">09</option>
											<option value="10">10</option>
										</select>
									</li>
									<li id="Valida" style="color:red; font-size: 2em; display:none">
										Selecione <b>tamanho</b> e <b>genero</b> para realizar a compra!
									</li>
									<li id="ValidaQuantidade" style="color:red; font-size: 2em; display:none">
										Quantidade selecionada não está disponível em nosso estoque!
									</li>
									<li>
										<a href="javascript: comprarProduto(<?=$produto->id_produto?>);"><p>comprar</p></a>
									</li>
								</ul>
							</form>
						</div>
					</div>
					
					<?php if(@$outros): ?>
					<h2>Outros Produtos</h2>
					<ul>
						
						<?php foreach ($outros as $outro): 
							$tituloProdOu 	= $this->utilidades->sanitize_title_with_dashes($outro->titulo);
							$tituloCatOu 	= $this->utilidades->sanitize_title_with_dashes($outro->categoria);
						?>
						<li>
							<div class="image"><span></span><figure title="<?=$outro->titulo?>" style="background: url(<?=base_url()?>assets/uploads/produtos/<?=$outro->imagem?>);"></figure></div>
							<a title="<?=$outro->titulo?>" href="<?=site_url()?>lojinha/<?=$tituloCatOu;?>/<?=$tituloProdOu;?>/<?=$outro->id_produto?>" class="box">
								<div class="top">
									<i></i>
								</div>                       
							</a>
							<div class="bottom">
								<p>Compartilhar</p>
								<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url()?>lojinha/<?=$tituloCatOu;?>/<?=$tituloProdOu;?>/<?=$outro->id_produto?>"><i class="facebook"></i></a>
								<a target="_blank" href="https://twitter.com/home?status=<?=site_url()?>lojinha/<?=$tituloCatOu;?>/<?=$tituloProdOu;?>/<?=$outro->id_produto?>"><i class="twitter"></i></a>
								<a target="_blank" href="https://plus.google.com/share?url=<?=site_url()?>lojinha/<?=$tituloCatOu;?>/<?=$tituloProdOu;?>/<?=$outro->id_produto?>"><i class="gplus"></i></a>
							</div>
 							<a title="<?=$outro->titulo?>" href="<?=site_url()?>lojinha/<?=$tituloCatOu;?>/<?=$tituloProdOu;?>/<?=$outro->id_produto?>" class="box2">
								<h3><?=$outro->titulo?></h3>
								<p>R$ <?=number_format($outro->valor, 2, ',', '.');?></p>
							</a> 
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
			</section>
			<!-- ************ SETOR END ************ -->
		</div>
	</section>
	<!-- ************ SETOR END ************ -->
	
	<script>
		
		function comprarProduto (id_produto)
		{
			//var genero = $('#AjaxGeneros').val();
			var genero 			= $("#AjaxGeneros option:selected").text();
			var tamanho 		= $('#InputTamanho').val();
			var quantidade 		= $("#inputQuantidade").val();
			
			if (genero == '' || tamanho == '' || genero == 'Selecione')
			{
				$("#Valida").fadeIn();
			}
			else
			{
				var id_produto 		= id_produto;
				var msg 			= '';

				console.log("tamanho: "+tamanho);
				console.log("genero: "+genero);
				console.log("id_produto: "+id_produto);
				console.log("quantidade: "+quantidade);

				
				vet_dados 	= 'tamanho='+ tamanho+
							 	'&id_produto='+ id_produto+
							 	'&genero='+ genero;
				base_url  	= "<?=base_url()?>produtos/checkEstoque";
				
				$.ajax({
					type: "POST",
					url: base_url,
					data: vet_dados,
					success: function(msg) {

							var resul = Number(msg).toFixed(2)-Number(quantidade).toFixed(2);
							console.log(resul);
		
							if (resul >= 0) {
								//console.log('entrou');
								$("#FormProduto").submit();
							} else {
								$("#ValidaQuantidade").fadeIn();
							}
					}
				});
			}
			
		}

		function buscaGeneros (tamanho, id_produto)
		{
			$("#Valida").fadeOut();
			$("#ValidaQuantidade").fadeOut();
				
			var tamanho = tamanho;
			var id_produto = id_produto;
			var msg 	= '';
			
			vet_dados 	= 'tamanho='+ tamanho+
							'&id_produto='+ id_produto;
			base_url  	= "<?=base_url()?>produtos/buscaGeneros";
			
			$.ajax({
				type: "POST",
				url: base_url,
				data: vet_dados,
				success: function(msg) {
						$("#AjaxGeneros").html(msg);
				}
			});
		
			return false;
		}
			
	</script>

<?php $this->load->view('includes/footer.php'); ?>