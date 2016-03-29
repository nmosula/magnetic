<?
$table=$prefix_db."_golovna";
$page_name="golovna";

// Якщо немає таблиці в БД то створюємо
$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
$db->query ($sql_table_create);
?>
<div class="header">
           
	<h1 class="page-title">Інформація на головній сторінці</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<li class="active">Інформація на головній сторінці</li>
	</ul>

</div>

<script type="text/javascript">

tinymce.init({
    selector: 'textarea',
	
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

<div class="main-content">
<?
if (isset($_POST["frm-save"]))
{
$description = addslashes ($_POST["description"]);
if ($description == "<br />") $description="";
	$num=$db->num_rows($db->query("select id from ".$table." "));
	if ($num>0)
		$res   = $db->query ("update ".$table."  set description='$description'");
	else
		$res   = $db->query ("insert into ".$table."  (description) values ('$description')");
	
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
		$description=stripslashes($row["description"]);
?>
<form class="form-horizontal" action="./" role="form" method="post">
<input type="hidden" name="go" value="<?=$page_name?>">


  <div class="form-group">
    <div class="col-sm-12">
		<textarea name="description" style="width:100%; height: 300px;"><?=$description?></textarea>
    </div>
  </div>
  

  <div class="form-group">
    <div class="col-sm-12">
      <input type="submit" class="btn btn-primary" name="frm-save" value="Зберегти...">
    </div>
  </div>
</form>

</div>