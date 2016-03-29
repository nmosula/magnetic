<?
if (!isset($where))	$where=" ";
if (!isset($order))	$order="desc";
if (!isset($sort))	$sort="id";

	$res=$db->query("select * from ".$table." ".$where." order by ".$sort." ".$order);
	$num_all=$db->num_rows($res);
	$db->free_result($res);
	
$page_NO	= isset($_GET["page_NO"]) ? $_GET["page_NO"] : $_POST["page_NO"];
if (empty($page_NO)) $page_NO = 0;

$show_nav	= floor($page_NO/10);
if (($page_NO%10)==0) $show_nav-=1;

$show_page	= $page_NO * $show_kilk - $show_kilk;
if ($show_page<0)	$show_page=0;
if ($show_nav<0)	$show_nav=0;


$nextp=$show_page+$show_kilk;
	$query="select * from ".$table." ".$where." order by ".$sort." ".$order." limit ".$show_page.", ".$show_kilk;
	$res=$db->query($query);

	$num=$db->num_rows($res);
	if ($num<$show_kilk)
		$navigat_next='stop';

	if ($num_all/$show_kilk)
		$navigat_next='stop';
	
if ($num==0)
{
	echo "<p align=\"center\">На жаль, нічого не знайдено!</p>";
}
else
{
	$nnee=$show_page+$num;
	$showww1=$show_page+1;
	$showww2=$showww1+$num-1;
	$showww=$showww1."-".$showww2;
}
