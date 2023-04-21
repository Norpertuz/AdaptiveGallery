
<?php

$img_name = $_GET['img_name'];
echo $img_name."<br>";   
$img_name_thumb = implode('/',array_unique(explode('/', $img_name)));
echo $img_name_thumb."<br>";  

//usuwanie miniatury oraz obrazka 
// wyswietlanie informacji o powodzeniu lub nieudanej operacji usuniecia - dla testow
if (!unlink($img_name)) { 
    echo "Błąd usuwania pliku <br>"; 
} 
else { 
    echo "Plik ".$img_name." został usuniety <br>"; 
	echo "Plik ".$img_name_thumb." został usuniety <br>"; 
} 

if (!unlink($img_name_thumb)) { 
    echo "Błąd usuwania pliku miniatury <br>"; 
} 
else { 
	echo "Plik ".$img_name_thumb." został usuniety <br>"; 
} 
  
  
echo "<script type='text/javascript'>window.close();</script>"; 
?> 