<?php
if (PHP_SAPI === 'cli') {
$id = $argv[0];
$id = abs(intval($id));
if (!$id) $id = 404;
}
else $id = 404;

$site_link=$_SERVER["SERVER_NAME"];
// ассоциативный массив кодов и описаний
$a[401] = "Требуется авторизация";
$a[403] = "Пользователь не прошел аутентификацию, доступ запрещен";
$a[404] = "Документ не знайдено";
$a[500] = "Внутрішня помилка сервера";
$a[400] = "Неправильний запит";

// определяем дату и время в стандартном формате
$time = date("d.m.Y H:i:s");
// эта переменная содержит тело сообщения
$body ="
Введений Вами URL: <b>http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."</b><br />
Можливо цікаву для Вас інформацію можна знайти по іншій адресі:<br />
<a href=\"http://$site_link\" target=\"_blank\"><b>http://$site_link</b></a><br />
<br />
IP сайту: <b>".$_SERVER["REMOTE_ADDR"]."</b><br />
Ваш браузер: <b>".$_SERVER["HTTP_USER_AGENT"]."</b><br />
Час на сервері: <b>".$time."</b><br />
";
$body .= "Ваш IP через проксі: <b>".$_SERVER["HTTP_X_FORWARDED_FOR"]."</b><br />\n";

?>	
<div class="header">
	<h1 class="page-title">Помилка</h1>
</div>

<div class="main-content">
	<div class="row">
		<div class="col-md-12 text-center">
				<h1 class="error-404 text-danger"><?=$id?></h1>
				<h3><?=$a[$id]?></h3>
				<hr>
				<p><?=$body?></p>
				<?=$_SERVER["SERVER_SIGNATURE"]?> 
		</div>
	</div>
</div>