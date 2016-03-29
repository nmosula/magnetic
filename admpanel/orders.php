<?php
$table				= $prefix_db."_orders";
$page_name			= "orders";

$show_kilk			= 10;

$sort				= 'id';
$order				= 'desc';

$foto_show_width	= "170"; //вказати px;
$foto_show_height	= "120"; //вказати px;

// Якщо немає таблиці в БД то створюємо
$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table` (
  `id` int(10) NOT NULL auto_increment,
  `id_user` int(10) NOT NULL,
  `data` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
$db->query ($sql_table_create);

$sql_table_create="
CREATE TABLE IF NOT EXISTS `$table_order_list` (
  `id_order` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `cina` float NOT NULL,
  `kilk` int(5) NOT NULL,
  KEY `id_order` (`id_order`,`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
";
$db->query ($sql_table_create);

?>

<div class="header">
           
	<h1 class="page-title">Замовлення</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<?php
		if ((isset($_GET["add"])) or (isset($_POST["add"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Замовлення</a> </li>
		<li class="active">Додавання</li>
		<?
		}
		elseif ((isset($_GET["edit"]))  or (isset($_POST["edit"])))
		{
		?>
		<li><a href="?go=<?=$page_name?>">Замовлення</a> </li>
		<li class="active">Редагування</li>
		<?
		}
		else
		{
		?>
		<li class="active">Замовлення</li>
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
      <th class="text-center" style="width: 2em;">#</th>
	  <th class="text-center" style="width: 3em;">№</th>
      <th class="text-center">Ім’я</th>
      <th class="text-center" style="width: 5em;">К-сть</th>
      <th class="text-center" style="width: 5em;">Сума</th>
      <th class="text-center" style="width: 4em;">Дата</th>
      <th class="text-center" style="width: 2em;"><i class="fa fa-shopping-cart"></i></th>
      <th class="text-center" style="width: 3.5em;"><i class="fa fa-cogs"></i></th>
    </tr>
  </thead>
  <tbody>
  
<?
$sort_prev=0;
$total_search_count=0;
$total_search_suma=0;

for ($i=0; $i<$num; $i++)
{
$row=$db->fetch_array($res);
		$id		= $row["id"];
		$id_user= $row["id_user"];

		$row_user = get_row ($id_user, $table_users);
		$name	= stripslashes ($row_user["name"]);
		$phone	= stripslashes ($row_user["phone"]);
		$email	= stripslashes ($row_user["email"]);
		
		$data	= $row["data"];

		$res_cart	= $db->query("select sum(kilk) as total_count, sum(kilk*cina) as total_price from ".$table_order_list." where id_order='".$id."'");
		$row_cart	= $db->fetch_array($res_cart);
		$total_price= $row_cart["total_price"];
		
		$total_search_count	+= $row_cart["total_count"];
		$total_search_suma	+= $total_price;
?>
<tr id="div-<?=$id?>">
	<td>
		<input type="checkbox" class="chk-inverse" name="newid[]" value="<?=$id?>">
	</td>
	<td class="text-center"><?php echo $id;?></td>
	<td>
<?php
	if (!empty($name)) echo "<strong>".$name."</strong>";
	if (!empty($email)) echo "<br>".$email;
	if (!empty($phone)) echo "<br>".$phone;
?>
	</td>
	<td class="text-center"><?php echo $row_cart["total_count"];?></td>
	<td class="text-right"><strong><?php echo number_format($total_price, 2, '.', '');?></strong></td>
	<td>
	<?php echo date("d/m/Y H:i", $data);?>
	</td>
	<td>
		<a href="#" class="modal-show-order-items" data-id-order="<?=$id?>"><i class="fa fa-search"></i> </a>
	</td>	
	<td>
	</td>
</tr>
<?
}
if ($num > 0)
{
	?>
	<tr>
	<th colspan="3"></th>
	<th class="text-center"><?php echo $total_search_count;?></th>
	<th class="text-center"><?php echo number_format($total_search_suma, 2, '.', '');?></th>
	<th colspan="3"></th>
	</tr>
	<?
}
?>
</table>
<?php
if ($num > 0) {
?>
<div class="btn-toolbar list-toolbar">
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

<div class="modal fade" id="ModalShoppingCart" tabindex="-1" role="dialog" aria-labelledby="ModalShoppingCart-Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="ModalShoppingCart-Label">Кошик</h3>
        </div>
        <div class="modal-body" id="modal-body_sk">

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Закрити</button>
        </div>
      </div>
    </div>
</div>

</div>



<?
} //for else
?>

	<script type="text/javascript">
		$(document).ready(function(){

			
			$(".modal-show-order-items").on("click", function() {
				var id_order = $(this).data("id-order");
				var dataString = 'id_order='+ id_order;
				
					$.ajax({
						type: "POST",
						data: dataString,
						url: "shopping_cart_view.php",
						cache: false,

						success: function(html) {
							$("#modal-body_sk").html(html);
						},
					});
					
				$('#ModalShoppingCart').modal("show");
			});
			
		});
	</script>