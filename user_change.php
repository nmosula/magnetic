<?
include ("./inc_setting.php");
$META_title		= $lang["block_userchange"];
include ($root_path."/header.php");
?>
<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">
            
            <div class="billing-address">
                <h2 class="border h1"><?=$lang["block_userchange"]?></h2>

<?
$all_data='true';
$reg=$_POST["reg"];
if ($reg)
{
  $email=$_POST["email"];
  $old_email=$_POST["old_email"];
  $post=$_POST["post"];
  $question=stripslashes($_POST["secret_question"]);
  $answer=stripslashes($_POST["answer"]);
  $oblast=stripslashes($_POST["oblast"]);
  $rayon=stripslashes($_POST["rayon"]);
  $city=stripslashes($_POST["city"]);
  $address=stripslashes($_POST["address"]);
  $pip=stripslashes($_POST["pip"]);
  $phone=$_POST["phone"];
  $phone_mobile=$_POST["phone_mobile"];
  $pass1=$_POST["pass1"];
  $pass2=$_POST["pass2"];

  $doc_ipn=$_POST["doc_ipn"];
  $doc_svid=$_POST["doc_svid"];
  $doc_address=stripslashes($_POST["doc_address"]);
  
	$warning="";
	if (empty($pip))		{$warning.="<div>".$lang["error_input"].$lang["insert_order_pip"]."!<br></div>"; $all_data='false';}
	if (empty($email))		{$warning.="<div>".$lang["error_input_email"]."<br></div>"; $all_data='false';}
	if ((!empty($email)) && (!eregi("^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$",$email))) {$warning.="<div>".$lang["error_input_email_wrong"]."!<br></div>"; $all_data='false';}
	if (!empty($email))
	{
		$num=mysql_num_rows(mysql_query("select id from $table_users where email='$email' and email!='$old_email'"));
		if ($num>0)			{$warning.="<div>".$lang["error_input_email_exists"]."<br></div>"; $all_data2='false';}		
	}
	if (!empty($pass1))
	{
		$old_pass_res=mysql_fetch_array(mysql_query("select pass from $table_users where id='$valid_user'"));
		$old_pass=$old_pass_res["pass"];
		if (md5($pass1)!=$old_pass)
		{
			if ((!empty($pass1)) && (strlen($pass1)<5)) {$warning.="<div>".$lang["insert_order_password5"]."!<br></div>"; $all_data2='false';}
			if ((!empty($pass1)) && ($pass1!=$pass2)) {$warning.="<div>".$lang["error_input"].$lang["error_input_check_email"]."!<br></div>"; $all_data='false';}
		}
	}
	if (empty($question))	{$warning.="<div>".$lang["error_input"].$lang["insert_order_question"]."!<br></div>"; $all_data='false';}
	if (empty($answer))		{$warning.="<div>".$lang["error_input"].$lang["insert_order_answer"]."!<br></div>"; $all_data='false';}	
	
	if (empty($oblast))		{$warning.="<div>".$lang["error_input"].$lang["insert_order_oblast"]."!<br></div>"; $all_data='false';}
/*
	if (empty($post))		{$warning.="<div>Будь-ласка введіть Почтовий індекс!<br></div>"; $all_data='false';}
	if (empty($rayon))		{$warning.="<div>Будь-ласка введіть Район!<br></div>"; $all_data='false';}
*/
	if (empty($city))		{$warning.="<div>".$lang["error_input"].$lang["insert_order_city"]."!<br></div>"; $all_data='false';}
//	if (empty($address))	{$warning.="<div>".$lang["error_input"].$lang["insert_order_address"]."!<br></div>"; $all_data='false';}
	if ( (empty($phone_mobile))	&& (empty($phone)) ) {$warning.="<div>".$lang["error_input_phone"]."<br></div>"; $all_data='false';}
	
}
else
{
$row=mysql_fetch_array(mysql_query("select * from $table_users where id='$valid_user'"));
//echo "select * from $table_users where id='$valid_user'";
$email=$row["email"];
$old_email=$email;
$question=stripslashes($row["question"]);
$answer=stripslashes($row["answer"]);
$post=stripslashes($row["post"]);
$oblast=stripslashes($row["oblast"]);
$rayon=stripslashes($row["rayon"]);
$city=stripslashes($row["city"]);
$address=stripslashes($row["address"]);
$pip=stripslashes($row["pip"]);
$phone=stripslashes($row["phone"]);
$phone_mobile=stripslashes($row["phone_mobile"]);

$doc_ipn=stripslashes($row["doc_ipn"]);
$doc_svid=stripslashes($row["doc_svid"]);
$doc_address=stripslashes($row["doc_address"]);
//$pass_1=$pass;
//$pass_2=$pass;
}

