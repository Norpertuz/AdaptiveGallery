<?php

session_start();
	
	$direktoria = "images/".$_SESSION['direktoria']."/".$_SESSION['direktoria']; //iimages + nazwa folderu x2 (miejsca skladowania originalow)

 //listowanie tylko plikow graficznych o okreslonych formatach
    $images = array_diff(scandir("./"."toResize"."/"), array('.', '..'));
    $images =  preg_grep('~\.(jpeg|jpg|png|JPG|PNG)$~', $images); // sprawdzenie czy pliki są zdjęciami z dozwolonych typów
    $count = 0;
 //  skalowanie 
 echo "Wczytywanie obrazów";
 foreach($images as $name){ 
    resize_image($name,150,150,FALSE,$direktoria);  
	unlink("./"."toResize"."/".$name);	
    $count++;
	}	
	echo "<script type='text/javascript'>window.open('index.php');</script>";
	echo "<script type='text/javascript'>window.close();</script>";


	


// nie trzeba wysoki jako argumentu 
function resize_image($file, $w, $h, $crop=FALSE, $direktoria) {
    $file_directory = "./".$direktoria."/".$file; // sciezka z oryginalnymi obrazami
    list($width, $height) = getimagesize($file_directory);
    $propocionale = $width / $height;
        if ($w/$h > $propocionale) {
            $newwidth = $h*$propocionale;
            $newheight = $h;
        } else {
            $newheight = $w/$propocionale;
            $newwidth = $w;
        }
		
	if (strpos($file_directory, 'png') !== false || strpos($file_directory, 'PNG') !== false) {
     $src = imagecreatefrompng($file_directory);
    }else{
	 $src = imagecreatefromjpeg($file_directory);
	}
   
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($dst, "./images/".$_SESSION['direktoria']."/".$file, 100); // zapis do sciezki z 'thumbnailsami'
	
//	imagejpeg($dst, "./thumbnails/".$file, 50); //75% jakosci


   
}

?>