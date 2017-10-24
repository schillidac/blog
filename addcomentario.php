<?php require_once('inc/clases/bd.inc.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
</head>
<body>
	<?php 
		require_once('inc/header.inc.php'); 
		require_once('inc/buscar.inc.php');
		require_once('inc/aside.inc.php');
	?>

	<h2>Añadir comentario</h2>

 	<?php
 		if(isset($_POST['nombre']) && isset($_POST['comentario'])){

 			if(!preg_match('/^[A-Z]{1}[a-z\s]/', $_POST['nombre']))
 				echo "nombre incorrecto";

 			$nombre = $_POST['nombre'];
 			$comentario = $_POST['comentario'];

 			echo '<i>Comentario guardado</i><br><br>';

 			echo 'Nombre: ' .$nombre. '<br>
 				  Comentario: ' .$comentario;  
 		}
 		else{
 	?>	

			<form method="POST" action="#">
				<p>Se va a añadir un comentario a la entrada XXX<br>
					*<i>Los comentarios están sujetos a la moderación de un administrador</i></p>
				<label for="nombre">Nombre: </label><input type="text" name="nombre"><br>
				<label for="comentario">Comentario: </label><input type="text" name="comentario"><br>
				<input type="submit" name="enviar">
			</form>

	<?php } ?>


</body>
</html>