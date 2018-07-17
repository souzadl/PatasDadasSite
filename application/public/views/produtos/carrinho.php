<?php $this->load->view('includes/header.php'); ?>
	
	<!-- ************ MODAL AJUDA ************ -->
	<script>
		function openModalHelp() {
			$('#modalHelp').fadeIn('slow');
		}      
		function closeModalHelp() {
			$('#modalHelp').fadeOut('slow');
		}
	</script>
	
	<div id="modalHelp" class="ajuda" style="display:none;">
		<div class="black" onClick="closeModalHelp();" title="Clique para fechar"></div>
		<div class="row">
			<div class="center">
				<p>
					<span>Precisa de ajuda?</span><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
				</p>
				<div class="left">
					<figure><img src="<?=base_url()?>assets/public/img/patasdadas-elements-help2.png"></figure>
					<p>
						Entre em contato por
						<br><span><b><a href="contato.php">E-mail</a></b></span>
					</p>
				</div>
				<div class="right">
					<figure><img src="<?=base_url()?>assets/public/img/patasdadas-elements-help1.png"></figure>
					<p>
						Ligue para nós
						<br><span>+55 (51) <b>3337</b>.8787</span>
					</p>
				</div>
				<p><b>Horário de atendimento:</b><br>Segunda a sábado: das 8h às 20h (Exceto feriados)</p>
				<div class="fechar_right" onClick="closeModalHelp();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
		
		
	<!-- ************ SETOR ************ -->
	<section id="lojinha" class="lojinha-interna">	
		<div id="container2"></div>
		
		<!-- ************ SETOR ************ -->
		<section id="suasacola">
			<form name="FormCarrinho" id="FormCarrinho" method="post" action="<?=site_url()?>produtos/fechar_pedido">
				
				<div class="row">
					<div id="bread">
						<a title="Lojinha" href="<?=site_url()?>lojinha">Lojinha</a>
						<p>/</p>
						<p class="atual">Minha Sacola</p>
					</div>
			
					<div class="top">
						<h2>Sua Sacola</h2>
						<!--<a onClick="openModalHelp();"><figure class="quest"></figure><p>Precisa de ajuda?</p></a> -->               
					</div>
				
					<?php if(count(@$this->session->userdata('cart_products')) > 0): ?>
					<div class="box">
						<p class="pruds"><?=count(@$this->session->userdata('cart_products'));?> de <?=count(@$this->session->userdata('cart_products'));?> produtos</p> 
						<ul class="topo">
							<li class="one">img</li>
							<li class="two"><p>Produto</p></li>
							<li class="tre"><p>Quantidade / Valor unitário</p></li>
							<li class="four"><p>TOTAL</p></li>
						</ul>
			
						<!-- ====== PRODUTO NA SACOLA ====== -->
						<?php
							$itens = $this->session->userdata('cart_products');	
							
							if(count($itens) > 0):
								$total = ""; $count = 0;
								foreach ($itens as $item): $count++;
									$total = $total+($item['qty']*$item['price']);
						?>
						<input type="hidden" name="itens[<?=$count?>][Id]" value="<?=$item['id']?>">
						<input type="hidden" name="itens[<?=$count?>][Description]" value="<?=$item['name']?> - PROD ID: <?=$item['id']?>">
						<input type="hidden" name="itens[<?=$count?>][Amount]" value="<?=$item['price']?>">
						<input type="hidden" name="itens[<?=$count?>][Quantity]" value="<?=$item['qty']?>">
						<input type="hidden" name="itens[<?=$count?>][Genero]" value="<?=$item['genero']?>">
						<ul class="produto-sacola">
							<li class="one">
								<img src="<?=base_url()?>assets/uploads/produtos/<?=$item['img']?>">
							</li>
							<li class="two"><p><?=$item['name']?></p></li>
							<li class="tre"><p><?=$item['qty']?> / R$ <?=number_format($item['price'], 2, ',', '.')?></p></li>
							<li class="four">
	<!-- 							<p>R$ <?=$item['qty']*$item['price']?></p> -->
								<select>
									<option selected="selected" value="volvo">R$ <?=number_format($item['qty']*$item['price'], 2, ',', '.')?></option>
								</select>
								<a href="<?=site_url()?>lojinha/remover-produto/<?=$item['id']?>" class="trash" alt="Remover item da sacola" title="Remover item da sacola">X</a>
							</li>
						</ul>
						<?php endforeach; endif; ?>
						
						<ul class="bottom">
							<li class="one">img</li>
							<li class="two"><p>&nbsp;</p></li>
							<li class="tre"><p>REF</p></li>
							<li class="four"><p>R$ <b><?=number_format(@$total, 2, ',', '.')?></b> + FRETE</p></li>
							<input type="hidden" name="total" value="<?=@$total?>">
						</ul>
						
			
						<div class="final">
							<div>
	<!-- 							<a href="#"><figure class="print"></figure><p>imprimir sacola</p></a> -->
<!-- 								<a onClick="openModalHelp();"><figure class="quest"></figure><p>Precisa de ajuda?</p></a> -->&nbsp;
							</div>
							<div>
								<a href="<?=site_url()?>lojinha"><figure class="sacis"></figure><p>continuar comprando</p></a>
								<a href="javascript:EnviaCarrinho();" class="encomendar">finalizar pedido</a>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="box">
						<span style="font-size: 12px;">Nenhum produto na sua sacola :( <br/><br/><br/><br/><br/></span>
					</div>
					<?php endif; ?>
				</div>
			</form>
		</section>
	</section>
	<!-- ************ SETOR END ************ -->
	
	<script>
		function EnviaCarrinho()
		{
			$("#FormCarrinho").submit();
		}
	</script>

<?php $this->load->view('includes/footer.php'); ?>