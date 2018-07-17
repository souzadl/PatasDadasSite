<?php $this->load->view('includes/header.php'); ?>
	
	<?php if($this->uri->segment(2) == 'pedido-realizado'): ?>
	<!-- ************ MODAL AJUDA ************ -->
	<script>
		function openModalSucesso() {
			$('#modalSucesso').fadeIn('slow');
			
		}      
		function closeModalSucesso() {
			$('#modalSucesso').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalSucesso" class="ajuda adotavel" style="display:none;">
		<div class="black" onClick="closeModalSucesso();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>Obrigado por comprar em nossa lojinha :)</span><br>
					Após a confirmação do pagamento o seu pedido será enviado!
				</p>



				<p><b></b></p>
				<div class="fechar_right" onClick="closeModalSucesso();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	<script>openModalSucesso();</script>
	<?php endif; ?>


	<!-- ************ SETOR ************ -->
	<section id="lojinha">
		<div id="container" class="container">
			<ul id="scene" class="scene">
				<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-03.png"></li>
				<li class="layer lay4" data-depth="0.4"><img class="image2" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-04.png"></li>
			</ul>
		</div>
		
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
					<?php if(@$destaques): ?>
					<h2>Destaques</h2>
					<!-- Swiper -->
					<div class="swiper-container swiper2">
						<div class="swiper-wrapper">
							<?php foreach ($destaques as $row): 
								$tituloProd = $this->utilidades->sanitize_title_with_dashes($row->titulo);
								$tituloCat 	= $this->utilidades->sanitize_title_with_dashes($row->categoria);
								
							?>
							<!-- SLIDE -->
							<a title="<?=$row->titulo?>" href="<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$row->id_produto?>" class="swiper-slide">
								<figure title="<?=$row->titulo?>" style="background: url(<?=base_url()?>assets/uploads/produtos/<?=$row->imagem?>);"></figure>
								<div class="right">
									<div>
										<h3><?=$row->titulo?></h3>
										<p>R$ <?=number_format($row->valor, 2, ',', '.');?></p>
									</div>
								</div>
							</a>
							<?php endforeach; ?>
					
						</div>
						<!-- Add Pagination -->
						<div class="swiper-pagination swiper-pagination2"></div>
						<!-- Add Buttons 
						<div class="swiper-button-next swiper-button-next2"></div>
						<div class="swiper-button-prev swiper-button-prev2"></div>-->
					</div>
					<?php endif; ?>
					
					<?php if(@$categorias): foreach($categorias as $row): $produtos = $this->model->getProdutosCategorias($row->id_produto_categoria); ?>
					<h2><?=$row->categoria?></h2>
					<ul>
						<?php foreach ($produtos as $produto): 
							$tituloProd = $this->utilidades->sanitize_title_with_dashes($produto->titulo);
							$tituloCat 	= $this->utilidades->sanitize_title_with_dashes($row->categoria);
						?>
						<li style="height:270px; width: 21%;">
							<?php if($produto->imagem): ?>
							<div class="image"><span></span><figure title="<?=$produto->titulo?>" style="background: url(<?=base_url()?>assets/uploads/produtos/<?=$produto->imagem?>);"></figure></div>
							<?php else: ?>
							<div class="image"><span></span><figure title="<?=$produto->titulo?>" style="background: url(<?=base_url()?>assets/public/img/marcacao/marcacao-lojinha.jpg);"></figure></div>
							<?php endif; ?>
							
							<a title="<?=$produto->titulo?>" href="<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>" class="box">
								<div class="top">
									<i></i>
								</div>
                       
							</a>
							<div class="bottom">
								<p>Compartilhar</p>
								<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="facebook"></i></a>
								<a target="_blank" href="https://twitter.com/home?status=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="twitter"></i></a>
								<a target="_blank" href="https://plus.google.com/share?url=<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>"><i class="gplus"></i></a>
							</div> 
							<a title="<?=$produto->titulo?>" href="<?=site_url()?>lojinha/<?=$tituloCat;?>/<?=$tituloProd;?>/<?=$produto->id_produto?>" class="box2">
								<h3><?=$produto->titulo?></h3>
								<p>R$ <?=number_format($produto->valor, 2, ',', '.');?></p>
							</a> 
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endforeach; endif; ?>
				
				</div>
			</section>
			<!-- ************ SETOR END ************ -->
		</div>
	</section>
	<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>