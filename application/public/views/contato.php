<?php $this->load->view('includes/header.php'); ?>

	<!-- ************ SETOR ************ -->
	<section id="faleconosco">
		
		<div id="container" class="container">
			<ul id="scene" class="scene">
				<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-11.png"></li>
				<li class="layer lay4" data-depth="0.4"><img class="image2" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-12.png"></li>
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

				<div class="left" id="faqs">
					<div class="padd">
						<figure style="background: url(<?=base_url()?>assets/public/img/quemsomos/01.jpg) no-repeat;"></figure>
					</div>
		
					<h2>Qual o motivo de seu contato?</h2>
					
					<?php if(@$faqs): foreach ($faqs as $row): ?>
					
					<ul onclick="MostraResposta(<?=$row->id_faq?>);" id="faq-<?=$row->id_faq?>" class="box fale-btn off">
						<li class="questao">
							<h4><?=$row->pergunta?></h4>
						</li>
						<li class="resposta">
							<p>
								<br/>
								<?=nl2br($row->resposta)?>
							</p>
						</li>
					</ul>
					<?php endforeach; endif; ?>
				</div>
		
				<ul class="right">
					<?php if(@$conteudo->email): ?>
					<li class="box">
						<i class="mail"></i>
						<h3>E-mail</h3>
						<a href="mailto:<?=@$conteudo->email?>"><p><?=@$conteudo->email?></p></a>
					</li>
					<?php endif; ?>
				
					<?php if(@$conteudo->facebook): ?>
					<li class="box">
						<i class="facebook"></i>
						<h3>Facebook</h3>
						<a target="_blank" href="<?=@$conteudo->facebook?>"><p>facebook.com/patasdadas</p></a>
					</li>
					<?php endif; ?>


					<li class="box">
						<i class="instagram"></i>
						<h3>instagram</h3>
						<a target="_blank" href="https://www.instagram.com/patasdadas/"><p>instagram.com/patasdadas</p></a>
					</li>
					
				

					<?php if(@$conteudo->twitter): ?>
					<li class="box">
						<i class="twitter"></i>
						<h3>Twitter</h3>
						<a target="_blank" href="<?=@$conteudo->twitter?>"><p>twitter.com/patasdadas</p></a>
					</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</section>
	<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>