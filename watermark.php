<?php
$img_name = $_GET['img_name'];


if (strpos($img_name, 'png') !== false || strpos($img_name, 'PNG') !== false) {
     $dest = imagecreatefrompng($img_name);
}else{
	 $dest = imagecreatefromjpeg($img_name);    
}

$water_src = imagecreatefrompng('./gfx/watermark.png');      // znak wodny
imagecolortransparent($water_src, imagecolorat($water_src, 0, 0)); //zachowanie przezroczystosci

//wymiary oryginalnego obrazu
list($width, $height) = getimagesize($img_name);

//wymiary watermarka
list($width_water, $height_water) = getimagesize('./gfx/watermark.png');
$new_width = $width;
$new_height = ($height_water/$width_water)*$new_width;


$watermark_resampled = imagecreatetruecolor($new_width, $new_height);
imagecolortransparent($watermark_resampled, imagecolorat($watermark_resampled, 0, 0));
imagecopyresampled($watermark_resampled, $water_src, 0, 0, 0, 0, $new_width, $new_height, $width_water, $height_water);


imagecopymerge($dest, $watermark_resampled, 0, 0, 0, 0, $new_width, $new_height, 30);

header('Content-Type: image/png');
imagejpeg($dest);

imagedestroy($dest);
imagedestroy($water_src);




?>