<?
if (!preg_match("/127.0.0.1/", $_SERVER["SERVER_ADDR"]))
{
$GB_DB["host"]   = "localhost";
$GB_DB["dbName"] = "lakjak_magnetic_db";
$GB_DB["user"]   = "lakjak_office";
$GB_DB["pass"]   = "nazar123";
}
else {
$GB_DB["host"]   = "localhost";
$GB_DB["dbName"] = "magnetic_db";
$GB_DB["user"]   = "root";
$GB_DB["pass"]   = "0468";
}

$db=new book_sql();
$db->connect();
?>