if (($reg) && ($all_data!='false'))
{
  $question=addslashes($_POST["secret_question"]);
  $answer=addslashes($_POST["answer"]);
  $post=addslashes($_POST["post"]);
  $oblast=addslashes($_POST["oblast"]);
  $rayon=addslashes($_POST["rayon"]);
  $city=addslashes($_POST["city"]);
  $address=addslashes($_POST["address"]);
  $pip=addslashes($_POST["pip"]);
  $phone=addslashes($_POST["phone"]);
  $phone_mobile=addslashes($_POST["phone_mobile"]);
  $pass_1=$_POST["pass1"];
  $email=$_POST["email"];

  $doc_ipn=addslashes($_POST["doc_ipn"]);
  $doc_svid=addslashes($_POST["doc_svid"]);
  $doc_address=addslashes($_POST["doc_address"]);

if (!empty($pass_1)) 
{
mysql_query ("update $table_users set pass=md5('$pass_1') where id='$valid_user'");
}

  
$res=mysql_query ("update $table_users set email='$email', question='$question',  answer='$answer',
  post='$post',
  oblast='$oblast',
  rayon='$rayon',
  city='$city',
  address='$address',
  pip='$pip',
  phone='$phone',
  phone_mobile='$phone_mobile',
  doc_ipn='$doc_ipn',
  doc_svid='$doc_svid',
  doc_address='$doc_address'
 where id='$valid_user'");
  
if ($res) echo "<h2 class=\"blog-pagination inner-xs\">".$lang["block_userchange_success"]."</h2>";
}
else
{

		if ($all_data=='false')
		{
		echo "<div class=\"col-xs-12 inner-xs red-text\">$warning</div>";
		}
		?>



			<form name="form1" method="post" action="<?=$pre_lang?>/user_change/">
				<input type="hidden" name="old_email" value="<?=$old_email?>">
	  
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
                            <label><?=$lang["insert_order_pip"]?>*</label>
                            <input class="le-input" name="pip" value='<?=$pip?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_pip_descript"]?>
                        </div>
                    </div><!-- /.field-row -->

					<hr></hr>

                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
                            <label>E-mail*</label>
                            <input class="le-input" name="email" value='<?=$email?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_email_descript"]?>
                        </div>
                    </div><!-- /.field-row -->
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label>Пароль*</label>
                            <input class="le-input" type="password" name="pass1" value='<?=$pass1?>' placeholder="<?=$lang["insert_order_password5"]?>">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_password2"]?>*</label>
                            <input class="le-input" type="password" name="pass2" value='<?=$pass2?>' placeholder="<?=$lang["insert_order_password2"]?>">
                        </div>
                    </div><!-- /.field-row -->
					
					<hr></hr>
				
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_question"]?>*</label>
                            <input class="le-input" name="secret_question" value='<?=$question?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_answer"]?>*</label>
                            <input class="le-input" name="answer" value='<?=$answer?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_question_descript"]?>
                        </div>
                    </div><!-- /.field-row -->
					
					<hr></hr>
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-2">
                            <label><?=$lang["insert_order_post"]?></label>
                            <input class="le-input" name="post" value='<?=$post?>'>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <label><?=$lang["insert_order_oblast"]?>*</label>
                            <input class="le-input" name="oblast" value='<?=$oblast?>'>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <label><?=$lang["insert_order_rayon"]?></label>
                            <input class="le-input" name="rayon" value='<?=$rayon?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_post_descript"]?>
                        </div>
                    </div><!-- /.field-row -->
					
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
                            <label><?=$lang["insert_order_city"]?>*</label>
                            <input class="le-input" name="city" value='<?=$city?>'>
                        </div>
                    </div><!-- /.field-row -->
					
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
                            <label><?=$lang["insert_order_address"]?></label>
                            <textarea name="address" class="le-input" ><?=$address?></textarea>
                        </div>
                    </div><!-- /.field-row -->
					
					<hr></hr>
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_phone"]?></label>
                            <input class="le-input" placeholder="<?=$lang["insert_order_phone_descript2"]?>" name="phone" value='<?=$phone?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_phone_mobile"]?>*</label>
                            <input class="le-input" placeholder="<?=$lang["insert_order_phone_mobile_descript"]?>" name="phone_mobile" value='<?=$phone_mobile?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_phone_descript"]?>
                        </div>
					</div><!-- /.field-row -->
					
					<hr></hr>
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_PDV_IPN"]?></label>
                            <input class="le-input" name="doc_ipn" value='<?=$doc_ipn?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <label><?=$lang["insert_order_PDV_svid"]?></label>
                            <input class="le-input" name="doc_svid" value='<?=$doc_svid?>'>
                        </div>
                        <div class="col-xs-12 col-sm-4 td_memo">
							<?=$lang["insert_order_PDV_IPN_descript"]?>
                        </div>
					</div><!-- /.field-row -->
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-8">
                            <label><?=$lang["insert_order_address_yur"]?></label>
                            <textarea name="doc_address" class="le-input" ><?=$doc_address?></textarea>
                        </div>
                    </div><!-- /.field-row -->
					
					<hr></hr>
					
					
                    <div class="row field-row">
                        <div class="col-xs-12 col-sm-4">
							<div class="buttons-holder">
								<input type="submit" name="reg" class="le-button huge" value="<?=$lang["block_login_userchange"]?>">
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



