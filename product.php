<?php
include ("inc_setting.php");
$id_product			= isset($_GET["id_product"])?$_GET["id_product"]:$_POST["id_product"];
$table				= $table_product;

$product_name 		= get_name($id_product, $table_product);

$META_title			= $product_name ." :: Каталог :: ".$company_name;
$META_keywords		= "Каталог, ".$product_name ;
$META_description	= $product_name . " - Каталог - ".$company_name;
include ($root_path."/header.php");
?>

		<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="/">Головна</a></li>
                    <li><a href="/catalog/">Каталог</a></li>
                    <li class="active"><?php echo $product_name?></li>
                </ol>
            </div>
        </div>
		
        <!-- Our services? -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header bordered">
					<i class="fa fa-tasks"></i> <?php echo $product_name?>
                </h1>
			</div>
		</div>
		
		
		<div class="row">
<?php
$res	= $db->query ("select * from ".$table_product." where id='".$id_product."'");
$row	= $db->fetch_array($res);
			$id			= $row["id"];
			$id_order	= $row["id_order"];
			$cina		= $row["cina"];
			$name		= stripslashes($row["name"]);
			$foto_image_f= $row["image"];
			$image		= "sm_".$foto_image_f;
			$short		= stripslashes($row["short"]);
			$full		= stripslashes($row["full"]);
			
			$cina		= explode (".", $cina);
			
			$path_img	= "/data/product/small/".$image;
			$_prepare_url_name = "/product/".str2url($name)."-id".$id."/";
?>
						<div class="col-md-3 wow fadeInLeft" data-wow-offset="50">
<?php
							if ($foto_image_f!='NO')
							{
?>
								<a class="highslide thumbnail" onclick="return hs.expand(this)" href="/data/product/<?=$foto_image_f?>">
									<img class="img-rounded"  src="/data/product/small/<?=$image?>">
								</a>
<?php
							}
							else echo "<img class='img-rounded' src='/images/nofoto.gif'>";
?>
						</div>
						<div class="col-md-9 wow fadeInRight" data-wow-offset="50">
							<h4 class="text-warning"><a href="<?=$_prepare_url_name?>"><?=$name?></a></h4>
							<p><?php echo $short?></p>
							<p><?php echo $full?></p>
							<p class="price text-success"><?=$cina[0]?><sup><?=$cina[1]?></sup></p>
							<p><a href="#" class="btn btn-info CART-good-add" data-add-id="<?=$id?>"><i class="fa fa-shopping-cart"></i> В кошик </a></p>
						</div>
		</div>


<?php
include ($root_path."/footer.php")?>