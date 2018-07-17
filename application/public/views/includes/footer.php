	
	<script>
		window.sr = ScrollReveal();
		sr.reveal('.content .row li', { delay: 50, scale: 0.9, opacity: 900 });
		sr.reveal('.row .left h1', { delay: 100, reset: true });
	
		/*
		
		sr.reveal('.content .row li', { delay: 300, scale: 0.9, reset: true });
		sr.reveal('.row .left h1', { delay: 100, reset: true });
		*/	
	</script>

	
	<footer>
		<div class="row">
			<figure style="width: 15%;"><img src="<?=base_url()?>assets/public/img/patasdadas-header-logo-white.png"></figure>
			<figure style="width: 15%; float: right;">
				<a href="https://www.risu.com.br" alt="Risü - Fazer o Bem Faz Bem!" target="_blank">
		        	<img style="width: 49px;" src="https://www.risu.com.br/images/seals/ongs/seal-black-vertical-100x150.png" alt="Risü - Logo" />
		    	</a>
		    </figure>
		</div>

		<div class="row">
			<div class="right">
		
				<a href="<?=site_url()?>" alt="Home page do Patas Dadas" <?php if(@$page == 'home') echo "class='active'"; ?>><p>home</p></a>
				<a href="<?=site_url()?>adotaveis" alt="Animais para adoção, adotáveis" <?php if(@$page == 'adotaveis') echo "class='active'"; ?>><p>adotáveis</p></a>
				<a href="<?=site_url()?>como-ajudar" alt="" <?php if(@$page == 'comoajudar') echo "class='active'"; ?>><p>como ajudar</p></a>
				<a href="<?=site_url()?>lojinha" alt="" <?php if(@$page == 'lojinha') echo "class='active'"; ?>><p>lojinha</p></a>
				<a href="<?=site_url()?>eventos" alt="" <?php if(@$page == 'eventos') echo "class='active'"; ?>><p>eventos</p></a>
				<a href="<?=site_url()?>quem-somos" alt="" <?php if(@$page == 'quemsomos') echo "class='active'"; ?>><p>quem somos</p></a>
				<a href="<?=site_url()?>fale-conosco" alt="" <?php if(@$page == 'faleconosco') echo "class='active'"; ?>><p>fale conosco</p></a>
				<a href="<?=@$conteudo->facebook?>" target="_blank" class="facebook smoth" alt="Acesse nosso facebook" title="Acesse nosso facebook"><i class="fa fa-facebook"></i></a>

				<a href="https://www.instagram.com/patasdadas/" target="_blank" class="facebook smoth" alt="Acesse nosso instagram" title="Acesse nosso instagram"><i class="fa fa-instagram"></i></a>
				
				<a href="<?=@$conteudo->twitter?>" target="_blank" class="facebook smoth" alt="Acesse nosso twitter" title="Acesse nosso twitter"><i class="fa fa-twitter"></i></a>
		
				<!-- <a href="http://www.p3kweb.com/" class="p3k smoth" alt="Desenvolvido por p3k WEB" title="Developed by p3k WEB" target="_blank">
					<img src="<?=base_url()?>assets/public/img/p3k.png" alt="">
				</a> -->
			</div>
		</div>
	</footer>
	
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
		<?php if(@$pageCheck != 'adotaveisvisualizar'): ?>
		// Pretty simple huh?
		var scene = document.getElementById('scene');
		var parallax = new Parallax(scene);
		
		<?php endif; ?>
		
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
	
	<?php if(@$pageCheck == 'adotaveisvisualizar'): ?>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56d89d0c797a501f"></script>
	<?php endif; ?>
</body>
</html>