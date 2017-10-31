<?php require_once('inc/clases/bd.inc.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="contenedor">
		<?php 
			require_once('inc/header.inc.php'); 
			require_once('inc/buscar.inc.php');
			require_once('inc/aside.inc.php');
		?>

		<h2>Login</h2>
		<?php
			/* 
				1.-Compruebo si la página de listar entradas me ha mandado una variable de error
			*/
			if(isset($_GET['error']) && $_GET['error'] == true)
				echo 'Login incorrecto';
		?>

		<form method="POST" action="backend/listarentradas.php">
			<label for="usuario">Usuario: </label>
				<input type="text" name="usuario"><br>
			<label for="pass">Contraseña: </label>
				<input type="password" name="pass"><br>
				<input type="hidden" name="verificar" value="1">
			<input type="submit" value="enviar">
		</form>
	</div>
</body>
</html>