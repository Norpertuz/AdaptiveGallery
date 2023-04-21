<?php
	session_start();
?>
<!doctype html>
<html lang = "pl-PL">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <script src="jquery.js"></script> <!-- biblioteka jquery -->
  <script src="panel.js"></script> <!-- panel boczny prawy wysuwanie -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Adaptacyjna galeria zdjęć - aplikacja webowa " />
  <meta name="keywords" content="Galeria, zdjecia, galeria zdjec, adaptacyjny model, adaptacyjna galeria zdjec" />
  <meta name="author" content="Norbert Kamionka">
  <meta name="robots" content="index, nofollow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Adaptive Image Gallery</title>
</head>


<body>

		<?php
			if (empty($_SESSION['user'])): 
		?>
    


    <!-- menu logowania/rejestracji-->
  <div class="containerFormLogin">
      <form  action="check.php" method="post">
             <input type="text" class="formField" name="login" id="login" placeholder="Login"><br>

             <input type="text" class="formField" name="name" id="name" placeholder="Imię"><br>

             <input type="password" class="formField" name="pass" id="pass" placeholder="Hasło"><br>

             <button class="przyciskem"  type ="submit" style="width: 59%;  margin-left: 21%;">Rejestracja</button>
       </form>
         
           <form  action="auth.php" method="post">
             <input type="text" class="formField" name="login" id="login" placeholder="Login"><br>
             <input type="password" class="formField" name="pass" id="pass" placeholder="Hasło"><br>
             <button class="przyciskem"  type ="submit" style="width: 59%; margin-left: 21%;" >Logowanie</button>
           </form>
         
		</div>
         <?php endif; ?>
      

  
  <div id="panel"> <!-- panel boczny prawy -->

  <div id="logowaniacz"> 
    <div id="zalogowany_user" style ="padding-top:20px;margin-left:15%;">
	  
		<?php
			if (!empty($_SESSION['user'])){
		    echo "<div id='logowaniacz_part' style='width:130px; float:left;'>Zalogowano jako:<br>".$_SESSION['user'], "    ";
			if($_SESSION['is_admin'] == 1){	echo "<p style='color:green; text-decoration: underline; font-size:20px;'>Administrator</p></div>";}
			else{echo "<p style='color:green; text-decoration: underline; font-size:20px;'>Standardowy Użytkownik</p></div>";}
			echo "<div id='logowaniacz_part_two' style='width:40px; float:left;'><a href='exit.php'><button style='background: url(./GFX/logout.png); width:40px;height:40px; border: none; cursor: pointer; background-position: center top; background-size: 100% 100%;' name='wyloguj'>.</button></a></div>";
			
		

			
			}else{echo "Nie zalogowano";}
		?>
<div id="przycisk_powrotu"><a id='ukryj_panel_b' href='#'><button style='background: url(./GFX/hide.png); cursor: pointer; width:60px;height:80px; border: none; background-position: center top; background-size: 100% 100%;'></button></a></div>

	
	
	</div>
		
   </div>
   
   
   
 


<?php ///formularz wyboru folderu i panel wyboru folderu



echo " <div id='panel_wyboru'> 
Wybor folderu:
<form action='index.php' method='post'>
  <select class='formField' id='folder' name='folder' onchange='this.form.submit()' placeholder='Nazwa folderu' style='margin-left:0px;'>
  <option value=''></option>";

if($_SESSION['is_admin']==1){
	foreach(glob('images/*', GLOB_ONLYDIR) as $dir) {
  $dir = str_replace('images/', '', $dir);
  echo  "<option value='./".$dir."'>".$dir."</option>";
	}
}else{
	foreach(glob('images/'.strtolower($_SESSION['user']).'*', GLOB_ONLYDIR) as $dir) {
  $dir = str_replace('images/', '', $dir);
  echo  "<option value='./".$dir."'>".$dir."</option>";
	}
}

echo " </select>
</form>";

?>


 </div> 
 <!--panel dodawania folderu-->
 
 <div id="panel_dodawania_folderu">
Dodaj folder:
<form action='index.php' method='post'>
  

<input type='text' class="formField" id='fname' name='fname'  placeholder='Nazwa folderu'  minlength='1' maxlength='7' style='margin-left:0px;'>

