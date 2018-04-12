    <!--ALEJANDRO SANCHEZ -->
    <!--PROGRAMADOR FULL STACK-->
    <!--Correo: aesh1415.as@gmail.com-->
    <!--Skype: aesh1415.as@gmail.com-->
<!DOCTYPE html>
<html lang="en">
<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Afire - Multipurpose Business Theme">
		<meta name="author" content="Syed Ekram">
		<!-- Site Title -->
		<title>Bomberos Balzar</title>
		
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,600,400italic,600italic,700' rel='stylesheet' type='text/css'>
		
		 <!-- Bootstrap min CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/bootstrap/css/bootstrap.min.css">
		
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/fonts/font-awesome.min.css">
		
		<!---owl carousel Css-->
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/owlcarousel/css/owl.theme.css">
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/owlcarousel/css/owl.transitions.css">
		
		<!-- animate CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/css/animate.css">
		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>template/assets/css/style.css">  
		
		<!--JQUERY-->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	    <!--JQUERY UI-->
	    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	    <!--SLIMSCROLL-->
	    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
    <body>

		<!-- START PRELOADER -->
		<div id="preloader">
			<div id="status">
				<div class="status-mes"><h4>Bomberos</h4></div>
			</div>
		</div>
		<!-- END PRELOADER -->
	
	<!-- START HEADER TOP-->
		<div id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-9 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
						<div class="header_contact">
							<ul>
								<li><i class="fa fa-phone"></i> 2-031-713</li>
								<li><i class="fa fa-phone"></i> Emergencia (ECU 911)</li>
								<li><a href="mailto:bomberosbalzar@hotmail.com"><i class="fa fa-envelope"></i> @hotmail.com</a></li>
							</ul>
						</div>
					</div><!--- END COL -->
					<div class="col-md-3">
						<div class="header_social pull-right">
							<ul>
								<li><a class="facebook wow bounceInUp" data-wow-delay=".1s" target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a class="twitter wow bounceInUp" data-wow-delay=".2s" target="_blank" href="https://twitter.com/BomberosBalzar/"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>
					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</div>
		<!-- END HEADER TOP -->
	
		<!-- START NAVBAR -->
		<div class="navbar navbar-default menu-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar">hola</span>
                        <span class="icon-bar">que tal</span>
                        <span class="icon-bar">como estas</span>
                    </button>
    
					<a href="#" class="navbar-brand wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.7s" data-wow-offset="0"><img style="width: 30%;position: relative;top: -27px;" src="<?= base_url() ?>img/logo1.png" alt="logo"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
					<li><a href="<?= base_url() ?>login">mmmme</a></li>
                        <li><a href="<?= base_url() ?>login">Entrar</a></li>
                    </ul>
                </div> 
            </div><!--- END CONTAINER -->
        </div> 
		<!-- END NAVBAR -->

	
		<!-- START HOME SLIDER -->
        <section id="home">
            <div id="afire-home-carousel" class="carousel slide carousel-fade home-slider control-one" data-ride="carousel" data-interval="2000">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
    			
    			<?php if($banner){ ?>
	    			<?php foreach ($banner as $key => $value) { ?>
	                  <div class="item <?php if($key == 0){ ?> active <?php } ?>" style="background: url('<?= base_url(); ?>imgTemplates/Banners/<?= $value['imagen'] ?>');background-position: center;background-repeat: no-repeat;background-size: cover;">
	                    <img src="<?= base_url() ?>template/assets/img/bg/slider-1.jpg" alt="First slide" class="img-responsive" style="opacity: -1;"><!-- slider-1 -->
	                    <div class="carousel-caption">
	                      <h1 class="animated fadeInDown delay-1"><span><?= $value['titulo'] ?></span></h1>
	                      <a class="btn learnmore-btn animated fadeInUp delay-4" href="#welcome">Empezar</a>
	                    </div>
	                  </div><!-- SLIDER ONE -->
	    			<?php } ?>
	    		
                <!-- Controls -->
                <a class="left carousel-control" href="#afire-home-carousel" role="button" data-slide="prev">
                    <span class="fa fa-angle-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#afire-home-carousel" role="button" data-slide="next">
                    <span class="fa fa-angle-right"></span>
                    <span class="sr-only">Next</span>
                </a>
	    		<?php }else{ ?>
					<div class="alert alert-danger"><h3>No existen datos del banner</h3></div>
	    		<?php } ?>

            </div> <!-- /.carousel -->
        </section> 
		<!-- END HOME SLIDER  -->

		<!-- START WELCOME -->
		<section id="welcome" class="section-padding">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-12 wow zoomIn">
						<div class="welcome_title">
							<h2><span>Bienvenido</span></h2>
							<p>CUERPO DE BOMBEROS DE BALZAR</p>
						</div>
					</div><!-- END COL -->
				</div><!-- START ROW -->
				<div class="row text-center">
					<?php if(isset($infoEmpresa[0]['mision'])){ ?>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<div class="welcome_single">
							<i class="fa fa-eye"></i>
							<h4>Vision</h4>
							<div class="slim">
								<p class="text-justify" style="padding-right: 25px;"><?= $infoEmpresa[0]['mision'] ?></p>
							</div>
						</div>
					</div><!-- END COL -->
					<?php } ?>
					<?php if(isset($infoEmpresa[0]['vision'])){ ?>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
						<div class="welcome_single">
							<i class="fa fa-tablet"></i>
							<h4>Mision</h4>
							<div class="slim">
								<p class="text-justify" style="padding-right: 25px;"><?= $infoEmpresa[0]['vision'] ?></p>
							</div>
						</div>
					</div><!-- END COL -->
					<?php } ?>
					<?php if(isset($infoEmpresa[0]['objetivo'])){ ?>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
						<div class="welcome_single">
							<i class="fa fa-btc"></i>
							<h4>Objetivo</h4>
							<div class="slim">
								<p class="text-justify" style="padding-right: 25px;"><?= $infoEmpresa[0]['objetivo'] ?></p>
							</div>
						</div>
					</div><!-- END COL -->
					<?php } ?>
				</div><!-- END ROW -->
			</div><!-- END CONTAINER -->
		</section>
		<script>
			$('.slim').slimScroll({
		        height: '250px'
		    })
		</script>
		<!-- END WELCOME  -->
	

		<!-- START RECENT WORK -->
		<section id="recent_work" class="section-padding">
			<div class="container">
				<div class="row">

					<div class="col-md-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h3 class="recent_work_title">Noticias</h3>
						<div id="team__carousel" class="carousel slide" data-ride="carousel" data-interval="9999999">
							<!-- Indicators -->

							<ol class="carousel-indicators">
								<?php foreach ($noticias as $keyNN => $valueNN) { ?>
							  		<li data-target="#team__carousel" data-slide-to="<?= $keyNN ?>" class="<?php if($keyNN == 0){ ?> active <?php } ?>"></li>
							  	<?php } ?>
							</ol>
							<div class="carousel-inner text-center">
							  <!-- Item 1 -->
							    <?php foreach ($noticias as $keyN => $valueN) { ?>
								  <div class="item <?php if($keyN == 0){ ?> active <?php } ?>">
									<div class="cover-container">
									  <a href="#">
										  <div style="background: url('<?= base_url(); ?>imgTemplates/Noticias/<?= $valueN['imagen'] ?>');background-position: center;background-repeat: no-repeat;background-size: cover;">
										  	<img src="<?= base_url() ?>template/assets/img/recent-1.jpg" alt="recent-1" style="opacity: 0;" />
										  </div>
									  <h4><?= $valueN['titulo'] ?></h4>

									  <div class="noti">
									  	<p style="text-align: justify;padding-right: 25px;"><?= $valueN['descripcion'] ?></p>
									  </div>
										<script>
											$('.noti').slimScroll({
										        height: '100px'
										    })
										</script>
									  </a>
									</div>
								  </div>
								<?php } ?>
							</div>
						  </div>
					</div><!--- END COL -->
					
					<div class="col-md-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h3 class="recent_work_title">LEY DE TRANSPARENCIA</h3>
						<?php foreach ($pdfs as $keyPDF => $valuePDF) { ?>
							<div class="single_service_work">
								<div class="media">
									<div class="media-left">
									<a href="<?= base_url() ?>imgTemplates/PDFS/<?= $valuePDF['imagen'] ?>" target="_blank"><i class="fa fa-file-pdf-o"></a></i>
									</div>
									<div class="media-body text-left">
										<h4 class="media-heading"><?= $valuePDF['titulo'] ?></h4>
									</div>
								</div>
							</div>
						<?php } ?>

					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>	
		<!-- END RECENT WORK -->
	
		<!-- START FOOTER TOP-->
		<div id="footer-top" class="section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
						<div class="single_footer text-center">
							<img alt="logo" src="<?= base_url() ?>img/logo1.png">
						</div>
					</div>
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</div>
		<!-- END FOOTER TOP -->
		
		
		<!-- START FOOTER BOTTOM -->
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<p class="footer_social pull-left"><a href="https://www.facebook.com/ericka.lovely.girl" target="_blank">Erika Espinoza.</a></p>
						<div class="footer_social pull-right">
							<ul>
								<li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
								<li><a href="https://twitter.com/BomberosBalzar/" target="_blank">Twitter</a></li>
								<li><a href="#">(593)(04) 2031713</a></li>
								<li><a href="#">(593)(04) 2439394</a></li>
								<li><a href="mailto:cbcbalzar@gmail.com">cbcbalzar@gmail.com</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END FOOTER BOTTOM-->


        <!-- Javascript files -->
		<!-- jQuery -->
        <script src="<?= base_url() ?>template/assets/js/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled and minified bootstrap js -->
        <script src="<?= base_url() ?>template/assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- owl-carousel js  -->
		<script src="<?= base_url() ?>template/assets/owlcarousel/js/owl.carousel.min.js"></script>
		<!-- WOW - Reveal Animations When You Scroll -->
        <script src="<?= base_url() ?>template/assets/js/wow.min.js"></script>
		<!-- main js -->
        <script src="<?= base_url() ?>template/assets/js/blog.js"></script>
        <script src="<?= base_url() ?>template/assets/js/scripts.js"></script>
		<script type="text/javascript">
			/*partner carousel*/
			 $(".partner").owlCarousel({
				  autoPlay: 3000, //Set AutoPlay to 3 seconds
			 
				  items : 4,
				  itemsDesktop : [1199,3],
				  itemsDesktopSmall : [979,3]
			});
			/*End partner carousel*/
		</script>	
    </body>

<!-- Mirrored from ekramit.net/shape/afire-preview/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Nov 2016 17:35:41 GMT -->
</html>