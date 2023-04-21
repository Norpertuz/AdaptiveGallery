<!doctype html>
<html lang = "pl-PL">
<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href="styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Norbert Kamionka">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Adaptive Image Gallery</title>
</head>
<body style="overflow:auto;">

<?php
//session_start();
$img_name = $_GET['img_name'];
if (strpos($img_name, 'png') !== false || strpos($img_name, 'PNG') !== false) {
	echo "Exif jest niewspierany przez format png.";
}else{
echo "Wyświetlam metadane dla: ";
echo $img_name."<br>";

$headers = exif_read_data($img_name);

if($headers == false){
	echo "Brak nagłówków.<br/>\n";
	
}else{
	$exif = exif_read_data($img_name, 0, true);
	//var_dump($exif); 
	foreach ($exif as $key => $section) {
		foreach ($section as $name => $val) {
			if(strpos($name, "UndefinedTag") !== false) {} // sprawdzenie czy nie ma błędnie zdefiniowanch lub rozpoznanych tagów
			else{echo "$key.$name: $val<br />\n";}
		}
	}	
	
}


}
?>


</body>
</html>