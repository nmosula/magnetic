<?
include ("../inc/mysql.class.php");
include ("../inc/db.php");
include ("../inc/config.php");

sleep("1");

if (isset($_POST["del"]))
{

$del=$_POST["del"];
$table = $table_product;
		
			$res = $db->query("select * from ".$table." where id='".$del."'");
			$row = $db->fetch_array($res);
			$image_original	= $row["image"];
			$image_small	= "sm_".$image_original;
			
			$path_small 	= "../data/product/small/".$image_small;		if (file_exists($path_small))		@unlink($path_small);
			$path_original	= "../data/product/".$image_original;			if (file_exists($path_original))	@unlink($path_original);
			$query="delete from ".$table." where id='".$del."'";
			$res=$db->query ($query);
}
?>