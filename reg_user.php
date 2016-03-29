<?php
if ($_POST['aut']=="yes")
{
$email=$_POST['email'];
$pass=$_POST['pass'];
		$query="select id, name from ".$table_users." where email='".$email."' and pass=md5('".$pass."')";
		$res=$db->query($query);
		$num=$db->num_rows($res);
		if ($num>0)
			{
				$row=$db->fetch_array($res);
				$_SESSION['valid_name']=stripslashes($row["name"]);
				$_SESSION['valid_user']=$row["id"];
				
				$valid_name=$_SESSION["valid_name"];
				$valid_user=$_SESSION["valid_user"];
			}//if num
}

if ($_GET['des']=="yes")
{
unset($_SESSION["valid_name"]);
unset($_SESSION["valid_user"]);
}
?>
