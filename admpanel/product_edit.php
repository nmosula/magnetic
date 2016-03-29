<?
$page	= isset($_GET['page'])?$_GET['page']:$_POST['page'];

if (isset($_POST["frm-save"]))
{
$namenew= addslashes(ucfirst($_POST["namenew"]));
$short	= addslashes(strip_tags($_POST["short"]));
$full	= addslashes(strip_tags($_POST["full"]));
$cina	= $_POST["cina"];
$kilk	= $_POST["kilk"];
$edit	= $_POST["edit"];

//include ("./image_resize_gif.php");

$imgpath = "../data/product/";

$query = "update ".$table." set name='$namenew', short='$short', full='$full', cina='$cina', kilk='$kilk' where id='$edit'";
$res   = $db->query ($query);

if ($res)
	{
		?>
		<script language="JavaScript">
		window.location.replace ("./?go=<?echo $page_name?>&page=<?=$page?>&edit_record=1");
		</script>
		<?
	}
	else
	{
	?>
		<div class="alert alert-error alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Помилка!</strong> Не вдалося змінити дані<br>
			<i><?echo $query;?></i>
		</div>
	<?
	}
}


if (!isset($_POST["frm-save"]))
{
$edit	= isset($_GET['edit'])?$_GET['edit']:$_POST['edit'];

$res_last_order	= $db->query("select id_order from ".$table." order by id_order desc limit 1");
$row_last_order	= $db->fetch_array($res_last_order);
$last_order		= $row_last_order["id_order"];

$res	= $db->query("select * from ".$table." where id='".$edit."'");
$row	= $db->fetch_array($res);
		$id		= $row["id"];
		$id_order= $row["id_order"];
		$name	= $row["name"];
		$image	= $row["image"];
		$image_small	= "sm_".$image;
		$cina	= $row["cina"];
		$kilk	= $row["kilk"];
		$short	= $row["short"];
		$full	= $row["full"];
		$date	= $row["data"];
		
		$namenew= stripslashes($name);
		$short	= stripslashes($short);
		$short	= trim($short);
		$full	= stripslashes($full);
		$step	= 1;
?>
<script type="text/javascript">
$(document).ready(function() { 

	var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
	
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			uploadProgress: OnProgress,
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// return false to prevent standard browser submit and page navigation 
			return false; 
		});
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
	//Progress bar
	$("#progress-bar").css("width", percentComplete + '%');
	$("#progress-bar").attr("aria-valuenow", percentComplete + '%');
	$("#progress-bar").html(percentComplete + '%');
}

//after succesful upload
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); 
}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 20 MB (20971520)
		if(fsize>20971520) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
		
		//Progress bar
		$("#progress-bar").css("width", '0%');
		$("#progress-bar").attr("aria-valuenow", '0%');
		$("#progress-bar").html('0%');

				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show();
		$("#output").html("");
		$('body,html').animate({scrollTop:0},800);
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>

<form action="<?=$page_name?>_edit_ajax.php" class="form-horizontal" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">

<input type='hidden' name='edit' value='<?=$id?>'>
<input type="hidden" name="go" value="<?=$page_name?>">
<input type="hidden" name="page" value="<?=$page?>">

  <div class="form-group">
    <label for="image_file" class="col-sm-2 control-label">Рисунок:</label>
    <div class="col-sm-4">
	  <input name="image_file" id="imageInput" class="btn btn-default" type="file" />
    </div>
	
    <div class="col-sm-6">	
		<img src="images/loading-icons/loading9.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" id="submit-btn" name="frm-add" value="Зберегти новий малюнок">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<div class="progress">
		  <div class="progress-bar progress-bar-success progress-bar-striped" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
		  </div>
		</div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-left">
		<div id="output">
<?
if ($image!='NO')
{
?>
		<img class='img-rounded' src="../data/product/small/<? echo $image_small?>"  border="0" alt="<? echo $namenew?>">
<?
}
?>
		</div>
    </div>
  </div>
   
</form>

<form class="form-horizontal" action="./" role="form" method="post" id="frm_product" name="addnews">
<input type='hidden' name='edit' value='<?=$id?>'>
<input type="hidden" name="go" value="<?=$page_name?>">
<input type="hidden" name="page" value="<?=$page?>">

  <div class="form-group">
    <label for="namenew" class="col-sm-2 control-label">Назва:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="namenew" name="namenew" placeholder="Назва" value='<?echo $namenew?>'>
    </div>
  </div>
  
  <div class="form-group">
    <label for="id_order" class="col-sm-2 control-label">Короткий опис:</label>
    <div class="col-sm-6">
            <textarea name="short" cols="60" rows="6" class="form-control" onKeyDown="textCounter(this.form.short, this.form.remLen, 998);" onKeyUp="textCounter(this.form.short, this.form.remLen, 998);"><? echo $short?></textarea>
    </div>
	<div class="col-sm-2">
			<input class="form-control" readonly type="text" name="remLen" size="3" maxlength="3" value="1000">
            <font size="-2"><b> залишилось символів</b></font>
	</div>
  </div>
  
  <div class="form-group">
    <label for="id_order" class="col-sm-2 control-label">Детальний опис:</label>
    <div class="col-sm-10">
		<textarea name="full" id="full" style="width:100%; height: 300px;"><?=$full?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="cina" class="col-sm-2 control-label">Кількість:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" onfocus="this.select();" id="kilk" name="kilk" value='<?echo $kilk?>'  onblur="okrugl_zminna(this);">
    </div>
  </div>
  
  <div class="form-group">
    <label for="cina" class="col-sm-2 control-label">Ціна, грн:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" onfocus="this.select();" id="cina" name="cina" placeholder="Ціна" value='<?echo $cina?>'  onblur="valid_zminna(this);">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" name="frm-save" value="Зберегти...">
    </div>
  </div>
</form>

	<script type="text/javascript">
		$(document).ready(function(){	
		
	
			var frm_Name	= $("#namenew");
			
			//On blur
			frm_Name.blur(validateName);
			
			//On key press
			frm_Name.keyup(validateName);
			
			$("#frm_product").submit(function(){
				if(validateName())
					return true
				else
					return false;
			});
			
			function validateName(){
				if (frm_Name.val() == "") {
					frm_Name.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Name.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
		});
	</script>

<?
}
?>
