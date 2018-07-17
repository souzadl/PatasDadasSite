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

	
	<script>
		window.sr = ScrollReveal();
		sr.reveal('.content .row li', { delay: 50, scale: 0.9, opacity: 900 });
		sr.reveal('.row .left h1', { delay: 100, reset: true });
	
		/*
		
		sr.reveal('.content .row li', { delay: 300, scale: 0.9, reset: true });
		sr.reveal('.row .left h1', { delay: 100, reset: true });
		*/	
	</script>
	

	
	<!-- Swiper JS -->
	<script src="<?=base_url()?>assets/public/js/swiper.js"></script>
	<!-- Initialize Swiper -->
	<script>
		<?php if(@$page == 'home'): ?>
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			slidesPerView: 1,
			paginationClickable: true,
			spaceBetween: 0,
			direction: 'vertical',
			mousewheelControl: true,
			loop: false
		});
		<?php endif; ?>
		
		<?php if(@$page == 'lojinha'): ?>
		var swiper2 = new Swiper('.swiper2', { // Depoimentos
			pagination: '.swiper-pagination2',
			paginationClickable: true,
			autoplay: false,// 4000
			grabCursor: true,
			spaceBetween: 30,
			nextButton: '.swiper-button-next2',
			prevButton: '.swiper-button-prev2',
			effect: 'slide' // 'slide' or 'fade' or 'cube' or 'coverflow'
		});
		<?php endif; ?>
	</script>
	
	<!-- Scripts -->
	<script src="<?=base_url()?>assets/public/js/parallax.js"></script>
	<script>
		// Pretty simple huh?
		var scene = document.getElementById('scene');
		var parallax = new Parallax(scene);
		
		<?php if(@$page == 'home'): ?>
		
		// Pretty simple huh?
		var scene2 = document.getElementById('scene2');
		var parallax = new Parallax(scene2);
		
		// Pretty simple huh?
		var scene3 = document.getElementById('scene3');
		var parallax = new Parallax(scene3);
		
		<?php endif; ?>
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/public/js/init.js"></script>
	
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56d89d0c797a501f"></script>

</body>
</html>