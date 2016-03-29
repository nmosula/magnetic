<?php
include ("inc_setting.php");
$table				= $table_users;
$page_name			= "register";

$META_title			= "Реєстрація :: ".$company_name;
$META_keywords		= "реєстрація, ".$product_name ;
$META_description	= "Реєстрація - ".$company_name;
include ($root_path."/header.php");


?>
		<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="/">Головна</a></li>
                    <li class="active">Реєстрація</li>
                </ol>
            </div>
        </div>
		
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header bordered">
					<i class="fa fa-user-plus"></i> Реєстрація
                </h1>
			</div>
		</div>
<?php
if (isset ($_SESSION['valid_user']) && (!empty($_SESSION['valid_user'])) && (shopping_cart_total_items($_SESSION["cart"]) > 0))
{

		$data_order = time();
		$ip		= $_SERVER["REMOTE_ADDR"];
		
		$query = "insert into ".$table_orders."
			(id_user, data)
			values
			('".$_SESSION['valid_user']."', '".$data_order."')";
			
		$res = $db->query ($query);
		
		$res2= $db->query("select id from ".$table_orders." order by id desc limit 0,1");
		$row2= $db->fetch_array ($res2);
		$id_order = $row2["id"];
		
		if (isset($_SESSION['cart']))
		{
		reset($_SESSION["cart"]); //скидання курсора масива
			while(list($id,$kilk)=each($_SESSION["cart"]))
			{
				$row = get_row ($id, $table_product);
				$id_product = $row["id"];
				$cina		= $row["cina"];
			
				if ($kilk > 0)
				{
					$query="insert into ".$table_order_list." values ('$id_order', '$id_product', '$cina', '$kilk')";
					//echo $query;
					$res=$db->query ($query);
				}
			}
		}
		unset( $_SESSION['cart']);

?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			Дякуємо за за замовлення
		</div>
<?php
}
else
{
	?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			Кошик порожній
		</div>
<?php	
}


include ($root_path."/footer.php")?>