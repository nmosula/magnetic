    </div>
    <!-- /.container -->
	
<div class="modal fade" id="ModalShoppingCart" tabindex="-1" role="dialog" aria-labelledby="ModalShoppingCart-Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="ModalShoppingCart-Label">Кошик</h3>
        </div>
        <div class="modal-body" id="modal-body">


        </div>
        <div class="modal-footer">
			<button class="btn btn-danger CART-clean"><i class="fa fa-trash-o"></i> Очистити кошик</button>
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><i class="fa fa-shopping-cart"></i> Продовжити купівлю</button>
<?php

if (isset ($_SESSION['valid_user']))
{
?>	
			<a href="/insert-order/" class="btn btn-success CART-order"><i class="fa fa-dollar"></i> Оформити замовлення</a>
<?php
}
if (!isset ($_SESSION['valid_user']))
{
?>
			<div class="text-danger"> Для оформлення замовлення увійдіть в свій кабінет</div>
<?php
}
?>
        </div>
      </div>
    </div>
</div>
<?php			
$res=$db->query("select * from ".$table_contact." ");
$row=$db->fetch_array($res);
	$phone			= stripslashes($row["phone"]);
	$email			= stripslashes($row["email"]);
	$address		= stripslashes($row["address"]);	
	$skype			= stripslashes($row["skype"]);
	$social_facebook= stripslashes($row["social_facebook"]);
	$social_twitter	= stripslashes($row["social_twitter"]);
	$social_pinterest= stripslashes($row["social_pinterest"]);
	$social_linkedin= stripslashes($row["social_linkedin"]);
	$social_instagram= stripslashes($row["social_instagram"]);
	$social_dribbble= stripslashes($row["social_dribbble"]);
	$social_vk		= stripslashes($row["social_vk"]);
	$social_ok		= stripslashes($row["social_ok"]);
	$social_google_plus= stripslashes($row["social_google_plus"]);
?>
	<!-- Footer -->
<footer>
    <div class="container">
		<div class="row">
				
			<div class="col-md-4 col-sm-4 cols-xs-12 text-left">
				<address>
				<strong><div class="company-name"><?=$company_name?></div></strong><br>
				<abbr title="copyright"><i class="fa fa-copyright"></i></abbr> 2015-<?=date("Y")?>.<br>Всі права застережені<br>
				<small><?=$site_domain_www?></small>
				</address>
<?php
if ( 
	(!empty ($social_facebook))
	or (!empty ($social_twitter))
	or (!empty ($social_pinterest))
	or (!empty ($social_linkedin))
	or (!empty ($social_instagram))
	or (!empty ($social_dribbble))
	or (!empty ($social_vk))
	or (!empty ($social_ok))
	or (!empty ($social_google_plus))
	)
	{
?>
                <ul class="list-unstyled list-inline list-social-icons">
					<?php if (!empty ($social_facebook)) {?><li><a target="_blank" href="<?=$social_facebook?>" class="fa fa-facebook-square fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_twitter)) {?><li><a target="_blank" href="<?=$social_twitter?>" class="fa fa-twitter-square fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_pinterest)) {?><li><a target="_blank" href="<?=$social_pinterest?>" class="fa fa-pinterest-square fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_linkedin)) {?><li><a target="_blank" href="<?=$social_linkedin?>" class="fa fa-linkedin-square fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_instagram)) {?><li><a target="_blank" href="<?=$social_instagram?>" class="fa fa-instagram fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_dribbble)) {?><li><a target="_blank" href="<?=$social_dribbble?>" class="fa fa-dribbble fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_vk)) {?><li><a target="_blank" href="<?=$social_vk?>" class="fa fa-vk fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_ok)) {?><li><a target="_blank" href="<?=$social_ok?>" class="fa fa-odnoklassniki-square fa-2x"></a></li><?php } ?>
					<?php if (!empty ($social_google_plus)) {?><li><a target="_blank" href="<?=$social_google_plus?>" class="fa fa-google_plus-square fa-2x"></a></li><?php } ?>
                </ul>
<?
}

?>


			</div>
			
			<div class="col-md-3 col-sm-3 cols-xs-12 text-left">
				<ul>
					<li><a href="/catalog/">Каталог</a></li>
					<li><a href="/register/">Реєстрація</a></li>
				</ul>
			</div>

			
			<div class="col-md-3 col-sm-3 cols-xs-12">
				<address>
				<p>
					<span id="map-input">
<?php
						echo nl2br($address);
?>
					</span>
				</p>
				<p>
					<i class="fa fa-phone"></i> <abbr title="phone">тел.</abbr>: <?php echo nl2br($phone)?>
				</p>
				<p>
					<abbr title="www">http://</abbr><a href="http://<?=$_SERVER["HTTP_HOST"]?>"><?=$_SERVER["HTTP_HOST"]?></a>
				</p>
<?php
				if (!empty ($email)) {
?>
				<p>
					<i class="fa fa-envelope-o"></i> <abbr title="e-mail">@</abbr>:<?php echo nl2br($email);?>
				</p>
<?php
}
?>
				</address>
			</div>
		</div>
	</div>
</footer>
	
<a href="#" class="btn btn-md btn-default" id="toTop"> <i class="fa fa-chevron-up"></i></a>
<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>

	
    <!-- jQuery -->
    <script src="/js/jquery-1.9.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
	
	<script src="/modules/owl-carousel/owl.carousel.min.js"></script>
	<script src="/js/jquery.easing-1.3.min.js"></script>
    <script src="/js/wow.min.js"></script>
	<script src="/js/css3_animate-min.js"></script>
	<script src="/js/main.js"></script>
	<script src="/js/scripts.js"></script>
	
</body>

</html>