<?php
include ("inc_setting.php");
$table				= $table_users;
$page_name			= "register";

$META_title			= "Реєстрація :: ".$company_name;
$META_keywords		= "реєстрація, ".$product_name ;
$META_description	= "Реєстрація - ".$company_name;
include ($root_path."/header.php");


?>
		<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="/">Головна</a></li>
                    <li class="active">Реєстрація</li>
                </ol>
            </div>
        </div>
		
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header bordered">
					<i class="fa fa-user-plus"></i> Реєстрація
                </h1>
			</div>
		</div>
<?php
if (isset ($_POST["reg"]))
{
	$name	= $_POST["inputName"];
	$email	= $_POST["inputEmail"];
	$phone	= $_POST["inputPhone"];
	$pass1	= $_POST["inputPassword"];
	$pass2	= $_POST["inputPassword2"];
	$captcha	= $_POST["inputCaptcha"];
	
	$warning="";
	if (empty($name))		{$warning.="<p>Введіть ім’я</p>";}
	if (empty($email))		{$warning.="<p>Введіть email</p>";}
	if ((!empty($email)) && (!eregi("^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$",$email))) {$warning.="<p>Введіть правильно email</p>";}
	if (!empty($email))
	{
		$num=$db->num_rows($db->query("select id from ".$table_users." where email='".$email."'"));
		if ($num>0)			{$warning.="<p>Такий E-mail вже є в Базі Даних</p>";}
	}
	if (empty($pass1))		{$warning.="<p>Введіть пароль</p>";}
	if ((!empty($pass1)) && (strlen($pass1)<5)) {$warning.="<p>Введіть пароль більше 5 символів</p>";}
	if ((!empty($pass1)) && ($pass1!=$pass2)) {$warning.="<p>Будь ласка, звірте паролі</p>";}
	if ($captcha != $_SESSION["captcha"])	{$warning.="<p>Невірно введені цифри зображені на малюнку!!!</p>";}
	
	if (empty ($warning))
	{
		$name	= addslashes ($_POST["inputName"]);
		$email	= addslashes ($_POST["inputEmail"]);
		$phone	= addslashes ($_POST["inputPhone"]);
		$pass1	= $_POST["inputPassword"];
		$data_register = time();
		$ip		= $_SERVER["REMOTE_ADDR"];
		
		$query = "insert into ".$table_users."
			(name, email,  pass,  phone,  data, ip)
			values
			('$name', '$email',  md5('$pass1'),   '$phone',  '$data_register', '$ip')";
			
		$res = $db->query ($query);
?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			Дякуємо за реєстрацію
		</div>
<?php
		unset ($_SESSION["captcha"]);
	}
}

	if (!empty ($warning))
	{
?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<?php
			echo $warning;
?>
		</div>
<?php
	}
?>


		<form action="/<?php echo $page_name?>/" id="frm_register"  method="post" name="frm_register">
        <div class="row">
            <div class="col-md-4">
			
				<div class="form-group">
					<label class="control-label" for="inputName">Ім’я</label>
						<input type="text" id="inputName" name="inputName" class="form-control" placeholder="Ім’я.." value="<?php echo $_POST["inputName"]?>" required />
				</div>
				
				<div class="form-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="input-group">
						<span class="input-group-addon">@</span>
						<input type="text" id="inputEmail" name="inputEmail" class="form-control" value="<?php echo $_POST["inputEmail"]?>" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="inputPhone">Мобільний телефон</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-phone"></i></span>
						<input type="text" id="inputPhone" name="inputPhone" class="form-control" value="<?php echo $_POST["inputPhone"]?>" required />
					</div>
				</div>
			
			</div>
            <div class="col-md-4 col-md-offset-2">
			
			<div class="form-group">
				<label class="control-label" for="inputPassword">Пароль</label>
					<input type="password" class="form-control" maxlength="10" id="inputPassword" name="inputPassword" placeholder="" required />
			</div>

			<div class="form-group">
				<label class="control-label" for="inputPassword2">Підтвердіть Пароль</label>
					<input type="password"  class="form-control" maxlength="10" id="inputPassword2" name="inputPassword2" placeholder="" required />
			</div>
			
			<div class="form-group">
					<img id="img-captcha" src="/modules/captcha/captcha.php">
		            <div id="reload-captcha" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i></div>
			</div>
			<div class="form-group">				
				<input class="form-control" placeholder="Введіть цифри, зображені на малюнку" id="inputCaptcha" name="inputCaptcha" value="" required />
			</div>
			
			
			<div class="form-group">
				<button type="submit" name="reg" class="btn btn-primary"> Зареєструватись</button>
			</div>
			
			</div>
		</div>
		</form>

		
		
<?php
include ($root_path."/footer.php")?>