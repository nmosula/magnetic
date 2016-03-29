<?php
include ("../inc_setting.php");

$id_order = $_POST["id_order"];

if (!empty($id_order))
{
?>
	<p class="text-center padding-bottom">
		<strong>
			Замовлення №<?php echo $id_order;?>
		</strong>
	</p>
	
	<table class="table table-hover table-bordered">
    <tr>
    <th class="text-center" style="width: 2em;">#</th>
    <th class="text-center">Назва</th>
    <th class="text-center" style="width: 6em;">Ціна</th>
    <th class="text-center" style="width: 8em;">Кількість</th>
    <th class="text-center" style="width: 8em;">Всього</th>
    </tr>
<?php
	$total_all=0;
	$total_items=0;
	$i=0;
	$res_cart	= $db->query("select * from ".$table_order_list." where id_order='".$id_order."'");
	while ($row_cart	= $db->fetch_array($res_cart))
	{
		$i++;
		$id_product = $row_cart["id_product"];
		$kilk 		= $row_cart["kilk"];
		$cina 		= number_format ($row_cart["cina"], 2, '.', '');
		$row = get_row ($id_product, $table_product);
		
		$total		= $kilk*$cina;
		$total_all	+= $total;
		$total_items+= $kilk;
?>
				
		<tr>
		<td><?php echo $i;?></td>
		<td><?php echo stripslashes($row["name"]);?></td>
		<td class="text-right"><?php echo $kilk;?></td>
		<td class="text-right"><?php echo $cina;?></td>
		<td class="text-right"><?php echo number_format($total,2, '.', ' ')?></td>
		</tr>
<?php
	} //while
?>
		<tr>
			<th class="sp-total-items text-right" colspan="4"><b><?php echo $total_items?></b></th>
			<th id="sp-total-price" class="text-right"><b><?php echo number_format($total_all, 2, '.', ' ')?></b></th>
		</tr>

		</table>

<?php
} //if kilk
else
{
?>
	<p class="text-primary text-center">Кошик порожній</p>
<?php
}
?>
