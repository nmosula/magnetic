<?php
session_start();
include ("../inc/mysql.class.php");
include ("../inc/db.php");
include ("../inc/config.php");

############ Configuration ######################################################################
$thumb_width			= $im_foto_s_w; 	//Thumbnails will be cropped to 200x200 pixels
$thumb_height			= $im_foto_s_w;		//Thumbnails will be cropped to 200x200 pixels
$thumb_if_square		= true;			//if Thumbnails will be crop at square
$max_image_size 		= $im_foto_f_w;		//Maximum image size (height and width)
$thumb_prefix			= "sm_";			//Normal thumb Prefix
$destination_folder		= '../data/product/'; 		//upload directory ends with / (slash)
$jpeg_quality 			= 90;				//jpeg quality

$insert_watermark		= FALSE;
$watermark_path 		= '../img/watermark.png';
##################################################################################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	$namenew= addslashes(ucfirst($_POST["namenew"]));
	$short	= addslashes(strip_tags($_POST["short"]));
	$full	= addslashes($_POST["full"]);
	$cina	= $_POST["cina"];
	$kilk	= $_POST["kilk"];

	// check $_FILES['ImageFile'] not empty
	if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
			die('Image file is Missing!'); // output error when above checks fail.
	}
	
	//uploaded file info we need to proceed
	$image_name = $_FILES['image_file']['name']; //file name
	$image_size = $_FILES['image_file']['size']; //file size
	$image_temp = $_FILES['image_file']['tmp_name']; //file temp

	$image_size_info 	= getimagesize($image_temp); //get image size
	
	if($image_size_info){
		$image_width 		= $image_size_info[0]; //image width
		$image_height 		= $image_size_info[1]; //image height
		$image_type 		= $image_size_info['mime']; //image type
	}else{
		die("Make sure image file is valid!");
	}

	//switch statement below checks allowed image type 
	//as well as creates new image from given file 
	switch($image_type){
		case 'image/png':
			$image_res =  imagecreatefrompng($image_temp); break;
		case 'image/gif':
			$image_res =  imagecreatefromgif($image_temp); break;			
		case 'image/jpeg': case 'image/pjpeg':
			$image_res = imagecreatefromjpeg($image_temp); break;
		default:
			$image_res = false;
	}

	if($image_res){
		//Get file extension and name to construct new file name 
		$image_info = pathinfo($image_name);
		$image_extension = strtolower($image_info["extension"]); //image extension
		$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
				
		$id_photo=time();
		$new_file_name = 'p_' .  $id_photo . '.' . $image_extension;
		
		//folder path to save resized images and thumbnails
		$thumb_save_folder 	= $destination_folder . "small/". $thumb_prefix . $new_file_name; 
		$image_save_folder 	= $destination_folder . $new_file_name;
		
		//call normal_resize_image() function to proportionally resize image
		if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
		{
			//call crop_image_thumbnails() function to create square thumbnails
			if(!crop_image_thumbnails($image_res, $thumb_save_folder, $image_type, $thumb_width, $thumb_height, $image_width, $image_height, $thumb_if_square, $jpeg_quality))
			{
				die('Error Creating thumbnail');
			}
			
			if (($insert_watermark) && ($image_width > 150) && ($image_height > 150))
			{			
				if (file_exists($watermark_path))
				{
					$watermark_size		= getimagesize($watermark_path);
					$watermark_width	= $watermark_size[0];
					$watermark_height	= $watermark_size[1];
					$watermark_type 	= $watermark_size['mime']; //image type
					
					$main_center_x		= floor ( $image_width / 2 );
					$main_center_y		= floor ( $image_height / 2 );
					$watermark_center_x	= floor ( $watermark_width / 2 );
					$watermark_center_y	= floor ( $watermark_height / 2 );
					
					
					
					switch($watermark_type){
						case 'image/png':
							$watermark_res =  imagecreatefrompng($watermark_path); break;
						case 'image/gif':
							$watermark_res =  imagecreatefromgif($watermark_path); break;			
						case 'image/jpeg': case 'image/pjpeg':
							$watermark_res = imagecreatefromjpeg($watermark_path); break;
						default:
							$watermark_res = false;
					}
					
					if($watermark_res){
						# создаем изображение с водяным знаком - значение прозрачности альфа-канала водяного знака установим в 66%
						if(imagecopyresampled($image_res, $watermark_res, $main_center_x - $watermark_center_x	, $main_center_y - $watermark_center_y, 0, 0, $watermark_width, $watermark_height,  $watermark_width, $watermark_height)){
							save_image($image_res, $image_save_folder, $image_type, $jpeg_quality); //save resized image
						}
					}
				}
			}
			
			$query ="insert into ".$table_product." (name, short, full, cina, kilk, image, data) values ('$namenew', '$short', '$full', '$cina', '$kilk', '$new_file_name', '$id_photo')";
			$res=$db->query ($query);

			$last_id=mysql_insert_id();
			$db->query ("update ".$table_product." set id_order='$last_id' where id='$last_id'");
			
			/* We have succesfully resized and created thumbnail image
			We can now output image to user's browser or store information in the database*/
			echo "
			<div class=\"alert alert-success alert-dismissible fade in\" role=\"alert\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
			<p class='text-success'>Запис успішно доданий в базу даних!</p>
			</div>";
		
			echo '<img class="img-rounded" src="'. $thumb_save_folder. '" alt="Thumbnail">';
		}
		
		imagedestroy($image_res); //freeup memory
	}
}

