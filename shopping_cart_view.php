<?php
session_start();
//sleep(2);
include ("inc_setting.php");
include ("shopping_cart_check.php");


if (isset($_SESSION["cart"]))
{
?>

<form action="#" name="forma_cart" method="post">
	<table class="table table-hover table-bordered">
    <tr>
    <th class="text-center" colspan="2">Назва</th>
    <th class="text-center" style="width: 6em;">Ціна</th>
    <th class="text-center" style="width: 8em;">Кількість</th>
    <th class="text-center" style="width: 8em;">Всього</th>
    </tr>
<?php
$total_all=0;
$total_items=0;

	while(list($id,$kilk)=each($_SESSION["cart"]))
	{
		if ($kilk>0)
		{
		$row = get_row ($id, $table_product);
		
		$price		= number_format($row["cina"], 2, '.', '');
		$total		= $kilk*$price;
		$total_all	+= $total;
		$total_items+= $kilk;
?>
				
		<input type="hidden" name="tovar_id_array[]" value="<?php echo $id?>">
		<tr id="div-<?=$id?>" data-good-id="<?=$id?>">
		<td class="text-center" style="width: 2.5em;"><a href="#" class="CART-good-del" data-good-id="<?=$id?>"><i class='fa fa-remove text-danger'></i></a></td>
		<td><?php echo stripslashes($row["name"])?></td>
		<td id="sp-price-<?=$id?>" class="text-right"><?php echo number_format($price, 2, '.', ' ')?></td>
		<td>
			<div class="input-group input-group-sm">
						<input id="sp-kilk-<?=$id?>" class="form-control" style="max-width:60px" size="12" type="text" readonly value="<?=$kilk?>" data-rest="9" data-amount="0">
						<span class="input-group-btn">
							<button class="btn btn-default CART-good-minus" type="button" data-good-id="<?=$id?>"><i class="fa fa-minus"></i></button>
							<button class="btn btn-default CART-good-plus" type="button" data-good-id="<?=$id?>"><i class="fa fa-plus"></i></button>
						</span>

			</div>
		</td>
		<td id="sp-good-total-<?=$id?>" class="text-right"><?php echo number_format($total,2, '.', ' ')?></td>
		</tr>
<?php
		} //if kilk
	} //while
?>
		<tr>
			<th class="sp-total-items text-right" colspan="4"><b><?php echo $total_items?></b></th>
			<th id="sp-total-price" class="text-right"><b><?php echo number_format($total_all, 2, '.', ' ')?></b></th>
		</tr>

		</table>
		</form>

<?php
}
else
{
?>
	<p class="text-primary text-center">Кошик порожній</p>
<?php
}
?>

	<script type="text/javascript">
		$(document).ready(function(){
			
			CART_reload_price();
	
			function CART_reload_price() {
			
				var total_items = 0;
				var total_price = 0;
			
				$("tr[id^='div-']").each(function(index, value){
					var good_id	= $(this).data("good-id");
					var good_price	= $("#sp-price-"+ good_id).html();
					var good_kilk	= $("#sp-kilk-" + good_id).val();
					
					
					var good_total	= good_price * good_kilk;
					
					$("#sp-good-total-" + good_id).html(number_format(good_total, 2, ".", " "));
					
					total_items += parseInt(good_kilk);
					total_price += parseFloat(good_total);
				});
				
				total_price = number_format(total_price, 2, ".", " ");
				
				$(".sp-total-items").html(total_items);
				$("#sp-total-price").html(total_price);
				if (total_items == 0)
					$(".CART-order").addClass("disabled");
				else
					$(".CART-order").removeClass("disabled");
			}
		
		
			$(".CART-good-del").on("click", function() {
				if (confirm('Ви дійсно бажаєте знищити позицію?')) {
					var del_id		= $(this).data("good-id");
					var dataString	= 'del='+ del_id;
					var dataRow		= $("#div-"+del_id);
					
					$.ajax({
						type: "POST",
						url: "/shopping_cart_check.php",
						data: dataString,
						cache: false,

						complete: function() {
							dataRow.remove();
							CART_reload_price();
						}
					});
					return false;
				}
			});
			
			
			$(".CART-good-plus, .CART-good-minus").on ("click", function () {
					var mul		= $(this).is(".CART-good-plus") ? 1 : -1;
					var good_id	= $(this).data("good-id");
					var $input	= $("#sp-kilk-" + good_id);
					var value	= parseInt($input.val());
					var qty		= 1;
					
					value = isNaN(value) ? qty : value + mul * qty;
					value = value < qty ? qty : value;
					$input.val(value);
					
					
					var dataString = "set=" + good_id + "&kilk=" + value;
					
					$.ajax({
						type: "POST",
						url: "/shopping_cart_check.php",
						data: dataString,
						cache: false,
					});
					
					CART_reload_price();
				
			});

		//CART_reload_price();	
		});
	</script>