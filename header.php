<!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		
		<meta name="keywords" content="<?php echo ( (!isset($META_keywords)) or (empty($META_keywords)) )?$META_keywords_original:$META_keywords;?>" />
		<meta name="description" content="<?php echo ( (!isset($META_description)) or (empty($META_description)) )?$META_description_original:str_replace('"', '\'', $META_description)?>" />
	
	    <meta name="robots" content="all">
		<meta name="author" content="Nazar Mosula">

		<title><?php echo ( (!isset($META_title)) or (empty($META_title)) )?$META_title_original:$META_title;?></title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="/css/bootstrap.min.css">
	    <link rel="stylesheet" href="/css/style.css">
		
		<link rel="stylesheet" href="/css/animations.css">
		<link rel="stylesheet" href="/css/animate.css">
		<link rel="stylesheet" href="/modules/icon/highslide/highslide.css">
		<!-- Important Owl stylesheet -->
		<link href="/modules/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="/modules/owl-carousel/owl.theme.css" rel="stylesheet">

	    <!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.css">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
		
		<script src="/modules/icon/highslide/highslide-full.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			hs.graphicsDir = '/modules/icon/highslide/graphics/';
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'rounded-white';
			hs.fadeInOut = true;
			hs.dimmingOpacity = 0.75;
			hs.creditsText = '<?php echo $site_domain_www?>';

			// Add the controlbar
			hs.addSlideshow({
				//slideshowGroup: 'group1',
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .75,
					position: 'bottom center',
					hideOnMouseOut: true

				}
			});
		</script>
	</head>
<body>


    <!-- Navigation -->
	<nav id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><b>MagneticOne - тест</b></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li <?php if (basename ($_SERVER["PHP_SELF"])=="catalog.php") echo "class=\"active\"";?>><a href="/catalog/"><i class="fa fa-tasks"></i>  Каталог</a></li>
					<li><a href="#" id="modal-shopping-cart"><i class="fa fa-shopping-cart"></i> Кошик (<span class="sp-total-items" class="value"><?php echo shopping_cart_total_items($_SESSION["cart"]);?></span>)</a></li>
<?
if (!$_SESSION['valid_user'])
{
?>
                    <li <?php if (basename ($_SERVER["PHP_SELF"])=="register.php") echo "class=\"active\"";?>><a href="/register/"><i class="fa fa-user-plus"></i> Реєстрація</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#block-login"><i class="fa fa-user fa-fw"></i> Вхід</a>
						<ul class="block-login dropdown-menu">
							<li>
								<div class="login-content">
								<form action="/" name="forma_autentification" method="post">
									<input type="hidden" name="aut" value="yes">
									<div class="form-group">
										<label>E-mail:</label>
											<div class="input-group">
											<span class="input-group-addon">@</span>
												<input name="email" type="text" class="form-control">
											</div>
									</div>
									<div class="form-group">
										<label>Пароль:</label>
											<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
												<input name="pass" type="password" class="form-control">
											</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"> <i class="fa fa-sign-in"></i> Вхід</button>
									</div>
								  </form>
								</div>
							</li>
						</ul>
					</li>
<?
}
else
{
?>
					<li><a href="#"><strong class="text-primary"><?=$valid_name?></strong></a></li>
					<li><a href="/?des=yes"><i class="fa fa-sign-out"></i> Вийти</a></li>
<?
}
?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">