<?php
$table				= $prefix_db."_users";
$page_name			= "users";

$show_kilk			= 10;

$sort				= 'data';
$order				= 'desc';

$foto_show_width	= "170"; //вказати px;
$foto_show_height	= "120"; //вказати px;

// Якщо немає таблиці в БД то створюємо
$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `email` varchar(250) NOT NULL default '',
  `pass` varchar(100) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `data` varchar(100) NOT NULL default '',
  `ip` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$db->query ($sql_table_create);

?>

<div class="header">
           
	<h1 class="page-title">Користувачі</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<?php
		if ((isset($_GET["add"])) or (isset($_POST["add"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Користувачі</a> </li>
		<li class="active">Додавання</li>
		<?
		}
		elseif ((isset($_GET["edit"]))  or (isset($_POST["edit"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Користувачі</a> </li>
		<li class="active">Редагування</li>
		<?
		}
		else
		{
		?>
		<li class="active">Користувачі</li>
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



include ("./navigation_header.php");	
?>
<div class="row">
    <div class="col-sm-9">
	<?php include ("./navigation_footer.php");?>
	</div>	
    <div class="col-sm-3">
		<div class="btn-toolbar list-toolbar">
<!--			<a href="./?go=<?=$page_name?>&add=yes" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Додати</a>-->
		</div>
	</div>
</div>


<form action="./?go=<?=$page_name?>" method="post" role="form" name="forma">
<input type="hidden" name="page" value="<?=$page?>">

<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th style="width: 2em;">#</th>
      <th class="text-center">Ім’я</th>
      <th class="text-center">E-mail</th>
      <th class="text-center">IP</th>
      <th class="text-center" style="width: 4em;">Дата</th>
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
		$name	= stripslashes ($row["name"]);
		$phone	= stripslashes ($row["phone"]);
		$email	= stripslashes ($row["email"]);
		
		$data	= $row["data"];
		$ip		= $row["ip"];

		
?>
<tr id="div-<?=$id?>">
	<td>
		<input type="checkbox" class="chk-inverse" name="newid[]" value="<?=$id?>">
	</td>
	<td>
		<p><strong><?php echo $name;?></strong></p>
		<p><small><i class="fa fa-phone"></i> <?php echo $phone;?></small></p>
	</td>
	<td><?php echo $email;?></td>
	<td><?php echo $ip;?></td>
	<td>
	<p><?php echo date("d/m/Y H:i", $data);?></p>
	</td>
	<td>
<!--
		<a href="./?go=<?=$page_name?>&edit=<?php echo $id?>&page=<?=$page?>"><i class="fa fa-pencil"></i></a>
        <a href="#" class="btn-delete" data-del-id="<?=$id?>"><i class="fa fa-trash-o"></i></a>
-->
	</td>
</tr>
<?
}
?>
</table>
<?php
if ($num > 0) {
?>
<div class="btn-toolbar list-toolbar">
<!--
    <button id="btn-invert" class="btn btn-sm btn-warning"><i class="fa fa-check"></i> Інвертувати</button>
    <button type="submit" name="del_check" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Знищити відмічені</button>
    <a href="./?go=users&add=yes" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Додати</a>
-->
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



<?
} //for else
?>