#####  This function will proportionally resize image ##### 
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
	
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	//do not resize if image is smaller than max size
	if($image_width <= $max_size && $image_height <= $max_size){
		if(save_image($source, $destination, $image_type, $quality)){
			return true;
		}
	}
	
	//Construct a proportional size of new image
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);
	
	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
		save_image($new_canvas, $destination, $image_type, $quality); //save resized image
	}

	return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_thumbnails($source, $destination, $image_type, $thumb_width, $thumb_height, $image_width, $image_height, $thumb_if_square="false", $quality){
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

	if ($thumb_if_square)
	{
		if( $image_width > $image_height )
		{
			$y_offset = 0;
			$x_offset = ($image_width - $image_height) / 2;
			$s_size 	= $image_width - ($x_offset * 2);
		}else{
			$x_offset = 0;
			$y_offset = ($image_height - $image_width) / 2;
			$s_size = $image_height - ($y_offset * 2);
		}
		$new_canvas	= imagecreatetruecolor($thumb_width, $thumb_height); //Create a new true color image
		
		//Copy and resize part of an image with resampling
		if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $thumb_width, $thumb_height, $s_size, $s_size)){
			save_image($new_canvas, $destination, $image_type, $quality);
		}
	}
	else
	{
		if (($image_width > $thumb_width) or ($image_height > $thumb_height))
		{
			  if(($image_width / $thumb_width) > ($image_height / $thumb_height))
					$k = $image_width / $thumb_width;
			  else
					$k = $image_height / $thumb_height;
		}
		else $k=1;
		
		$new_thumb_width	= round($image_width / $k);
		$new_thumb_height	= round($image_height/ $k);
		
		$new_canvas	= imagecreatetruecolor($new_thumb_width, $new_thumb_height); //Create a new true color image
		
		//Copy and resize part of an image with resampling
		if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $new_thumb_width, $new_thumb_height, $image_width, $image_height)){
			save_image($new_canvas, $destination, $image_type, $quality);
		}
	}

	return true;
}

##### Saves image resource to file ##### 
function save_image($source, $destination, $image_type, $quality){
	switch(strtolower($image_type)){//determine mime type
		case 'image/png': 
			imagepng($source, $destination); return true; //save png file
			break;
		case 'image/gif': 
			imagegif($source, $destination); return true; //save gif file
			break;          
		case 'image/jpeg': case 'image/pjpeg': 
			imagejpeg($source, $destination, $quality); return true; //save jpeg file
			break;
		default: return false;
	}
}