<input type='submit' value='Utwórz folder' class='przyciskem'>
</form>


<?php ///formularz dodawania folderow

if(isset($_POST['fname'])){
  if (!empty($_SESSION['user'])){

    mkdir("./images/".strtolower($_SESSION['user']).$_POST['fname'], 0777);
    mkdir("./images/".strtolower($_SESSION['user']).$_POST['fname']."/".strtolower($_SESSION['user']).$_POST['fname'], 0777);

  }
   echo "<script>window.location.href = window.location.pathname + window.location.search + window.location.hash;</script>"; //odswiezenie okna 
}

?>
</div>

 <!--//panel dodawania zdjęć na serwer (uploadowanie) -->
<div id="panel_uploadu">
Dodaj zdjęcia do folderu:
 <!--//formularz dodawania zdjec na serwer -->
<form method='post' action='upload.php' enctype='multipart/form-data'>
 <input type='file' name='file[]' id='file' multiple>
 <input type='submit' class='przyciskem' name='submit' value='Załaduj zdjęcia' style='margin-top:4px;'>
</form>
</div>
	
 <!--//panel optymalizacji (przeprowadzenie testu wydajnosciowego) -->
 <div id="panel_optymalizacji">
Optymalizacja i test wydajności:<br>
	<button class="przyciskem" onclick="window.location.replace('test1a.html');">Optymalizuj</button>


 </div>
 
<div id="panel_info">
<div id="liczba_info">-</div>
<div id="doladowanie_info">-</div>
Wersja aplikacji: 1.1 <br>
Autor: Norbert Kamionka
</div>


</div>

<?php
//wysuwanie i ukyrwanie panelu
if( isset($_SESSION['user'])){
echo "<a id='pokaz_panel_b' href='#'><button style='background: url(./GFX/show.png); cursor: pointer; float:right; width:60px;height:80px; border: none; background-position: center top; background-size: 100% 100%;'></button></a> ";
}

//sprawdzenie czy juz istnieje wybrany folder by w razie odswiezania strony go zaladowac (chyba ze wybrano inny folder do zaladowania)
if (isset($_SESSION['direktoria']) && !isset($_POST['folder'])){
$direktoria = ($_SESSION['direktoria']);
wyswietl($direktoria);
}
//jesli jest wybrany nowy folder do zaladowania to wtedy jest ladowany 
if (isset($_POST['folder']) ){
$direktoria = ($_POST['folder']);
wyswietl($direktoria);
}
	
echo "

<!-- menu kontekstowe-->
<div id='context-menu'>
<div class='item' id='zdj_metadane'>
<i class='zdj_metadane_i'></i> Metadane
</div>
<hr>
<div class='item'  id='zdj_usun' >
<i id='zdj_usun_i'></i> Usuń
</div>

</div>
";


