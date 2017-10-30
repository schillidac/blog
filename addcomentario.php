<?php 

	require_once('inc/clases/bd.inc.php'); 

	$mensaje = "";
	$validarFormulario = true;

	//1. Si se accede a esta página con idEntrada con un valor que no sea numérico se redirecciona al indice
 	if(!is_numeric($_GET['idEntrada'])){
 		header('Location: /');
 		exit();
 	}

 	//2. Si llega la variable verificar y su valor es igual a 1 entramos a verificar
 	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

 		// 2.1 Si existe nombre pero no coincice con la expresion regular, mensaje valdrá un mensaje de error, además validarFormulario valdrá false
		if(isset($_POST['nombre']) && !preg_match('/([a-zñáéíóúàèìòùäëïöü\s\']{3,15})/', $_POST['nombre'])){

			$mensaje = 'El nombre contiene caracteres inválidos';
			$validarFormulario = false;
		}

		//2.1 Si existe comentario pero no coincice con la expresion regular, mensaje valdrá un mensaje de error, además validarFormulario valdrá false
		if(isset($_POST['comentario']) && strcmp($_POST['comentario'], strip_tags($_POST['comentario']))){

			$mensaje = 'El comentario contiene caracteres inválidos';
			$validarFormulario = false;
		}
		
		//3. Si llegados a este punto validarFormulario es true, significa que ha pasado todos los filtros y se puede guardar el comentario
		if($validarFormulario){

			$nombre = ucwords( strtolower( trim($_POST['nombre'])));
			$comentario = $_POST['comentario'];

			$mensaje = '<i>Comentario guardado</i><br><br>
						Nombre: ' .$nombre. '<br>
				  		Comentario: ' .$comentario;  

		}		
 	}
 	
?>

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

		echo $mensaje;

		//4. Si verificar no existe o vale distinto a 1 se mostrará el formulario para introducir comentario
		if(!isset($_POST['verificar']) || $_POST['verificar'] != 1){
	?>

	<h2>Añadir comentario</h2>
	
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