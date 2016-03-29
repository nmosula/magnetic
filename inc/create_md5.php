<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MD5</title>
</head>

<body>
<?php
if ($_POST["send"])
{
	echo "<p>md5 для слова \"<b><u>".$_POST["slovo"]."</u></b>\" = ".md5($_POST["slovo"])."</p>";
}
?>

<form action="" method="post">
<fieldset>
	<legend>Розрахунок MD5 для слова</legend>
	<p>
		<label>Слово: </label>
		<input type="text" name="slovo" value="" />
	</p>
		<input type="submit" name="send" value="Надіслати" class="button" />
</fieldset>
</form>
</body>
</html>
