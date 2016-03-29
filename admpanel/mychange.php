<div class="header">
           
	<h1 class="page-title">Власні дані</h1>
	<ul class="breadcrumb">
		<li><a href="index.html">Головна</a> </li>
		<li class="active">Власні дані</li>
	</ul>

</div>

<div class="main-content">

<?
if (isset($_POST["frm-save"]))
{
$l_name	= $_POST["l_name"];
$f_name	= $_POST["f_name"];
$email	= $_POST["email"];
$login	= $_POST["login"];
$pass1	= $_POST["pass1"];
$pass2	= $_POST["pass2"];
$error	= "";

	if (empty($_POST["login"]))
		$error.= "<p>Будь ласка, введіть Логін!</p>";
	
	if (empty($_POST["email"]))
		$error.= "<p>Будь ласка, введіть Електронну пошту!</p>";
	
	if (!empty($_POST["email"]) && (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $_POST["email"])) )
		$error.= "<p>Будь ласка, введіть вірно Електронну пошту!</p>";

	if ((!empty($_POST["pass2"])) && (($_POST["pass1"]!=$_POST["pass2"])))
		$error.= "<p>Будь ласка, звірте Паролі!</p>";


if (!empty($error))
{
?>
	<div class="alert alert-error alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<?php echo $error;?>
	</div>
<?php
}
else
{
$l_name	= addslashes($_POST["l_name"]);
$f_name	= addslashes($_POST["f_name"]);
$email	= $_POST["email"];
$login	= $_POST["login"];
$pass1	= $_POST["pass1"];
$pass2	= $_POST["pass2"];
	if ($_SESSION['valid_admin']=="nazar2804")
	{
		$res1=$db->query("update ".$prefix_db."_admin set login='$login', f_name='$f_name', l_name='$l_name', email='$email' where login='".$_SESSION['valid_admin']."'");
		if (!empty($pass2))
			$res2=$db->query("update ".$prefix_db."_admin set pass=md5('$pass1') where login='".$_SESSION['valid_admin']."'");
	}
	else
	{
		$res1=$db->query("update ".$prefix_db."_admin set login='$login', f_name='$f_name', l_name='$l_name', email='$email' where login='".$_SESSION['valid_admin']."'");
		if (!empty($pass2))
			$res2=$db->query("update ".$prefix_db."_admin set pass=md5('$pass1') where login='".$_SESSION['valid_admin']."'");
	}
	

	if ($res1)
	{
		$_SESSION['valid_admin'] = $login;
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo "<p class='text-success'>Ваші дані були успішно змінені в базі даних!</p>";?>
		</div>
		<?php
	}
	if ($res2)
	{
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo "<p class='text-success'>Пароль був успішно змінений в базі даних!</p>";?>
		</div>
		<?php

	}
}

}

if (!isset($_POST["frm-save"]))
{
$res	= $db->query ("select * from ".$prefix_db."_admin where login='".$_SESSION['valid_admin']."'");
$row	= $db->fetch_array($res);
$login	= $row["login"];
$pass	= $row["pass"];
//$pass2=$pass1;
$l_name	= $row["l_name"];
$f_name	= $row["f_name"];
$email	= $row["email"];
}
?>

<form class="form-horizontal" action="./" role="form" method="post">
<input type="hidden" name="go" value="mychange">

  <div class="form-group">
    <label for="l_name" class="col-sm-2 control-label">Прізвище:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Прізвище" value="<?echo $l_name?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="f_name" class="col-sm-2 control-label">Ім’я:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Ім’я" value="<?echo $f_name?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">E-mail:</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?echo $email?>">
    </div>
  </div>
  
  <div class="form-group">
  </div>
  
  <div class="form-group">
    <label for="login" class="col-sm-2 control-label">Логін:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="login" name="login" placeholder="Логін" value="<?echo $login?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="pass1" class="col-sm-2 control-label">Пароль:</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Пароль" value="<?echo $pass1?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="pass2" class="col-sm-2 control-label">Підтвердження паролю:</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Підтвердіть пароль" value="<?echo $pass2?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" name="frm-save" value="Зберегти...">
    </div>
  </div>
</form>

</div>