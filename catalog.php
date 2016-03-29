<?php
include ("inc_setting.php");

$page_NO			= isset ($_GET['page_NO']) ? $_GET['page_NO']:"1";

$table				= $table_product;
$page_name			= "catalog";

if ((isset ($_POST["sort"])) && (isset ($_POST["show_kilk"])))
{
	$_SESSION['filtr']['sort']		= $_POST["sort"];
	$_SESSION['filtr']['show_kilk']	= $_POST["show_kilk"];
}

$show_kilk	= isset ($_SESSION['filtr']['show_kilk']) ? $_SESSION['filtr']['show_kilk']:4;
$sort		= isset ($_SESSION['filtr']['sort']) ? $_SESSION['filtr']['sort']:"cina";
$order		= isset ($_SESSION['filtr']['order']) ? $_SESSION['filtr']['order']:"asc";
	

$META_title			= $company_name. " :: Каталог";
$META_keywords		= "Каталог";
$META_description	= $company_name. " - Каталог";
include ($root_path."/header.php");
?>

		<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="/">Головна</a></li>
                    <li class="active">Каталог</li>
                </ol>
            </div>
        </div>
		
        <!-- Our services? -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header bordered">
					<i class="fa fa-tasks"></i> Каталог
                </h1>
			</div>
		</div>
		
		
        <div class="row">
            <div class="col-lg-12">
				<form action="/<?php echo $page_name?>/" id="frm-filtr-srt" method="post" class="form-inline">
					<div class="form-group">
					<label for="popularity-sort">Cортувати по:</label>
						<select name="sort" class="form-control" id="popularity-sort" >
							<option value="name" <?if ($sort=="name") echo "selected"?>>Назві</option>
							<option value="cina" <?if ($sort=="cina") echo "selected"?>>Ціні</option>
							<option value="id_order" <?if ($sort=="id_order") echo "selected"?>>Поступленні</option>
						</select>
					</div>
					<div class="form-group">
					<label for="item-count">Показувати по:</label>
						<select name="show_kilk" class="form-control" id="item-count">
							<option value="1" <?if ($show_kilk=="1") echo "selected"?>>1 шт</option>
							<option value="2" <?if ($show_kilk=="2") echo "selected"?>>2 шт</option>
							<option value="4" <?if ($show_kilk=="4") echo "selected"?>>4 шт</option>
							<option value="10" <?if ($show_kilk=="10") echo "selected"?>>10 шт</option>
						</select>
					</div>
				</form>
			</div>
		</div>
		<hr>
<?php
include ($root_path."/modules/navigation_header.php");
			
if ($num > 0)
{
?>
		<div class="row">
<?php
for ($i=0; $i<$num; $i++)
{
$row=$db->fetch_array($res);
			$id			= $row["id"];
			$id_order	= $row["id_order"];
			$cina		= $row["cina"];
			$name		= stripslashes($row["name"]);
			$foto_image_f= $row["image"];
			$image		= "sm_".$foto_image_f;
			$short		= stripslashes($row["short"]);
			
			$cina		= explode (".", $cina);
			
			$path_img	= "/data/product/small/".$image;
			$_prepare_url_name = "/product/".str2url($name)."-id".$id."/";
?>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 wow fadeInLeft" data-wow-offset="50">
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
						<div class="col-md-6 wow fadeInRight" data-wow-offset="50">
							<h4 class="text-warning"><a href="<?=$_prepare_url_name?>"><?=$name?></a></h4>
							<p><?=$short?></p>
							<p class="price text-success"><?=$cina[0]?><sup><?=$cina[1]?></sup></p>
							<p><a href="#" class="btn btn-info CART-good-add" data-add-id="<?=$id?>"><i class="fa fa-shopping-cart"></i> В кошик </a></p>
						</div>
					</div>			
				</div>
<?php
}
?>

		</div>
<?php
}

include ($root_path."/modules/navigation_footer.php");
?>



<?php
include ($root_path."/footer.php")?>