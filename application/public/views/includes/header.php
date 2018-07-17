<!DOCTYPE html>
<html lang="pt-br">

<!--[if lte IE 7]> <html class="ie7"> <![endif]-->  
<!--[if IE 8]>     <html class="ie8"> <![endif]-->  
<!--[if IE 9]>     <html class="ie9"> <![endif]-->  
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<head>
	
	<?php if(@$page == 'lojinha'): ?>
	<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded; charset=utf-8" />
	<?php else: ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php endif; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?=@$titulo?></title>
	<meta name="description" content="<?=@$description?>">
	<meta name="keywords" content="<?=@$keywords?>">
	
	<meta property="og:url" content="<?=current_url()?>"/>
	<meta property="og:site_name" content="Patas Dadas para mudar o mundo"/>
	<meta property="og:title" content="<?=@$titulo?>"/>
	<meta property="og:image" content="<?=@$imageog?>"/>
	<meta property="og:description" content="<?=@$description?>"/>
	
	<meta name="language" content="pt">
	<meta name="msnbot" content="index, follow"> 
	<meta name="googlebot" content="index, follow"> 
	<meta name="robots" content="index, follow">
	
	<meta name="google-site-verification" content="2GN_elaJaPPXtCXxY9PTVHdYJ30rIdSXgtReNkxZ5ms" />
	<link rel="shortcut icon" href="<?=base_url()?>assets/public/img/favicon.ico" type="image/x-icon" />
	
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/styles.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/styles-reset.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/styles-mobile.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/styles-parallax.min.css">
	
	
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/font-awesome/css/font-awesome.min.css">
	
	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/public/css/swiper.min.css">
	
	<script src="<?=base_url()?>assets/public/js/jquery-1.11.2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/scrollreveal.js/3.0.9/scrollreveal.min.js"></script>
	<!-- ELEVATE ZOOM -->
	<script src='<?=base_url()?>assets/public/js/jquery.elevatezoom.js'></script>

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-6202805151194355"
	  });
	</script>
	
</head>    
<body class="magicfull">
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-75428089-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
	
	<!-- ************ HEADER DESKTOP ************ -->
  	<?php if(@$pageloja == 'interna'): ?><div class="excep-loja"><?php endif; ?>

	<header id="desktop">
		<div class="row">
			<div class="left">
				<h1>
					<a href="<?=site_url()?>" alt="Voltar para o início" title="Voltar para o início"><img src="<?=base_url()?>assets/public/img/patasdadas-header-logo.png" alt="Patas Dadas"></a>
					<p>Patas Dadas</p>
				</h1>
			</div>
			<div class="right">
				<a href="<?=site_url()?>" alt="Home page do Patas Dadas" <?php if(@$page == 'home') echo "class='active'"; ?>><p>home</p></a>
				<a href="<?=site_url()?>adotaveis" alt="Animais para adoção, adotáveis" <?php if(@$page == 'adotaveis') echo "class='active'"; ?>><p>adotáveis</p></a>
				<a href="<?=site_url()?>como-ajudar" alt="" <?php if(@$page == 'como_ajudar') echo "class='active'"; ?>><p>como ajudar</p></a>
				<a href="<?=site_url()?>lojinha" alt="" <?php if(@$page == 'lojinha') echo "class='active'"; ?>><p>lojinha</p></a>
				<a href="<?=site_url()?>eventos" alt="" <?php if(@$page == 'eventos') echo "class='active'"; ?>><p>eventos</p></a>
				<a href="<?=site_url()?>quem-somos" alt="" <?php if(@$page == 'quem_somos') echo "class='active'"; ?>><p>quem somos</p></a>
				<a href="<?=site_url()?>fale-conosco" alt="" <?php if(@$page == 'contato') echo "class='active'"; ?>><p>fale conosco</p></a>
				<a href="<?=@$conteudo->facebook?>" target="_blank" class="facebook smoth" alt="Acesse nosso facebook" title="Acesse nosso facebook"><i class="fa fa-facebook"></i></a>
				<a href="<?=@$conteudo->instagram?>" target="_blank" class="facebook smoth" alt="Acesse nosso instagram" title="Acesse nosso instagram"><i class="fa fa-instagram"></i></a>
				<a href="<?=@$conteudo->twitter?>" target="_blank" class="facebook smoth" alt="Acesse nosso twitter" title="Acesse nosso twitter"><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</header>
	
	<!-- ************ HEADER MOBILE ************ -->
	<header id="mobile">
		<div class="left">
			<h1>
				<a href="<?=site_url()?>" alt="Voltar para o início" title="Voltar para o início"><img src="<?=base_url()?>assets/public/img/patasdadas-header-logo.png" alt="Patas Dadas"></a>
				<p>Patas Dadas para mudar o Mundo</p>
			</h1>
		</div>
		<div class="right">
			<a href="<?=@$conteudo->facebook?>" target="_blank" class="facebook roxo-facebook smoth" alt="Acesse nosso facebook" title="Acesse nosso facebook"><i class="fa fa-facebook"></i></a>
			<a href="<?=@$conteudo->instagram?>" target="_blank" class="facebook roxo-facebook smoth" alt="Acesse nosso instagram" title="Acesse nosso instagram"><i class="fa fa-instagram"></i></a>
			<a href="<?=@$conteudo->twitter?>" target="_blank" class="facebook roxo-facebook smoth" alt="Acesse nosso twitter" title="Acesse nosso twitter"><i class="fa fa-twitter"></i></a>
		</div>
		<nav class="header-fixo">
			<a id="nav-toggle" class="menu_phone on-swift abrir"><span></span></a>
			<div id="menu">
				<div class="big">
					<a href="<?=site_url()?>" alt="Home page do Patas Dadas" <?php if(@$page == 'home') echo "class='active'"; ?>><p>home</p></a>
					<a href="<?=site_url()?>adotaveis" alt="Animais para adoção, adotáveis" <?php if(@$page == 'adotaveis') echo "class='active'"; ?>><p>adotáveis</p></a>
					<a href="<?=site_url()?>como-ajudar" alt="" <?php if(@$page == 'comoajudar') echo "class='active'"; ?>><p>como ajudar</p></a>
					<a href="<?=site_url()?>lojinha" alt="" <?php if(@$page == 'lojinha') echo "class='active'"; ?>><p>lojinha</p></a>
					<a href="<?=site_url()?>eventos" alt="" <?php if(@$page == 'eventos') echo "class='active'"; ?>><p>eventos</p></a>
					<a href="<?=site_url()?>quem-somos" alt="" <?php if(@$page == 'quem_somos') echo "class='active'"; ?>><p>quem somos</p></a>
					<a href="<?=site_url()?>fale-conosco" alt="" <?php if(@$page == 'contato') echo "class='active'"; ?>><p>fale conosco</p></a>
				</div>
				<div class="black abrir fechar-animation"></div>
			</div>
		</nav>
	</header>
	<?php if(@$pageloja == 'interna'): ?></div><?php endif; ?>