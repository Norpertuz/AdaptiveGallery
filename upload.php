<?php
session_start();
if(isset($_POST['submit'])){
	
	$direktoria = $_SESSION['direktoria'];
	
  echo "Uploaded files:</br>"; 
  

 $countfiles = count($_FILES['file']['name']);


 for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES['file']['name'][$i];

 echo $filename;
  echo "</br>";
  // Upload file
  if(move_uploaded_file($_FILES['file']['tmp_name'][$i],"images/".$direktoria.'/'.$direktoria.'/'.$filename)){
	   copy("images/".$direktoria.'/'.$direktoria.'/'.$filename,'toResize/'.$filename);
  }
 
 
 }
	echo "<script type='text/javascript'>window.open('resize.php');</script>";
   
} 
?>