function wyswietl($direktoria){
	
	// okreslenie wybranego folderu w celu zapisania go do zmiennej
	
	$direktoria = ltrim($direktoria, './');
	$direktoria = ltrim($direktoria, '/');
	$direktoria = preg_replace('/[^\p{L}\p{N}\s]/u', '', $direktoria);
	$_SESSION['direktoria'] = $direktoria; // sama nazwa folderu bez "./" i "/"
	
    $dir = "./images/".$direktoria;     //  ./images/nazwa_folderu
    $dirx=$dir."/";                    //   ./images/nazwa_folderu/                 
    $dirdotless = ltrim($dirx, './');  //     images/nazwa_folderu/  
	
   
echo "<div style='color:#533471;height:8vh;font-size:35px;margin-left:37vw;'>Wybrano folder: ".$direktoria."</div>";

	echo " <div id = 'container'>";
	  
    $i=0;
    $i_two=0;
	//$_SESSION['var_wydajnosciowa'] = 10;
	$liczba_wyswietlanych=$_SESSION['var_wydajnosciowa'];
      if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
         while (($file = readdir($dh)) !== false) {
         //ladowanie tylko tylu zdjec na ile pozwala wyliczona zmienna wydajnosciowa
         if($i_two<$liczba_wyswietlanych){
         //warunek if pomija bledy dotyczace wylistowania nazwy danego katalogu
             if($i>1 && ($file)!=$direktoria) echo " <div class='imageq'  id='".$i."' style='background: url(\"".$dirx.$file."\"); background-position: center top; background-size: 100% 100%;'; oncontextmenu='kontekst(id)'; onclick='przenies(this.id)'><p id='t_".$i."'>".$dirdotless.$direktoria."/".$file."</p></div>";
          $i++; 
          $i_two++; 
         }else{
          if($i>1 && ($file)!=$direktoria) echo " <div class='imageq'  id='".$i."' style='background: url(\"".$dirx.$file."\"); display:none; background-position: center top; background-size: 100% 100%;'; oncontextmenu='kontekst(id)'; onclick='przenies(this.id)'><p id='t_".$i."'>".$dirdotless.$direktoria."/".$file."</p></div>";
          $i++; 
             }

          }
		  


    closedir($dh);
        }
      }
    echo "</div>";
	
	 
	 echo "<button class='przyciskem' id='b_laduj_nexty' onclick='doladuj()' style='margin-left:37vw;margin-top:0.5vh;'>Wczytaj następne</button>"; // przycisk ladnowania dalszej procji zdjec
     echo "<div id='ostzdjecie' style='display:none;'>".$liczba_wyswietlanych."</div>";
	 echo "<div id='limit' style='display:none;'>".$i."</div>";
	 
	 $i = $i - 3;
	 echo "<script>document.getElementById('doladowanie_info').innerHTML ='Liczba zdjęć doładowywanych: ".$_SESSION['var_wydajnosciowa']."'</script>";
	 echo "<script>document.getElementById('liczba_info').innerHTML ='Zdjęcia w tym folderze: ".$i."'</script>";
}
	
	
?>

<script> 
 window.addEventListener("click",function(){
  document.getElementById("context-menu").classList.remove("active");
});
 
//otwarcie menu kontekstowego (RPM)
function kontekst(id) {

  event.preventDefault();
  var contextElement = document.getElementById("context-menu");
  contextElement.style.top = event.pageY + "px";
  console.log( event);
  contextElement.style.left = event.pageX + "px";
  contextElement.classList.add("active");
 
  document.getElementById("zdj_metadane").onclick = function (kadmik) {  metadata(id)}; 
  document.getElementById("zdj_usun").onclick = function (kadmik) { usun_zdj(id) }; 

}

  // otwieranie oryginalu
function przenies(id) {
	
	
var czy_admin = <?php echo $_SESSION['is_admin']; ?>;
url =  document.getElementById('t_'+id).innerHTML;
	if(czy_admin == 1){
	 
    $("#Smalpodglad").css('background-image', 'url(' + url + ')');
		window.open(url);
	}else{
		window.open("watermark.php?img_name="+url);
	}
      
}

//otwieranie metadanych danego zdjecia
function metadata(id) {

        url =  document.getElementById('t_'+id).innerHTML;
		window.open("metadata.php?img_name="+url);
   

}



function usun_zdj(id) {

        url =  document.getElementById('t_'+id).innerHTML;
		window.open("delete_img.php?img_name="+url);
		
		//odswiezenie musi byc z opoznieniem gdyz nalezy odswiezyc strone dopiero po wykonaniu skryptu php
		setTimeout(function(){
		window.location.href = window.location.pathname + window.location.search + window.location.hash;

		}, 50); 
       


}


function resize_wyzwalacz(){
	window.open("resize.php");
}

function doladuj(){
   
    var ilosc_doladowania = <?php echo $_SESSION['var_wydajnosciowa']; ?>;
	var ost_zdjecie = parseFloat(document.getElementById("ostzdjecie").innerHTML);
	var limit=parseFloat(document.getElementById("limit").innerHTML);

	var i=0;
	for(i = 0; i < ilosc_doladowania; i++){
		 console.log(ost_zdjecie);
		if(ost_zdjecie+i >= limit){
			alert("Wyświetlono wszystkie zdjęcia w tym folderze!");
			document.getElementById("b_laduj_nexty").style.visibility = "hidden";
			break;
		}else{
			var elem =  document.getElementById(ost_zdjecie+i);
			if(elem){ elem.style.display = "inherit";}
			
		}
		
	}

	document.getElementById("ostzdjecie").innerHTML=ost_zdjecie+i;	
}

</script>

</body>
</html>