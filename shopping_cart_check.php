<?
session_start();
if (isset ($_SESSION['cart'])) reset($_SESSION["cart"]);

if (!empty($_POST["add"]))
{
	$id=$_POST["add"];
		if ( $_SESSION["cart"][$id] >0 )
			{
				$new_kilk=$_SESSION["cart"][$id]+1;
				$_SESSION["cart"][$id] = $new_kilk;
			}
		else 
			$_SESSION["cart"][$id] = 1;
}


if ($_POST["del"])
{
	$id=$_POST['del'];
	if ( $_SESSION['cart'][$id] >0 ) $_SESSION['cart'][$id] = 0;
}

if ($_POST["set"])
{
	$id		= $_POST['set'];
	$kilk	= $_POST['kilk'];
	$_SESSION['cart'][$id] = $kilk;
}

if ($_POST["save"])
{
$tovar_id_array	= $_POST["tovar_id_array"];
$tovar			= $_POST["tovar"];
for ($i=0; $i<count($tovar_id_array); $i++)
{
	$new_count=$tovar[$i];
	if (empty($new_count)) $new_count=0;
	$good=$tovar_id_array[$i];
	
	//$check_kilk_good=mysql_fetch_array(mysql_query("select kilk from $table_goods where id='$good'"));
	//$kilk_good=$check_kilk_good["kilk"];
	//$new_count=$new_count>$kilk_good?$kilk_good:$new_count;
	$id=$good;
	$_SESSION['cart'][$id] = $new_count;
}
}

if ($_POST["del_check"])
	{
	$newid=$_POST["newid"];
		for ($i=0;$i<count($newid);$i++)
		{
			$id=$newid[$i];
			if ( $_SESSION['cart'][$id] >0 ) $_SESSION['cart'][$id] = 0;
		}
	}
	
if ($_POST["clean"])
	unset( $_SESSION['cart']);

if (isset ($_SESSION['cart'])) reset($_SESSION["cart"]);

?>
