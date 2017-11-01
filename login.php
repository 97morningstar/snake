<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>

<style type="text/css">
	
</style>


</head>
<body>
	<?php 
	session_start();
$name = '';


	$message = '';

		if(isset($_POST['submit'])){

			if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    }
    else{
    	$name = test($_POST['name']);
    }

			if(isset($_POST['name']) && $_POST['password']){
				$db = mysqli_connect('localhost', 'root', '', 'snakedb');
				$sql = sprintf("SELECT * FROM users WHERE name='%s'", 
					mysqli_real_escape_string($db, $_POST['name'])
				);
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_assoc($result);
				if($row){
					$hash = $row['password'];
					//$isAdmin = $row['admin'];  //yo soy admin :D

					if(password_verify($_POST['password'], $hash)){
						echo 'Lograste pasar';

						/***** aca ponemos la informacion de la sesion (quien esta logueado y su info) *******/
					 $_SESSION['user'] = $row['name'];
					 $_SESSION['puntos'] = $row['puntos'];
					//	$_SESSION['isAdmin'] = $isAdmin;
						header('Location: index.php');


					}else{
						echo 'Login fallido, sabemos que existes pero olvidaste tu contraseña? D: ';
					}

				}else{
					echo 'Login fallido, ups no existes, deseas crearte? ve a register';
				}
				mysqli_close($db);
			}else{
			echo 'debes poner tu nombre y contra';
			}
	}
	
	function test($d) {
  $d = trim($d);
  $d = stripslashes($d);
  $d = htmlspecialchars($d);
  return $d;
}


 ?>


	<h1>Login</h1>

	<form method="post" action="">
		<label for="name">Name:</label>
		 <input type="text" name="name" id="name" value="<?php echo test($name); ?>" ><br><br>
		<label for="password">Password: </label>
		 <input type="password" name="password" id="password"><br><br>
		<input type="submit" name="submit" value="Jugar"><br><br>
		<input type="button" value="Register" id="register" />
	</form>



	<script type="text/javascript">
		
		var register = document.getElementById('register');
        register.addEventListener('click', function(){
        	location.href='register.php';
        });

	</script>

</body>
</html>
