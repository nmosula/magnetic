<?php
session_start();
include ("../inc/mysql.class.php");
include ("../inc/db.php");
include ("../inc/config.php");
include ("../inc/functions.php");
include ("./reg_admin.php");
include ("../modules/api.watermark.php");
set_time_limit("3600");
$l="uk";
?>
<!DOCTYPE html>
<head>
	<title><?=$company_name?> - Адміністративна частина</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Тестове завдання">
    <meta name="author" content="Nazar Mosula">
	
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../modules/icon/highslide/highslide.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="stylesheet" type="text/css" href="css/premium.css">
	
    <script type="text/javascript" src="lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="lib/jquery.form.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../modules/tinymce/tinymce.min.js"></script>

	<script src="../modules/icon/highslide/highslide-full.js" type="text/javascript"></script>
	<script type="text/javascript">
		hs.graphicsDir = '../modules/icon/highslide/graphics/';
		hs.align = 'center';
		hs.transitions = ['expand', 'crossfade'];
		hs.outlineType = 'rounded-white';
		hs.fadeInOut = true;
		hs.dimmingOpacity = 0.75;
		hs.lang =  {creditsText : '<?php echo $site_domain_www?>'};
	</script>	
</head>

<body class="theme-blue">
    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
   
  <!--<![endif]-->
  
<?php
if (isset($_SESSION["valid_admin"]))
{
?>

    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> <?=$company_name?></span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?=$_SESSION['valid_admin']?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="./">Власні дані</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Admin Panel</li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="?des=yes"><i class="fa fa-fw fa-power-off"></i> Вийти</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </nav>
    

    <div class="sidebar-nav">
    <ul>
		<li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Меню<i class="fa fa-collapse"></i></a></li>
		<li>
			<ul class="dashboard-menu nav nav-list collapse in">
				<li><a href="?go=golovna"><span class="fa fa-caret-right"></span> Головна сторінка</a></li>
				<li><a href="?go=product"><span class="fa fa-caret-right"></span> Товари</a></li>
				<li><a href="?go=users"><span class="fa fa-caret-right"></span> Користувачі</a></li>
				<li><a href="?go=orders"><span class="fa fa-caret-right"></span> Замовлення</a></li>
				<li><a href="?go=contact"><span class="fa fa-caret-right"></span> Контакти</a></li>
				<li><a href="?go=mychange"><span class="fa fa-caret-right"></span> Власні дані</a></li>
			</ul>
		</li>
		<li><a href="?des=yes" class="nav-header"><i class="fa fa-fw fa-power-off"></i> Вихід</a></li>
	</ul>
    </div>

	<div class="content">
	
	<? 
//$go=(isset($_GET["go"]);
$go	= isset($_GET["go"]) ? $_GET["go"] : $_POST["go"];
if(!$go)  $go="mychange";
  
$include=$go.".php";

 if(is_file($include))
  require($include);
 else
  require("404.php");
?>

    </div>
	<div id="ajaxLoading" class="spinner" style="display:none;">
		<img id="loading" src="images/loading-icons/loading12.gif">
	</div>
	
<?
}
else
	require ("login.php");
?>
	


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
		
			$("div.alert-dismissible").each(function(){
					$(this).delay(5000).fadeIn(400).slideUp( 800, function() {
							$(this).remove();
						});
			});
			
			$("[rel=tooltip]").tooltip();
			$(function() {
				$('.demo-cancel-click').click(function(){return false;});
			});

        });

    </script>
	
	
    
  
</body></html>
