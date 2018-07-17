<?php $this->load->view('includes/header.php'); ?>

	<!-- ************ SETOR ************ -->
	<section id="setor1">
		<!-- Swiper -->
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide" style="background: #fec901">
					<ul id="scene" class="scene">
						<a title="Adotáveis" href="<?=site_url()?>adotaveis">
							<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider1-01.jpg"></li>
							<li class="layer lay1" data-depth="0.3"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider1-02.png"></li>
							<li class="layer lay1" data-depth="0.4"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider1-03.png"></li>
							<li class="layer lay1" data-depth="0.5"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider1-04.png"></li>
						</a>
					</ul>
				</div>
				<div class="swiper-slide" style="background: #cd7cbb">
					<ul id="scene2" class="scene">
						<a title="Como ajudar" href="<?=site_url()?>como-ajudar">
							<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider2-01.png"></li>
							<li class="layer lay1" data-depth="0.3"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider2-02.png"></li>
							<li class="layer lay1" data-depth="0.4"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider2-03.png"></li>
							<li class="layer lay1" data-depth="0.5"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider2-04.png"></li>
						</a>
					</ul>
				</div>
				<div class="swiper-slide" style="background: #00acac">
					<ul id="scene3" class="scene">
						<a title="Eventos" href="<?=site_url()?>eventos">
							<li class="layer lay1" data-depth="0.2"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider3-01.png"></li>
							<li class="layer lay1" data-depth="0.3"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider3-02.png"></li>
							<li class="layer lay1" data-depth="0.4"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider3-03.png"></li>
							<li class="layer lay1" data-depth="0.5"><img class="image1" src="<?=base_url()?>assets/public/img/home/patasdadas-slider3-04.png"></li>
						</a>
					</ul>
				</div> 
<!-- 				<div class="swiper-slide magic" style="background: ">Slide 4</div> -->
			</div>
		
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
		<div class="row">
			<div class="top"></div>
		</div>
	</section>
	<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>