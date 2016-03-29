<?
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
  
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
  
    $bytes /= pow(1024, $pow);
  
    return round($bytes, $precision) . ' ' . $units[$pow];
}

function count_view($id, $table)
{
$result = mysql_query("select sum(kilk) as sum_kilk from $table where id='$id'");
$row=mysql_fetch_array($result);
return $row["sum_kilk"];
}

function CensorBadWords($strg) {
	global $table_bad_words, $db;
		$replace = "*****";
		$result=$db->query("select * from ".$table_bad_words);
		while ($row = $db->fetch_array($result)) {
			$strg = eregi_replace($row["word"], $replace, $strg);
		}
	return $strg;
}
	

	function get_derevo($id)
	{
		global $table;
		global $array_id;
	
		$res=mysql_query ("select id from ".$table." where pid='$id'");
		$num=mysql_num_rows($res);
		if ($num>0)
				while ($row=mysql_fetch_array($res))
				{
					$id=$row["id"];
					array_push ($array_id, $id);
					get_derevo($id);
				}
				
	return $array_id;
	}// end function

function get_article($id)
{
$result = mysql_query("select * from articles where id='$id'");
$row=mysql_fetch_array($result);
return $row;
}

function get_categories()
{
$list = array();
$result = mysql_query("select * from category order by name");
	for ($count=0; $row=mysql_fetch_array($result); $count++)
		$list[$count] = $row;
return $list;
}

function get_name($id, $table_name)
{
global $db;
$result = $db->query("select name from ".$table_name." where id='$id'");
$row=$db->fetch_array($result);
return stripslashes($row["name"]);
}

function get_name_where($id, $table_name, $where="")
{
global $l;
if (empty($where)) $where="where id='$id'";
$query="select name_$l from ".$table_name." $where";
$result = mysql_query($query);
$row=mysql_fetch_array($result);
return stripslashes($row["name_$l"]);
}

function get_row($id, $table_name)
{
$result = mysql_query("select * from ".$table_name." where id='$id'");
$row=mysql_fetch_array($result);
return $row;
}

function get_goods($category)
{
$list = array();
if ($category=='')
	$result = mysql_query("select * from goods order by id");
else
	$result = mysql_query("select * from goods where catid='$category' order by id");
	
	for ($count=0; $row=mysql_fetch_array($result); $count++)
		$list[$count] = $row;
return $list;
}

function get_admin_info()
{
global $table_admin;
$result = mysql_query("select * from ".$table_admin);
$row=mysql_fetch_array($result);
return $row;
}

function es($t)
{
$l=100;
$t=substr($t, 0, $l);
$t=substr($t, 0, strrpos($t, " "));
$t=nl2br($t);
return $t;
}

function vrizka()
{
	$new="";
	do
	{
		$new_st=substr($st, 0, $l);
		$pp=strrpos($new_st, "/")+1;
		$new_st2=substr($st, 0, $pp);
		$st=substr($st, $pp);
		$new.=$new_st2."<br>";
	}
	while (strlen($st)>$l);
	$new.=$st;
	return $new;
}

function vrizka_full ($description, $limit)
{
	$new_name=explode(" ",$description);
	$ii=count($new_name);
	$new_n="";
	for ($jj=0; $jj<$ii; $jj++)
	{
		$new_n.=$new_name[$jj];
		if (strlen($new_n)>$limit)
		{
			$pos_probel = strrpos($new_n, " ");
			$new_n = substr ($new_n, 0, $pos_probel);
			break;
		}
		else $new_n.=" ";
	}
if (strlen($description)>$limit) $new_n.="...";

return $new_n;
}

function shopping_cart_total_items ($ses)
{
	$total_items=0;

	if (count ($ses) > 0)
	{
		reset ($ses);
		while(list($id,$kilk)=each($ses))
			if ($kilk>0)	$total_items+= $kilk;
	}
	
	return $total_items;
}
?>
