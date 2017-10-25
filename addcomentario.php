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

 	if(!preg_match('/[0-9]/', $_GET['idEntrada'])){
 		header('Location: /');
 		exit();
 	}

 	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

 		$comprobante = false;

		if(isset($_POST['nombre']) && !preg_match('/^([A-ZÑÁÉÍÓÚ]{1}[a-zñáéíóú\s]*)+$/', $_POST['nombre'])){
			echo 'El nombre contiene caracteres inválidos';
			$comprobante = true;
		}


		if(isset($_POST['comentario']) && strcmp($_POST['comentario'], strip_tags($_POST['comentario']))){
			echo 'El comentario contiene caracteres inválidos';
			$comprobante = true;
		}
		

		if(!$comprobante){

			$nombre = $_POST['nombre'];
			$comentario = $_POST['comentario'];

			echo '<i>Comentario guardado</i><br><br>';

			echo 'Nombre: ' .$nombre. '<br>
				  Comentario: ' .$comentario;  

		}		
 	}
 	else{
 	?>	
		<form method="POST" action="#">
			<p>Se va a añadir un comentario a la entrada XXX<br>
				*<i>Los comentarios están sujetos a la moderación de un administrador</i></p>
			<label for="nombre">Nombre: </label>
				<input type="text" name="nombre"><br>
			<label for="comentario">Comentario: </label>
				<input type="text" name="comentario"><br>
				<input type="hidden" name="verificar" value="1">
				<input type="hidden" name="entrada" value="<?= $_GET['idEntrada'] ?>">
			<input type="submit" name="enviar">
		</form>

	<?php } ?>


</body>
</html>