<!DOCTYPE html>
<html>
<head>
	<title>Register for play please</title>
</head>
<body>

<?php 
	$name = '';
	$password = '';

	if(isset($_POST['submit'])){
		$ok = true;

	if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    }
    else{
    	$name = test($_POST['name']);
    }
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $ok = false;
    }
    else{
    	$password = test($_POST['password']);
    }


    if($ok){

		$hash = password_hash($password, PASSWORD_DEFAULT);


					/** deberia cambiar lo del localhost pero luego preguntare <-- ***/
		$db = mysqli_connect('localhost', 'root', '',  'snakedb');

		$res = sprintf("SELECT * FROM users WHERE name='%s'", 
			mysqli_real_escape_string($db, $_POST['name'])
		);

		$result = mysqli_query($db, $res);
		$row = mysqli_fetch_assoc($result);

	 if($row){
	 	echo 'ups, ya te estas registrado';  //
	 }else{


	    $sql = sprintf("INSERT INTO users (name, password) VALUES ('%s','%s')", 
	    	mysqli_real_escape_string($db, $name), 
			mysqli_real_escape_string($db, $hash));

		mysqli_query($db, $sql);
		mysqli_close($db);
		echo '<p>Se añadio el usuario, bienvenido, felicidades, que se yo</p>';
		header('Location: login.php');
	}
	
	}else{
		echo 'paso algo malo D: comprueba que pusiste tu password o tu nombre';
	}




	}

		function test($d) {
	  $d = trim($d);
	  $d = stripslashes($d);
	  $d = htmlspecialchars($d);
	  return $d;
}



 ?>



<h1>Register for play please!!!</h1>

	<form method="post" action="">
		<label for="names">Your name:</label>
		 <input type="text" name="name" id="names" value="<?php echo test($name); ?>"> <br><br>
		<label for="passwords">Your password: </label>
		 <input type="password" name="password" id="passwords" value="<?php echo test($password); ?>"><br><br>
		<input type="submit" name="submit" value="Come on in, you are invited!!!"><br><br>
	</form>

</body>
</html>