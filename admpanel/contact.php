<?
$table		= $prefix_db."_contact";
$page_name	= "contact";

// Якщо немає таблиці в БД то створюємо
$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `phone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `skype` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `social_facebook` varchar(250) NOT NULL,
  `social_twitter` varchar(250) NOT NULL,
  `social_pinterest` varchar(250) NOT NULL,
  `social_linkedin` varchar(250) NOT NULL,
  `social_instagram` varchar(250) NOT NULL,
  `social_dribbble` varchar(250) NOT NULL,
  `social_vk` varchar(250) NOT NULL,
  `social_ok` varchar(250) NOT NULL,
  `social_google_plus` varchar(250) NOT NULL,
  `short` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$db->query ($sql_table_create);

?>
<script type="text/javascript">

tinymce.init({
    selector: '#description',
	
	language : 'uk_UA',
	plugins: [
		"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"table contextmenu directionality template textcolor paste textcolor colorpicker textpattern responsivefilemanager"	
	],
	  
	toolbar1: "newdocument fullpage | undo redo | cut copy paste | searchreplace | table | hr removeformat | subscript superscript | ltr rtl | spellchecker | visualchars visualblocks nonbreaking ",
	toolbar2: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link unlink anchor image responsivefilemanager media code",
	toolbar3: "styleselect formatselect fontselect fontsizeselect  | forecolor backcolor | print fullscreen ",
   
   
	external_filemanager_path:"/modules/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "/modules/filemanager/plugin.min.js"},

	image_advtab: true, 
	menubar: false,
    toolbar_items_size: 'small',


});
</script>

<div class="header">
           
	<h1 class="page-title">Контакти</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<li class="active">Контактні дані</li>
	</ul>

</div>

<div class="main-content">

<?
if (isset($_POST["frm-save"]))
{
$phone			= addslashes ($_POST["phone"]);
$email			= addslashes($_POST["email"]);
$skype			= addslashes($_POST["skype"]);
$address		= addslashes ($_POST["address"]);
$short		 	= addslashes ($_POST["short"]);
$description 	= addslashes ($_POST["description"]);
$social_facebook= addslashes($_POST["social_facebook"]);
$social_twitter	= addslashes($_POST["social_twitter"]);
$social_pinterest= addslashes($_POST["social_pinterest"]);
$social_linkedin= addslashes($_POST["social_linkedin"]);
$social_instagram= addslashes($_POST["social_instagram"]);
$social_dribbble= addslashes($_POST["social_dribbble"]);
$social_vk		= addslashes($_POST["social_vk"]);
$social_ok		= addslashes($_POST["social_ok"]);
$social_google_plus= addslashes($_POST["social_google_plus"]);



	$num=$db->num_rows($db->query("select id from ".$table." "));
	if ($num>0)
		$res   = $db->query ("update ".$table." 
								set phone='$phone',
								email='$email',
								skype='$skype',
								address='$address',
								short='$short',
								description='$description',
								social_facebook='$social_facebook',
								social_twitter='$social_twitter',
								social_pinterest='$social_pinterest',
								social_linkedin='$social_linkedin',
								social_instagram='$social_instagram',
								social_dribbble='$social_dribbble',
								social_vk='$social_vk',
								social_ok='$social_ok',
								social_google_plus='$social_google_plus'");
	else
		$res   = $db->query ("insert into ".$table." 
			(	phone,
				email,
				skype,
				address,
				short,
				description,
				social_facebook,
				social_twitter,
				social_pinterest,
				social_linkedin,
				social_instagram,
				social_dribbble,
				social_vk,
				social_ok,
				social_google_plus )
		values
			(	'$phone',
				'$email',
				'$skype',
				'$address',
				'$short',
				'$description',
				'$social_facebook',
				'$social_twitter',
				'$social_pinterest',
				'$social_linkedin',
				'$social_instagram',
				'$social_dribbble',
				'$social_vk',
				'$social_ok',
				'$social_google_plus'
				)");
	
	if ($res)
	{
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo "<p class='text-success'>Дані успішно змінені в базі даних!</p>";?>
		</div>
		<?php
	}
}

$res=$db->query("select * from ".$table." ");
$row=$db->fetch_array($res);
	$phone			= stripslashes($row["phone"]);
	$email			= stripslashes($row["email"]);
	$skype			= stripslashes($row["skype"]);
	$address		= stripslashes($row["address"]);
	$short		 	= stripslashes($row["short"]);
	$description	= stripslashes($row["description"]);
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
<form class="form-horizontal" action="./" role="form" method="post">
<input type="hidden" name="go" value="<?=$page_name?>">

<ul id="TabContact" style="margin-bottom: 20px;" class="nav nav-tabs nav-justified">
	<li class="active">
		<a href="#contact1" data-toggle="tab"><i class="fa fa-globe"></i> Контакти</a>
	</li>
	<li class="">
		<a href="#contact2" data-toggle="tab"><i class="fa fa-list"></i> Опис</a>
	</li>
	<li class="">
		<a href="#contact3" data-toggle="tab"><i class="fa fa-share-alt"></i> Соц.мережі</a>
	</li>
</ul>

<div id="myTabContent" class="tab-content">

<div class="tab-pane fade active in" id="contact1">
  <div class="form-group">
    <label for="address" class="col-sm-3 control-label">Головна адреса</label>
    <div class="col-sm-6">
            <textarea class="form-control" name="address" id="address" cols="30" rows="3"><? echo $address?></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <label for="phone" class="col-sm-3 control-label">Телефони</label>
    <div class="col-sm-6">
            <textarea class="form-control" name="phone" id="phone" cols="30" rows="2"><? echo $phone?></textarea>
    </div>
  </div>
  
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">E-mail</label>
    <div class="col-sm-6">
            <textarea class="form-control" name="email" id="email" cols="30" rows="2"><? echo $email?></textarea>
    </div>
  </div>  
</div>
  
<div class="tab-pane fade" id="contact2">
  <div class="form-group">
    <label for="short" class="col-sm-2 control-label">Короткий опис</label>
    <div class="col-sm-8">
            <textarea class="form-control" name="short" id="short" cols="60" rows="6"><? echo $short?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Детальний опис</label>
    <div class="col-sm-10">
		<textarea name="description" id="description" style="width:100%; height: 300px;"><?=$description?></textarea>
    </div>
  </div>
</div>

<div class="tab-pane fade" id="contact3">
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-3">
      Ми соц. мережах (ввести посилання якщо такі існують, разом <b>http://</b>)
    </div>
  </div>
  
  <div class="form-group">
    <label for="skype" class="col-sm-3 control-label"><i class="fa fa-skype"></i> skype</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="skype" name="skype" value='<?echo $skype?>'>
    </div>
  </div>
  
  <div class="form-group">
    <label for="social_facebook" class="col-sm-3 control-label"><i class="fa fa-facebook-square"></i> facebook</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_facebook" name="social_facebook" value='<?echo $social_facebook?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_twitter" class="col-sm-3 control-label"><i class="fa fa-twitter-square"></i> twitter</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_twitter" name="social_twitter" value='<?echo $social_twitter?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_pinterest" class="col-sm-3 control-label"><i class="fa fa-pinterest-square"></i> pinterest</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_pinterest" name="social_pinterest" value='<?echo $social_pinterest?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_linkedin" class="col-sm-3 control-label"><i class="fa fa-linkedin-square"></i> linkedin</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_linkedin" name="social_linkedin" value='<?echo $social_linkedin?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_instagram" class="col-sm-3 control-label"><i class="fa fa-instagram"></i> instagram</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_instagram" name="social_instagram" value='<?echo $social_instagram?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_dribbble" class="col-sm-3 control-label"><i class="fa fa-dribbble"></i> dribbble</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_dribbble" name="social_dribbble" value='<?echo $social_dribbble?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_vk" class="col-sm-3 control-label"><i class="fa fa-vk"></i> vkontakte</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_vk" name="social_vk" value='<?echo $social_vk?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_ok" class="col-sm-3 control-label"><i class="fa fa-odnoklassniki-square"></i> odnoklassniki</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_ok" name="social_ok" value='<?echo $social_ok?>'>
    </div>
  </div>
  
   <div class="form-group">
    <label for="social_google_plus" class="col-sm-3 control-label"><i class="fa fa-google-plus-square"></i> google+</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="social_google_plus" name="social_google_plus" value='<?echo $social_google_plus?>'>
    </div>
  </div>
</div>

  <div class="form-group">
    <div class="col-sm-12 text-center">
      <input type="submit" class="btn btn-primary" name="frm-save" value="Зберегти...">
    </div>
  </div>
 
</div>
</form>
 
 <hr>

	<div class="row">
		<div class="col-sm-4">
			<address>
				<b><?php echo $company_name?></b><br>
				<span id="map-input">
					<?php echo nl2br($address)?>
				</span>
				<br>
				тел: <?php echo nl2br($phone)?>
			</address>
		</div>
		<div class="col-sm-8">
			<div id="map-canvas"></div>
		</div>
	</div>
 
</div>

<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
<script type="text/javascript">
 
$(document).ready(function() {
		
/* google maps */
google.maps.visualRefresh = true;

var map;
function initialize() {
	var geocoder = new google.maps.Geocoder();
	var address = $('#map-input').text(); /* change the map-input to your address */
	var mapOptions = {
    	zoom: 15,
    	mapTypeId: google.maps.MapTypeId.ROADMAP,
     	scrollwheel: false
	};
	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	
  	if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

            var infowindow = new google.maps.InfoWindow(
                {
                  content: address,
                  map: map,
                  position: results[0].geometry.location,
                });

            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map, 
                title:address
            }); 
			
			

          } else {
          	alert("No results found");
          }
        }
      });
	}
}
google.maps.event.addDomListener(window, 'load', initialize);

/* end google maps */

});

</script>