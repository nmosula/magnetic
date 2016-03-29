<?php
//открывает сессию
session_start();

error_reporting (E_ALL); 
/*
//присваивает PHP переменной captchastring строку символов
$captchastring = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
//получает первые 6 символов после их перемешивания с помощью функции str_shuffle
$captchastring = substr(str_shuffle($captchastring), 0, 6);
*/
$captchastring = rand(1000, 9999);

//инициализация переменной сессии с помощью сгенерированной подстроки captchastring,
//содержащей 6 символов
$_SESSION["captcha"] = $captchastring;
 
//Генерирует CAPTCHA
 
//создает новое изображение из файла background.png 
$image = imagecreatefrompng("background.png");
//устанавливает цвет (R-200, G-240, B-240) изображению, хранящемуся в $image
$colour = imagecolorallocate($image, 200, 200, 200);
//присваивает переменной font название шрифта
if (!preg_match("/127.0.0.1/", $_SERVER["SERVER_ADDR"]))
	$font = $_SERVER["DOCUMENT_ROOT"]."/modules/captcha/oswald.ttf";
else
	$font = "oswald.ttf";
//устанавливает случайное число между -10 и 10 градусов для поворота текста 
$rotate = rand(-10, 10);
//рисует текст на изображении шрифтом TrueType (1 параметр - изображение ($image), 
//2 - размер шрифта (18), 3 - угол поворота текста ($rotate), 
//4, 5 - начальные координаты x и y для текста (18,30), 6 - индекс цвета ($colour),
//7 - путь к файлу шрифта ($font), 8 - текст ($captchastring) 
imagettftext($image, 18, $rotate, 10, 27, $colour, $font, $captchastring);
//будет передавать изображение в формате png
header("Content-type: image/png");
//выводит изображение
imagepng($image);
?>