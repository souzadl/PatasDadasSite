<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PATAS DADAS - Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>assets/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?=base_url()?>assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=base_url()?>assets/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    
    <!-- Timeline CSS -->
    <link href="<?=base_url()?>assets/admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>admin.php/dashboard">PATAS DADAS - SITE Manager</a>
            </div>
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url()?>admin.php/usuarios/editar/<?=$this->encrypt->decode($this->session->userdata('lavie_id_usuario'));?>"><i class="fa fa-user fa-fw"></i> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>admin.php/login/sair"><i class="fa fa-sign-out fa-fw"></i> Sair</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        
       
			<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
			    <ul class="nav" id="side-menu">
				    <li>
			            <a href="<?=base_url()?>admin.php/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			        </li>

			        <li>
			            <a href="<?=base_url()?>admin.php/usuarios/lista"><i class="fa fa-user fa-fw"></i> Usuários</a>
			        </li>
			        <li>
			        	<a href="<?=base_url()?>admin.php/conteudos"><i class="fa fa-cog fa-fw"></i> Conteúdos</a>
			        </li>
			        <li>
	                	<a href="#"><i class="fa fa-paw fa-fw"></i> Animais<span class="fa arrow"></span></a>
		                <ul class="nav nav-second-level">
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/lista">Todos</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/listaDisponiveis">Disponívels</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/listaAdotados">Adotados</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/listaDesaparecidos">Desaparecidos</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/listaObitos">Óbitos</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/animais/listaIndisponiveis">Indisponíveis</a>
			                </li>
                        </ul>
	                </li>
	                <li>
			        	<a href="<?=base_url()?>admin.php/adocoes/lista"><i class="fa fa-heart fa-fw"></i> Adoções</a>
			        </li>
			        <li>
	                	<a href="#"><i class="fa fa-smile-o fa-fw"></i> Apadrinhamentos<span class="fa arrow"></span></a>
		                <ul class="nav nav-second-level">
			                <li>
			                    <a href="<?=base_url()?>admin.php/apadrinhamentos/lista">Apadrinhamentos</a>
			                </li>
                        </ul>
	                </li>
	                <li>
	                	<a href="#"><i class="fa fa-money fa-fw"></i> Pedidos<span class="fa arrow"></span></a>
		                <ul class="nav nav-second-level">
			                <li>
			                    <a href="<?=base_url()?>admin.php/pedidos/lista">Pedidos</a>
			                </li>
                        </ul>
	                </li>
			        <li>
	                	<a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Produtos<span class="fa arrow"></span></a>
		                <ul class="nav nav-second-level">
			                <li>
			                    <a href="<?=base_url()?>admin.php/produtos/lista">Produtos</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/produtos/listaCategorias">Categorias</a>
			                </li>
                        </ul>
	                </li>
	                <li>
	                	<a href="<?=base_url()?>admin.php/eventos/lista"><i class="fa fa-calendar fa-fw"></i> Eventos</a>
	                </li>
			        <li>
	                	<a href="#"><i class="fa fa-edit fa-fw"></i> Cadastros<span class="fa arrow"></span></a>
		                <ul class="nav nav-second-level">
			                <li>
			                    <a href="<?=base_url()?>admin.php/parceiros/lista">Parceiros</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/pontos/lista">Pontos de Coleta</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/midias/lista">Mídias</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/faqs/lista">Perguntas e Respostas</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/pessoas/lista">Pessoas</a>
			                </li>
			                <li>
			                    <a href="<?=base_url()?>admin.php/padrinhos/lista">Padrinhos</a>
			                </li>
                        </ul>
	                </li>
			    </ul>
			</div>
			<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
        </nav>