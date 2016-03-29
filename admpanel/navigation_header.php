<?
if (!isset($where))	$where=" ";
if (!isset($order))	$order="desc";
if (!isset($sort))	$sort="id";

	$res=$db->query("select * from ".$table." ".$where." order by ".$sort." ".$order);
	$num_all=$db->num_rows($res);
	$db->free_result($res);
	
$page	= isset($_GET["page"]) ? $_GET["page"] : $_POST["page"];
if (empty($page)) $page = 0;

$show_nav	= floor($page/10);
if (($page%10)==0) $show_nav-=1;

$show_page	= $page * $show_kilk - $show_kilk;
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
	
/*	
if ($num==0)
{
	echo "<p class='text-muted text-center'>".$lang["db_nofound"]."</p>";
}
else
{
	$nnee=$show_page+$num;
	$showww1=$show_page+1;
	$showww2=$showww1+$num-1;
	$showww=$showww1."-".$showww2;
//echo "<div align='center' class='box_text'>Всього записів <b>$num_all</b><br>Показано [<b>$showww</b>]</div>";
}
*/