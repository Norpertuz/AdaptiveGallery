<?php
	//logowanie
	session_start();

	$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

	if(empty($login) || empty($pass)){
		echo "Hasło oraz login nie moga byc puste.";
	} else{
       	
	$pass = md5($pass."npz123ttes");
	$pass = sha1($pass."1234npzttee");
	$pass = sha1($pass."768terty");
	
		$servername = "localhost";
		$username="root";
		$password="";
		$db_name="users";
		// Utworzenie polaczenia
		$conn = new mysqli($servername, $username, $password, $db_name);	
	
		$sql = "SELECT * FROM users WHERE login='$login' AND pass='$pass'";	
		$result = $conn->query($sql);
	
		if ($result->num_rows > 0) {
			while($row=mysqli_fetch_row($result)) {
				$_SESSION["user"] = $login;
				$_SESSION["is_admin"] = $row[3];
				header('Location: test1a.html');
			}
		} else {
			echo "Błąd autoryzacji!";
		}
		$conn->close();
		
	}	
?>
