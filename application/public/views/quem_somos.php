<?php $this->load->view('includes/header.php'); ?>



	<!-- ************ SETOR ************ -->
	<section id="quemsomos">

		

		<div id="container" class="container">
			<ul id="scene" class="scene">	
				<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-09.png"></li>
				<li class="layer lay4" data-depth="0.4"><img class="image2" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-10.png"></li>
			</ul>
		</div>
		
		<div class="content">


			<div class="row">

				<?php if($this->agent->is_mobile()): ?>
				<div id="ads" style="margin-top: 15px; margin-bottom: 0px; float: left; width: 100%;">
				<?php else: ?>
				<div id="ads" style="float:left; width: 100%; margin-bottom: 60px; text-align: center;">
				<?php endif; ?>
			    	
					<!-- Adotaveis - Topo -->
					<ins class="adsbygoogle"
					     style="display:block"
					     data-ad-client="ca-pub-6202805151194355"
					     data-ad-slot="8957960229"
					     data-ad-format="auto"></ins>
			    </div>
			
				<div class="left">
					<div class="padd">
						<?php if($conteudo->imagem): ?>
						<figure style="background: url(<?=base_url()?>assets/uploads/conteudos/<?=$conteudo->imagem?>) no-repeat;"></figure>
						<?php endif; ?>
					</div>
					<ul class="names">
						<?php if(@$pessoas): foreach($pessoas as $pessoa): ?>
						<li><?=$pessoa->nome?></li>
						<?php endforeach; endif; ?>
					</ul>
					
					<?php if(@$parceiros): ?>
	                <h3>Parceiros</h3>
	                <ul class="parceiros">
		                <?php foreach ($parceiros as $row): ?>
						<li>
							<div class="image"><a target="_blank" href="<?=$row->link?>"><img title="<?=$row->nome?>" src="<?=base_url()?>assets/uploads/parceiros/<?=$row->logo?>"></a></div>
						</li>
						<?php endforeach; ?>
	                </ul>
	                <?php endif; ?>


					
					<?php if(@$midias): ?>
					<h3>Mídia</h3>
					<ul class="midias">
						<?php foreach ($midias as $row): if($row->tipo == 'A') $link = base_url()."assets/uploads/midia/".$row->arquivo; elseif($row->tipo == 'L') $link = $row->link; ?>
						<li class="imagem"> <!-- or class imagem -->
							<?php if($row->imagem): ?>
							<div class="image"><span></span><figure style="background: url(<?=base_url()?>assets/uploads/midias/<?=$row->imagem?>);"></figure></div>
							<?php else: ?>
							<div class="image"><span></span><figure style="background: url(<?=base_url()?>assets/public/img/marcacao/marcacao-midias.jpg);"></figure></div>
							<?php endif; ?>
							<a target="_blank" title="<?=$row->titulo?>" href="<?=$link?>" class="box">
								<div class="top">
									
									<i></i>
								</div>
<!--
								<div class="bottom">
									<p>Compartilhar</p>
									<a href=""><i class="facebook"></i></a>
									<a href=""><i class="twitter"></i></a>
									<a href=""><i class="gplus"></i></a>
								</div> 
-->                       
							</a>
							<a target="_blank" title="<?=$row->titulo?>" href="<?=$link?>" class="box2">
								<p><?php echo $dia = date('d.M.Y', strtotime(@$row->data)); ?></p>
								<h4><?=$row->titulo?></h4>
							</a> 
						</li>	
						<?php endforeach; ?>			
					
					</ul>
					<?php endif; ?>
				</div>
		
				<ul class="right">
					<?php if(@$conteudo->missao): ?>
					<li class="box">
						<i class="missao"></i>
						<h3>Missão</h3>
						<p>
							<?=$conteudo->missao?>
						</p>
					</li>
					<?php endif; ?>
					<?php if(@$conteudo->historia): ?>
					<li class="box">
						<i class="historia"></i>
						<h3>História</h3>
						<p>
							<?=$conteudo->historia?>
						</p>
					</li>
					<?php endif; ?>
					<?php if(@$conteudo->arquivo): ?>
					<li class="box">
						<i class="contas"></i>
						<h3>Prestação de Contas</h3>
						<a title="Prestação de Contas" target="_blank" href="<?=base_url()?>assets/uploads/conteudos/<?=$conteudo->arquivo?>"><p>Aqui você encontra nossa prestação de contas atualizada.</p></a>
					</li>
					<?php endif; ?>
				</ul>	
			</div>
		</div>
	</section>
	<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>