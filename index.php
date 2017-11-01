<?php 
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Snake</title>

<script type="text/javascript">
	var puntaje = <?php echo $_SESSION['puntos']; ?>;
	puntaje = parseInt(puntaje);
</script>




	<script type="text/javascript" src="libraries/p5.js"></script>
	<script type="text/javascript" src="libraries/p5.dom.js"></script>
	<script type="text/javascript" src="cosa.js"></script>

	<style type="text/css">
	#defaultCanvas0{
		height: 500px !important;
		width: 500px !important;
		padding-left: 30px;
	}

	body {
	  margin: 0;
	}
	</style>



</head>
<body>


	
<h1>Usuario: <?php
		echo $_SESSION['user'];
   ?> </h1> 
   <h2>Puntuacion mas alta: <?php
		echo $_SESSION['puntos'];
   ?></h2>

</body>
</html>