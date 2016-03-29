<?
if ($num!=0)
{
if (!isset($search_string))
{
$search_string="";
}
?>
        <div class="row text-left">
            <div class="col-sm-12">
				<ul class="pagination pagination-sm">
<?
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
			echo "<li><a href='".$pre_lang."/$page_name$search_string/'>1</a></li>";
			echo "<li><a href='".$pre_lang."/$page_name$search_string/page=$jj/'><</a></li>";
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
	$jj=$ii+1 + $show_nav*10;
	if ($show_page!=$page_number)
	{
			if ($jj!=1)
				echo "<li><a href='".$pre_lang."/$page_name$search_string/page=$jj/'>$jj</a></li>";
			else
				echo "<li><a href='".$pre_lang."/$page_name$search_string/'>$jj</a></li>";
	}
	else
			echo "<li class=\"active\"><a href=\"#\">$jj</a></li>";
}

if ($num_page>$nav) 
{
$show_n=$show_nav+1;
$page_n=$show_kilk * $show_n*10 ;
$jj=$page_n/$show_kilk +1;



			echo "<li><a href='".$pre_lang."/$page_name$search_string/page=$jj/'>></a></li>";
			
$ostatok_dilennya=$num_all/$show_kilk;
if (strstr($ostatok_dilennya, ".")) //якщо є дробна частина
	$ost_storinka=floor($num_all/$show_kilk)+1;
else
	$ost_storinka=floor($num_all/$show_kilk);
	
$ost_desyatok=floor($ost_storinka/10);
$ost_storinka2=$ost_storinka*$show_kilk-$show_kilk;
			echo "<li><a href='".$pre_lang."/$page_name$search_string/page=$ost_storinka/'>$ost_storinka</a></li>";
}
  ?>

				</ul>
			</div>
		</div><!-- /.row -->
<?
}
?>
