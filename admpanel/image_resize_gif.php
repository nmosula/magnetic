<?
function createIMG($do, $small_mx, $small_my, $big_mx, $big_my, $insert_watermark=FALSE )
{
GLOBAL $userfile_name, $userfile, $filetype, $imgpath;

if($do == 'small')
{
            $mx = $small_mx;
            $my = $small_my;
 
$smallname="sm_".strtolower($userfile_name);

$size = getimagesize($imgpath.strtolower($userfile_name));
       $x = $size[0];
       $y = $size[1];
	   
	if (($x > $mx) or ($y>$my))
	{
		  if(($x/$mx)>($y/$my))
				$k = $x/$mx;
		  else
				$k  = $y/$my;
	}
	else $k=1;
	
		$px = round($x/$k);
		$py = round($y/$k);

	if ($k>1)
	{

	if (empty($filetype)) $filetype=image_type_to_mime_type($size[2]);
//  $preview = imagecreate($px,$py);

   switch ($filetype)
   {
                      case 'image/x-png':
                          $big = @imagecreatefrompng($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/png':
                          $big = @imagecreatefrompng($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/jpeg':
                          $big = @imagecreatefromjpeg($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/pjpeg':
                          $big = @imagecreatefromjpeg($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/gif':
                          $preview = imagecreate($px,$py);
                          $big = @imagecreatefromgif($imgpath.strtolower($userfile_name));
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
   }
     imagetruecolortopalette($big,1,256);
     imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
//     imagecopyresized($preview, $big, 0,0,0,0,$px,$py,$x,$y);
     imagejpeg($preview, $imgpath."small/".$smallname, 100);
     imagedestroy($big);
     imagedestroy($preview);
	 
	} //if k>1;
	else @copy($userfile, $imgpath."small/".$smallname);

} // end $do = small

if($do == 'check')
{
       $mx = $big_mx;
       $my = $big_my;
       $size = getimagesize($imgpath.strtolower($userfile_name));
		$x = $size[0];
		$y = $size[1];
		
	if (($x > $mx) or ($y>$my))
	{
		  if(($x/$mx)>($y/$my))
				$k = $x/$mx;
		  else
				$k  = $y/$my;
	}
	else $k=1;
				
                $px = round($x/$k);
                $py = round($y/$k);
//                $preview = imagecreate($px,$py);

	if ($k>1)
	{
		if (empty($filetype)) $filetype=image_type_to_mime_type($size[2]);
	
                switch ($filetype)
				{
                      case 'image/x-png':
                          $big = @imagecreatefrompng($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/png':
                          $big = @imagecreatefrompng($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/jpeg':
                          $big = @imagecreatefromjpeg($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/pjpeg':
                          $big = @imagecreatefromjpeg($imgpath.strtolower($userfile_name));
                          $preview = imagecreatetruecolor($px,$py);
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                      case 'image/gif':
                          $preview = imagecreate($px,$py);
                          $big = @imagecreatefromgif($imgpath.strtolower($userfile_name));
                          imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                          break;
                }

                imagetruecolortopalette($big,1,256);
                imagecopyresampled($preview, $big, 0,0,0,0,$px,$py,$x,$y);
                imagejpeg($preview,$imgpath.strtolower($userfile_name), 100);
	} //if k>1
	
				if (($insert_watermark) && ($x>150) && ($y>150))
				{
					$logopath = '../img/watermark.png';
					
					if (file_exists($logopath))
					{
						$logo = @imagecreatefrompng($logopath);
						$size = getimagesize($logopath);
						$logox = $size[0];
						$logoy = $size[1];
						
						$main_center_x		= floor ( $px / 2 );
						$main_center_y		= floor ( $py / 2 );
						$watermark_center_x	= floor ( $logox / 2 );
						$watermark_center_y	= floor ( $logoy / 2 );
						
						
						$watermark_path = $logopath;
						$watermark = new watermark();
						$main_img_obj = imagecreatefromjpeg( $imgpath.strtolower($userfile_name) );
						$watermark_img_obj = imagecreatefrompng( $watermark_path );
						# создаем изображение с водяным знаком - значение прозрачности альфа-канала водяного знака установим в 66%
						$return_img_obj = $watermark->create_watermark( $main_img_obj, $watermark_img_obj, 66 );
						imagejpeg( $return_img_obj, $imgpath.strtolower($userfile_name), 100 );
						
						/*
						imagecopy($preview, $logo, $main_center_x-$watermark_center_x, $main_center_y-$watermark_center_y, 0, 0, $logox, $logoy);
						
						@imagetruecolortopalette($preview,1,256);
						imagejpeg($preview,$imgpath.strtolower($userfile_name), 100);
						*/
					}
				}	
				
                @imagedestroy($big);
                @imagedestroy($preview);
                @imagedestroy($logo);
}
	
} //end_function
?>