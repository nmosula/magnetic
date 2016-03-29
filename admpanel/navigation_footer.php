<?
if ($num > 0)
{
	if (!isset($search_string))
		$search_string="";
	else $search_string="&".$search_string;

echo "

<ul class=\"pagination pagination-sm\">\n";
if ($navigat_next=='stop')
	$num_page=$num_all/$show_kilk;
else
	$num_page=floor($num_all/$show_kilk)+1;
	
if (!isset($show_nav)) $show_nav=0;

if ($show_nav>0)
{
$show_n=$show_nav-1;
$page_n=$show_kilk * $show_n*10 ;
$jj=$page_n/$show_kilk +1;
$jj2=$jj+10-1;
			echo "<li><a href='?go=$page_name$search_string'>1</a></li>\n";
			if ($jj!=1)
				echo "<li><a href='?go=$page_name&page=$jj$search_string'>...</a></li>\n";
			else
				echo "<li><a href='?go=$page_name$search_string'>...</a></li>\n";
}

$nav=($show_nav + 1)*10;
if ($num_page>$nav)
	$s_page=10;
else
	$s_page=$num_page-($show_nav*10);
	
for ($ii=0; $ii<$s_page; $ii++)
{

	if ($show_nav>0)
		$page_number=$show_kilk*$ii + $show_kilk*$show_nav*10;
	else
		$page_number=$show_kilk*$ii + $show_nav*10;
		
	$jj = $ii+1 + $show_nav*10;
	
		echo "<li";
			if ($show_page==$page_number) echo " class=\"active\"";
		echo ">";
		if ($jj!=1) echo "<a href='?go=$page_name&page=$jj$search_string'>$jj</a>";
		else echo "<a href='?go=$page_name$search_string'>$jj</a>";
		echo "</li>\n";
}


if ($num_page>$nav) 
{
$show_n=$show_nav+1;
$page_n=$show_kilk * $show_n*10 ;
$jj=$page_n/$show_kilk +1;


/*
$nav=($show_n + 1)*10;
if ($num_page>$nav)
	$s_page=10;
else
	$s_page=$num_page-($show_n*10);

$jj2=$jj+$s_page-1;
*/

			echo "<li><a href='?go=$page_name&page=$jj$search_string'>...</a></li>\n";
			
			
$ost_storinka=floor($num_all/$show_kilk)+1;
$ost_desyatok=floor($ost_storinka/10);
$ost_storinka2=$ost_storinka*$show_kilk-$show_kilk;

			echo "<li><a href='?go=$page_name&page=$ost_storinka$search_string'>$ost_storinka</a></li>\n";
}
  ?>
</ul>
<?
}
?>
