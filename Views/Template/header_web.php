<?php session_start(); ?> 
<!doctype html>
<html class="no-js" lang="zxx">
<head>
  
  

    <link rel="manifest" href="site.webmanifest">
	<meta charset="utf-8">
    <meta name="description" content="Iglesia Evangélica Del Príncipe de Paz San Esteban Catarina">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Riquelmi Palacios">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media(); ?>/images/logoiepp.ico">


	<title><?= $data['page_tag'] ?></title>

	<meta content="" name="keywords">
	<link rel="shortcut icon" href="<?= media(); ?>/images/logoiepp.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/slicknav.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/flaticon.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/animate.min.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/themify-icons.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/slick.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/nice-select.css">
    <link rel="stylesheet" href="<?= media();?>/assetsTemplate/css/style.css">
</head>
<body>
<!--? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="<?= media();?>/images/logoiepp.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top d-none d-lg-block">
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>     
                                    <li>Telefono: +503 7583-5200</li>
                                    <li>Email: riccieripalacios@gmail.com</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">    
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="<?= base_url(); ?>/home"><img src="<?= media();?>/images/logoiepp.png" width="40px" alt=""></a>
								<a href="<?= base_url(); ?>/home">IEPP Sistema</a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav> 
                                        <ul id="navigation">                                                                                          
                                            <li><a href="<?= base_url(); ?>/home">Inicio</a></li>
                                            <li><a href="">Bíblias</a>
                                                <ul class="submenu">
                                                    <li><a href="<?= base_url(); ?>/Bibliaweb/BibliaRV">Reina Valera 1960</a></li>
                                                    <li><a href="<?= base_url(); ?>/Bibliaweb/BibliaHB">Holy Bible</a></li>
                                                </ul>
                                            </li>
											<li><a href="">Alabanzas</a>
                                                <ul class="submenu">
													<li><a href="<?= base_url(); ?>/Himnarioweb">Himnario Oficial IEPP</a></li>
              										<li><a href="<?= base_url(); ?>/Alabanzasweb">Cancionero de Alabanzas</a></li>
                                                </ul>
                                            </li>
											<li><a href="">Cadenas de Coros</a>
                                                <ul class="submenu">
													<li><a href="<?= base_url(); ?>/Cadenasweb/CadenasAvweb">Cadenas de Avivamiento</a></li>
              										<li><a href="<?= base_url(); ?>/Cadenasweb/CadenasAdweb">Cadenas de Adoración</a></li>
                                                </ul>
                                            </li>
											<li><a href="">Partituras</a></li>
  											<li><a href="<?= base_url(); ?>/Privilegiosweb">Privilegios</a></li>
											<?php if(isset($_SESSION['login'])) { ?>
                                                <li><a href="">Administrador</a>
                                                    <ul class="submenu">
                                                        <li><a href="<?= base_url(); ?>/Dashboard">Admin</a></li>
                                                        <?php if($_SESSION['idRolUser'] == 1) { ?>
                                                        <li><a href="<?= base_url(); ?>/Predicasweb">Predicas</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
												<li><a href="<?= base_url(); ?>/Logout">Cerrar Sesión</a></li>
											<?php }else{?>
												<li><a href="<?= base_url(); ?>/Login">Iniciar Sesión</a></li>
											<?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div> 
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>