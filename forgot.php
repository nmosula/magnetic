<?
include ("./inc_setting.php");
$META_title	= $lang["block_forgot_password"];
include ($root_path."/header.php");
?>
<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">
            
            <div class="billing-address">
                <h2 class="border h1"><?=$lang["block_forgot_password"]?></h2>

<?
$login=isset($_POST["login"])?$_POST["login"]:$_GET["login"];
$get_login=isset($_POST["get_login"])?$_POST["get_login"]:$_GET["get_login"];
$answer=isset($_POST["answer"])?$_POST["answer"]:$_GET["answer"];
$answer=trim($answer);

if ($_POST["get_pass"])
{
$queryu="select * from $table_admin";
$resultu = mysql_query($queryu);
if (mysql_num_rows ($resultu) > 0)
{
$row=mysql_fetch_array($resultu);
$email_admin=$row["email"];
}

	$res_forgot=mysql_query("select * from $table_users where email='$login' and answer='$answer'");
	
	if (mysql_num_rows($res_forgot)>0)
	{
	$row_forgot=mysql_fetch_array($res_forgot);
		
	$r=rand(65, 90);
	$mes=chr($r);
	$r=rand(48, 57);
	$mes.=chr($r);
	$r=rand(97, 122);
	$mes.=chr($r);
	$r=rand(65, 90);
	$mes.=chr($r);
	$r=rand(48, 57);
	$mes.=chr($r);
	$r=rand(65, 90);
	$mes.=chr($r);
	
	
	mysql_query ("update $table_users set pass=md5('$mes') where email='$login' and answer='$answer'");

		$message="Ваш логін і пароль на $SERVER_NAME <br>Логін: ".$login."<br>дійсний пароль: ".$mes."<br>";
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .=	"From: $email_admin\nReply-To: $email_admin\nX-Mailer: PHP/";
		$headers .= phpversion();
		$forgot_subject1="Забули пароль?";
		@mail($row_forgot["email"], $forgot_subject1, $message, $headers);
			?>
			<div class="row field-row">
				<div class="col-xs-12 col-sm-8">
					<h2 class="inner-xs"><?=$lang["block_forgot_password_send_mail"]?></h2>
					<h2 class="inner-xs"><a class="le-button" href="<?=$pre_lang?>/"><?=$lang["headermenu_main"]?></a></h2>
				</div>
			</div><!-- /.field-row -->
			<?php
	}
	else
		{
			?>
			<div class="row field-row">
				<div class="col-xs-12 col-sm-8">
					<h2 class="inner-xs"><?=$lang["block_forgot_wrong_answer"]?>!</h2>
					<h2 class="inner-xs"><a class="le-button" href="<?=$pre_lang?>/forgot/<?=$login?>/"><?=$lang["block_forgot_reload"]?></a></h2>
				</div>
			</div><!-- /.field-row -->
			<?php
			
		}
}
elseif ($login)
{
	$res=mysql_query("select id, email, question, pip from $table_users where email='$login'");
	$num=mysql_num_rows($res);
	if ($num>0)
	{
	$row_table_users=mysql_fetch_array($res);
	?>
		<form action="<?=$pre_lang?>/forgot/" method="post">
		<input type="hidden" name="login" value="<?=$login?>">
		
			<div class="row field-row">
				<div class="col-xs-12 col-sm-8"><?
					 $pryvitannya=$lang["block_login_vitannya"];
					 echo $pryvitannya." <b>".stripslashes($row_table_users["pip"])."</b>!";
				?>
				</div>
			</div><!-- /.field-row -->

			<div class="row field-row">
				<div class="col-xs-12 col-sm-8">
					<label><?=$lang["insert_order_question"]?>:</label>
					<?php echo $row_table_users["question"];?>
				</div>
			</div><!-- /.field-row -->
			
			<div class="row field-row">
				<div class="col-xs-12 col-sm-8">
					<label><?=$lang["insert_order_answer"]?>:</label>
					<textarea class="le-input" rows="3" name="answer"></textarea>
				</div>
			</div><!-- /.field-row -->
			
			<div class="row field-row">
				<div class="col-xs-12 col-sm-4">
					<div class="buttons-holder">
						<input type="submit" class="le-button huge" name="get_pass" value="<?=$lang["block_forgot_get_password"]?>">
					</div>
				</div>
			</div><!-- /.field-row -->
		
		</form>
	<?
	}
	else
	{
		echo "<p align='center'>".$lang["block_forgot_error_user"]."<b><font color='#000000'>".$login."</font></b>!</p>";
		echo "<p align='center'><a class=\"le-button\"  href='$pre_lang/forgot/'>".$lang["block_forgot_reload"]."</a></div>";
	}
}
else
{
?>
				<form action="<?=$pre_lang?>/forgot/" method="post">
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
							<label><?=$lang["block_forgot_input_email"]?></label>
							<input class="le-input" name="login" value='<?=$login?>'>
                        </div>
                    </div><!-- /.field-row -->
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
							<div class="buttons-holder">
								<input type="submit" name="get_login" class="le-button huge" value="<?=$lang["block_forgot_next"]?>...">
							</div><!-- /.buttons-holder -->
                        </div>
                    </div><!-- /.field-row -->
				</form>

<?
}
?>
            </div><!-- /.billing-address -->
		</div>
	</div>
</section>
<?
include ($root_path."/footer.php");
?>
