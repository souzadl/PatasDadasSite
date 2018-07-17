<?php $this->load->view('includes/header.php'); ?>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=146829608799445";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- ************ SETOR ************ -->
	<section id="eventos">
		<div id="container" class="container">
			<ul id="scene" class="scene">
				<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-05.png"></li>
				<li class="layer lay4" data-depth="0.4"><img class="image2" src="<?=base_url()?>assets/public/img/headers/patas-dadas-adotaveis-06.png"></li>
			</ul>
		</div>
		<div id="content" style="min-height: 400px;">
			<div class="row">

				<?php if($this->agent->is_mobile()): ?>
				<div id="ads" style="margin-top: 15px; margin-bottom: 30px; float: left; width: 100%;">
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

				<?php 
					if(@$eventos): 
						foreach ($eventos as $row): 
							$dia = date('d', strtotime(@$row->data));
							$mes = date('M', strtotime(@$row->data));
				?>
				<ul>
					<li class="left">
						<i class="calender"><p class="one"><?=$mes?></p><p class="two"><?=$dia?></p></i> <!-- SOMENTE 3 LETRAS NO MES -->
						<h2><?=$row->evento?></h2>
						<div>
							<i class="local"></i>
							<p><?=@$row->local?></p>
						</div>
						<?php if (!empty($row->horario)): ?>
						<div>
							<i class="hora"></i>
							<p><?=$row->horario?></p>
						</div>
					<?php endif; ?>
					</li>
					<li class="right">
						<?php if($row->imagem): ?>
						<figure title="<?=$row->evento?>" style="background: url(<?=base_url()?>assets/uploads/eventos/<?=$row->imagem?>);"></figure>
						<?php else: ?>
						<figure title="<?=$row->evento?>" style="background: url(<?=base_url()?>assets/public/img/marcacao/marcacao-eventos.jpg);"></figure>
						<?php endif; ?>
						<div>
							<?php if($row->link): ?>
							<i class="fa fa-facebook"></i>
							<p><a href="<?=$row->link?>">Saiba mais</a> e confirme sua presença via Facebook</p>
							<?php endif; ?>
						</div>	
					</li>
				</ul>
				<?php endforeach; else: ?>
				<div class="row">
					<p style="font-size: 1.6em;margin-bottom: 1em;">:( Nenhum evento encontrado no momento. Follow us no nosso Facebook e fique atualizado:</p>
					<div class="fb-page" data-href="https://www.facebook.com/patasdadas" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/patasdadas" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/patasdadas">Patas Dadas</a></blockquote></div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>