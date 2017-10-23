<?php require_once('inc/clases/bd.inc.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<?php 
		require_once('inc/header.inc.php'); 
		require_once('inc/buscar.inc.php');
		require_once('inc/aside.inc.php');
	?>
	
	<h2>Editar Entrada</h2>



	<?php

		//verificando que llega el id de la entrada

		$identrada = "";

		if(isset($_GET['identrada'])){

			$identrada = $_GET['identrada'];
		}

	?>

	<form method="POST" action="#">
		<label for="id">ID entrada: </label>
			<input type="number" name="id" value="<?=$identrada?>"><br>
		<label for="titulo">Título: </label>	
			<input type="text" name="titulo"><br>
		<label for="contenido">Contenido: </label>	
			<input type="text" name="contenido"><br>
		<label for="etiquetas">Etiquetas: </label>	
			<input type="text" name="etiqueta"><br>
			<input type="file" name="imagen"><br>
			<input type="submit" name="enviar">
	</form>

</body>
</html>