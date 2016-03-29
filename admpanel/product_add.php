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
	$('body,html').animate({scrollTop:0},800);
}

//function to check file size before uploading.
function beforeSubmit(){
		
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#namenew').val()) //check empty input filed
		{
			$("#output").html("Не введено назву");
			$('#namenew').closest("div.form-group").addClass("has-error");
			return false
		}
		else {
			$('#namenew').closest("div.form-group").removeClass("has-error");
			return true;
		}
			
	
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

<form action="<?=$page_name?>_add_ajax.php" class="form-horizontal" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input type='hidden' name='add' value='yes'>
<input type="hidden" name="go" value="<?=$page_name?>">

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-left">
		<div id="output"></div>
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
    <label for="namenew" class="col-sm-2 control-label">Назва:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="namenew" name="namenew" placeholder="Назва" value='<?echo $namenew?>'>
    </div>
  </div>
  
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
    <label for="id_order" class="col-sm-2 control-label">Опис:</label>
    <div class="col-sm-6">
            <textarea name="short" cols="60" rows="6" class="form-control" onKeyDown="textCounter(this.form.short, this.form.remLen, 998);" onKeyUp="textCounter(this.form.short, this.form.remLen, 998);"><? echo $short?></textarea>
    </div>
	<div class="col-sm-2">
			<input class="form-control" readonly type="text" name="remLen" size="3" maxlength="3" value="1000">
            <small> залишилось символів</small>
	</div>
  </div>
  
  <div class="form-group">
    <label for="cina" class="col-sm-2 control-label">Кількість:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" onfocus="this.select();" id="kilk" name="kilk" value="0"  onblur="okrugl_zminna(this);">
    </div>
  </div>
  
  <div class="form-group">
    <label for="cina" class="col-sm-2 control-label">Ціна, грн:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" onfocus="this.select();" id="cina" name="cina" placeholder="0.00" value='<?echo $cina?>'  onblur="valid_zminna(this);">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" id="submit-btn" name="frm-add" value="Додати...">
    </div>
  </div>
    
</form>

