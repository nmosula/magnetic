<?php
$table				= $prefix_db."_product";
$page_name			= "product";

$show_kilk			= 10;

$sort				= 'id_order';
$order				= 'asc';

$foto_show_width	= "170"; //вказати px;
$foto_show_height	= "120"; //вказати px;

// Якщо немає таблиці в БД то створюємо
$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_order` int(10) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `short` text NOT NULL,
  `full` text NOT NULL,
  `cina` float(10,2) NOT NULL DEFAULT '0.00',
  `image` varchar(100) NOT NULL DEFAULT 'NO',
  `kilk` int(10) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$db->query ($sql_table_create);

?>
<script type="text/javascript">

tinymce.init({
    selector: '#full',
	
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
           
	<h1 class="page-title">Товари</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<?php
		if ((isset($_GET["add"])) or (isset($_POST["add"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Товари</a> </li>
		<li class="active">Додавання</li>
		<?
		}
		elseif ((isset($_GET["edit"]))  or (isset($_POST["edit"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Товари</a> </li>
		<li class="active">Редагування</li>
		<?
		}
		else
		{
		?>
		<li class="active">Товари</li>
		<?
		}
		?>
	</ul>

</div>

<div class="main-content">
<?
if ((isset($_GET["add"])) or (isset($_POST["add"])))
	include ("./".$page_name."_add.php");
elseif ((isset($_GET["edit"]))  or (isset($_POST["edit"])))
	include ("./".$page_name."_edit.php");
else
{
?>

<?
if ($_GET["add_record"]=="1")
{
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo "<p class='text-success'>Запис успішно доданий в базу даних!</p>";?>
		</div>
		<?php
}

if ($_GET["edit_record"]=="1")
{
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo "<p class='text-success'>Запис успішно змінений в базі даних!</p>";?>
		</div>
		<?php
}

if (isset($_POST["del_check"]))
{
	$newid=$_POST["newid"];
		for ($i=0;$i<count($newid);$i++)
		{	
			$res = $db->query("select * from ".$table." where id='".$newid[$i]."'");
			$row = $db->fetch_array($res);
			$image_original	= $row["image"];
			$image_small	= "sm_".$image_original;

			$path_small 	= "../data/product/small/".$image_small;		if (file_exists($path_small))		@unlink($path_small);
			$path_original	= "../data/product/".$image_original;			if (file_exists($path_original))	@unlink($path_original);
			$query="delete from ".$table." where id='".$newid[$i]."'";
			$res = $db->query ($query);
			if ($res)
			{
					?>
					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<?php echo "<p class='text-success'>Запис успішно знищений з бази даних!</p>";?>
					</div>
					<?php
			}
		}
}

if ( (isset($_GET["sort_new"])) && (!empty($_GET["sort_new"])))
{
	$sort_new	= $_GET["sort_new"];
	$sort_this	= $_GET["sort_this"];
	$id_this_sort= $_GET["id_this_sort"];

	$query_sort1	= "update ".$table." set id_order='".$sort_this. "' where id_order='".$sort_new."'";
	$query_sort2	= "update ".$table." set id_order='".$sort_new."' where id='".$id_this_sort. "'";
	$db->query($query_sort1);
	$db->query($query_sort2);
}

include ("./navigation_header.php");	
?>
<div class="row">
    <div class="col-sm-9">
	<?php include ("./navigation_footer.php");?>
	</div>	
    <div class="col-sm-3">
		<div class="btn-toolbar list-toolbar">
			<a href="./?go=<?=$page_name?>&add=yes" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Додати</a>
		</div>
	</div>
</div>


<form action="./?go=<?=$page_name?>" method="post" role="form" name="forma">
<input type="hidden" name="page" value="<?=$page?>">

<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th style="width: 2em;">#</th>
      <th class="text-center" style="width: 3.5em;"><i class="fa fa-sort"></i></th>
      <th style="width: <?echo $foto_show_width+20?>px">Рисунок</th>
      <th class="text-center">Назва/Опис</th>
      <th class="text-center" style="width: 4em;">К-сть</th>
      <th class="text-center" style="width: 4em;">Ціна</th>
      <th class="text-center" style="width: 3.5em;"><i class="fa fa-cogs"></i></th>
    </tr>
  </thead>
  <tbody>
  
<?
$sort_prev=0;
for ($i=0; $i<$num; $i++)
{
$row=$db->fetch_array($res);
		$id		= $row["id"];
		$id_order=$row["id_order"];
		$name	= $row["name"];
		$cina	= $row["cina"];
		$kilk	= $row["kilk"];
		$data	= $row["data"];
		$foto_image_f	= $row["image"];
		$image	= "sm_".$foto_image_f;
				
		$full=$row["full"];
		$short=$row["short"];
		
		$name=stripslashes($name);
		$full=stripslashes($full);
		$short=stripslashes($short);
		
		
		$row_sort=$db->fetch_array($db->query("select id_order from ".$table." where id_order>'$id_order' limit 0,1"));
		$sort_next = $row_sort["id_order"];
		
?>
<tr id="div-<?=$id?>">
	<td>
		<input type="checkbox" class="chk-inverse" name="newid[]" value="<?=$id?>">
	</td>
	<td class="text-center">
		<?
		if (!empty($sort_next))
			echo "<a href='./?go=$page_name&sort_new=$sort_next&sort_this=$id_order&id_this_sort=$id&page=$page'><i class=\"fa fa-arrow-down\"></i></a>";
		if ($sort_prev!=0)
			echo "<a href='./?go=$page_name&sort_new=$sort_prev&sort_this=$id_order&id_this_sort=$id&page=$page'><i class=\"fa fa-arrow-up\"></i></a>";
		?>
	</td>
	<td class="text-center">
		<?php
            if ($foto_image_f!='NO')
			{
				echo "<a class=\"highslide thumbnail\" onclick=\"return hs.expand(this)\" href=\"/data/product/".$foto_image_f."\">";
				echo "<img class='img-rounded' src='../modules/timthumb.php?src=/data/product/small/".$image."&w=".$foto_show_width."&h=".$foto_show_height."'>";
				echo "</a>";
			}
			else echo "<img class='img-rounded' src='../images/nofoto.gif'>";
		?>		
	</td>
	<td>
	<p class="text-muted"><small><i class="fa fa-calendar"></i> <?php echo date("d/m/Y H:i", $data);?></small></p>
	<?php echo "<strong>".$name."</strong><br>";
		echo "<small>".nl2br(vrizka_full($short, 500))."</small>";
	?>
	</td>
	<td>
	<?php echo $kilk;?>
	</td>
	<td>
	<?php echo "<strong>".$cina."</strong>";?>
	</td>
	<td>
		<a href="./?go=<?=$page_name?>&edit=<?php echo $id?>&page=<?=$page?>"><i class="fa fa-pencil"></i></a>
        <a href="#" class="btn-delete" data-del-id="<?=$id?>"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
<?
$sort_prev=$id_order;
}
?>
</table>
<?php
if ($num > 0) {
?>
<div class="btn-toolbar list-toolbar">
    <button id="btn-invert" class="btn btn-sm btn-warning"><i class="fa fa-check"></i> Інвертувати</button>
    <button type="submit" name="del_check" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Знищити відмічені</button>
    <a href="./?go=product&add=yes" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Додати</a>
</div>
<?php
}
?>
</form>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Знищення</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-pencil modal-icon"></i>Запис успішно знищений з бази даних!</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button>
        </div>
      </div>
    </div>
</div>

</div>

	<script type="text/javascript">
		$(document).ready(function(){
		
		$('#info-del').addClass("hidden");
		
			$("#btn-invert").on("click", function() {
				var checked = $('.chk-inverse').filter(":checked");
				var unchecked = $('.chk-inverse').filter(":not(:checked)");
				
				checked.each(function(){$(this).prop('checked',false);});
				unchecked.each(function(){$(this).prop('checked',true);});
				
				return false;	
			});
			
			$(".btn-delete").on("click", function() {
				if (confirm("Ви дійсно бажаєте знищити позицію?")) {
				
					var del_id = $(this).data("del-id");				
					var dataString = 'del='+ del_id;
					var parent = $(this).parent().parent();
					var dataRow = $("#div-"+del_id);
					
					$.ajax({
						type: "POST",
						url: "product_del.php",
						data: dataString,
						cache: false,

						beforeSend: function() {
							$('#ajaxLoading').show();  
						}, 
						success: function() {
							parent.animate({opacity: 0.3}, 300).slideUp('slow', function() {dataRow.remove();});
						},
						complete: function() {
							$('#ajaxLoading').hide();
							$('#myModal').modal("show");
						}
					});
					return false;
				}
			});
			
			
		});
	</script>


<?
} //for else
?>
