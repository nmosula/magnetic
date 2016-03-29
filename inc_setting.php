<?php
session_start();
@SetLocale(LC_ALL,"ukr_UKR.CP1251");
$root_path=$_SERVER["DOCUMENT_ROOT"];

include_once ($_SERVER["DOCUMENT_ROOT"]."/inc/mysql.class.php");
include_once ($_SERVER["DOCUMENT_ROOT"]."/inc/db.php");
include_once ($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");

include_once ($_SERVER["DOCUMENT_ROOT"]."/inc/functions.php");
include_once ($_SERVER["DOCUMENT_ROOT"]."/inc/func_translit.php");

include_once ($_SERVER["DOCUMENT_ROOT"]."/reg_user.php");

$_basename = basename ($_SERVER["REQUEST_URI"]);

if ($_SESSION["valid_user"]) 		$valid_user			=$_SESSION["valid_user"];
if ($_SESSION["valid_name"]) 		$valid_name			=$_SESSION["valid_name"];
if ($_SESSION["valid_total_price"])	$valid_total_price	=$_SESSION["valid_total_price"];

if (isset($_SESSION["valid_user"])) include ($root_path."/shopping_cart_check.php");
?>