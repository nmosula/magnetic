<?php
////////////// ???? ? ????? ???? ?? ???????? ?????
/*
if (isset($language))
{
	if (session_is_registered($lang))
	{
	session_unregister("lang");
	@session_destroy();
	}
	$lang=$language;
	session_register("lang");
}
else
{
	if (!isset($lang))
	{
		$lang="ru";
		session_register("lang");
	}
}
*/
///////////////

////////////???? ?? ?? ????
$lang="ua";
////////////???? ?? ?? ????

$include_lang="./modules/lang/".$lang.".php";
 if(is_file($include_lang))
  require($include_lang);
 else
  require("./404_lang.php");
//echo "<br>after - session=$l";
?>