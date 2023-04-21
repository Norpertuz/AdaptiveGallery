<?php
session_start();
$result = $_GET['result'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
echo $result."<br>";
echo $user_agent;
function getRealIpAddr()
{
	

	
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



$_SESSION['var_wydajnosciowa'] = round(((-0.156)*$result)+3100);
if($_SESSION['var_wydajnosciowa'] <=1){$_SESSION['var_wydajnosciowa']=50;}
$ip=getRealIpAddr();
$host = gethostbyaddr($ip);
$data=date("d-m-Y H:i:s");
$file = "results.txt";
$plik = fopen($file,"a") or $error = "Nie mogę otworzyć pliku: ".$file;

fputs($plik,$data." || ".$ip." || ".$host." || ".$user_agent." || Wynik(ms):".$result."\r\n");
fclose($plik);
//echo "<script type='text/javascript'>window.close();</script>";
echo "<script type='text/javascript'>window.location.replace('index.php');</script>";
 ?>