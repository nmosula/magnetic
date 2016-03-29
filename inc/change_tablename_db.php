<?
require ("config.php");
require ("db.php");

$sql = "SHOW TABLES FROM $mysql_db";
$result = mysql_query($sql);

if (!$result) {
   echo "DB Error, could not list tables\n";
   echo 'MySQL Error: ' . mysql_error();
   exit;
}

while ($row = mysql_fetch_row($result)) {
	$tbl_name=$row[0];
	if (!strstr($tbl_name, $prefix_db))
		$new_tbl_name=$prefix_db."_".$tbl_name;
	else
		$new_tbl_name=$tbl_name;
   echo "Table: $tbl_name  New: $new_tbl_name<br>";

	mysql_query ("ALTER TABLE ".$tbl_name." RENAME ".$new_tbl_name);
}


?>