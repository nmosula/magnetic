<?
$company_name		=	"MagneticOne - Test";
$prefix_db			=	"mo";
$site_domain		=	"magnetic.com";
$site_domain_www	=	"www.magnetic.com";

$META_keywords_original		=	"інтернет-магазин, купити, товар";
$META_description_original	=	"MagneticOne - інтернет-магазин товарів";
$META_title_original		=	"MagneticOne - Тестове завдання";

$table_admin			=	$prefix_db."_admin";
$table_contact			=	$prefix_db."_contact";
$table_golovna			=	$prefix_db."_golovna";
$table_product_gallery	=	$prefix_db."_product_gallery";
$table_product			=	$prefix_db."_product";
$table_product_view		=	$prefix_db."_product_view";
$table_users			=	$prefix_db."_users";
$table_orders			=	$prefix_db."_orders";
$table_order_list		=	$prefix_db."_order_list";

$im_category_f_w	=	1280;
$im_category_f_h	=	1024;

$im_brend_f_w		=	200;
$im_brend_f_h		=	200;

$im_foto_f_w		=	1280;
$im_foto_f_h		=	1024;
$im_foto_s_w		=	300;
$im_foto_s_h		=	200;

$im_golovna_slider_w	=	307;
$im_golovna_slider_h	=	393;

$im_partner_f_w		=	200;
$im_partner_f_h		=	200;


$res_ADMIN = $db->query("select * from ".$table_admin);
$row_ADMIN = $db->fetch_array($res_ADMIN);
$_ADMIN_EMAIL		=	$row_ADMIN["email"];
$_ADMIN_EMAIL_NAZAR	=	$row_ADMIN["email_admin"];
?>
