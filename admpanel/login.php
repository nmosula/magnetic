<div class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<a class="" href="index.html"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> <?=$company_name?></span></a></div>

	<div class="navbar-collapse collapse" style="height: 1px;">
	</div>
</div>

<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse"><i class="fa fa-key fa-lg"></i> Вхід для адміністратора</p>
        <div class="panel-body">
		
		<?
		if ((isset($_POST['aut'])=="yes") && (!$_SESSION['valid_admin']))
		{
		?>
		<div class="alert alert-error alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Помилка!</strong> Невірно введені дані
		</div>
		<?
		}
		?>
		
            <form name="form1" method="post" id="frm_sign-in" action="./">
			<input type="hidden" name="aut" value="yes">			
				<div class="form-group">
					<label class="control-label" for="login">Логін</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
						<input type="text" class="form-control" name="login" id="login" placeholder="Логін">
					</div>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="pass">Пароль</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						<input type="password" class="form-control span12 form-control" name="pass" placeholder="Пароль">
					</div>
                </div>

				<span class="pull-left"><a href="../"><i class="fa fa-reply"></i> Повернутись на сайт</a></span>
				<button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Вхід</button>
                <div class="clearfix"></div>
            </form>
			
			
        </div>
    </div>
</div>

	<script type="text/javascript">
		$(document).ready(function(){	
		
	
			var frm_login	= $("#login");
			
			//On blur
			frm_login.blur(validate_Login);
			
			//On key press
			frm_login.keyup(validate_Login);
			
			$("#frm_sign-in").submit(function(){
				if(validate_Login())
					return true
				else
					return false;
			});
			
			function validate_Login(){
				if (frm_login.val() == "") {
					frm_login.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_login.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
		});
	</script>
