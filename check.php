<html lang = "pl-PL">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Adaptacyjna galeria zdjęć - aplikacja webowa " />
  <meta name="author" content="Norbert Kamionka">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rejestracja</title>
</head>


<body>

<?php
    //rejestracja i sprawdzenie czy uzytkownik juz istnieje
	session_start();

	$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
	$login = strtolower($login);
	$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
	if (mb_strlen($login)<4 || mb_strlen($login)>15)
	{
		echo "Login musi zawierać od 4 do 15 znaków.";
	}
	else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $login) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)){
		echo "Login oraz imię nie mogą zawierać znaków białych oraz specjalnych!";
	}
	else if (mb_strlen($name)<4 || mb_strlen($name)>20)
	{
		echo "Imię musi zawierać od 4 do 20 znaków.";
	}  else if (mb_strlen($pass)<4 || mb_strlen($pass)>10)
    {
		echo "Hasło powinno zawierać od 4 do 20 znaków.";
    }
	else{
	
	$pass = md5($pass."npz123ttes");
	$pass = sha1($pass."1234npzttee");
	$pass = sha1($pass."768terty");
	
	//wybor bazy danych
	$servername = "localhost";
	$username="root";
	$password=""; 
	$db_name="users";
		
	// Utworzenie polaczenia
	$conn = new mysqli($servername, $username, $password, $db_name);
	// Sprawdzenie czy uzytkownik juz istnieje
		$sql = "SELECT * FROM users WHERE login='$login'";	
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "Taki login już istnieje, spróbuj ponownie!";
			}
		} else {
			$conn->query("INSERT INTO `users` ( `login`, `pass`, `name`, `is_Admin`) VALUES ('$login', '$pass', '$name', '0')") ;
			mkdir("./images/".$login, 0777);
			mkdir("./images/".$login."/".$login, 0777);
			echo "Dziękujemy za rejestrację ", $login ,", twoje konto zostało utworzone.";
		}
	$conn->close();
	//header('location: /' );	
	}
?>

<br>
<button class="przyciskem" onclick="window.history.back()" />Powrót</button>
</body>
</html>