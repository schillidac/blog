<?php 
	require_once('inc/clases/bd.inc.php'); 

	$tituloPagina = "";
	$identrada = "";
	$titulo = "";
	$contenido = "";
	$etiqueta = "";
	$validarFormulario = true;

	//comprobando si llega el id de la entrada para editar
	if(isset($_GET['idEntrada'])){
		$titulo = 'Editar Entrada';
		$identrada = $_GET['idEntrada'];
	}
	else
		$titulo = 'Crear Entrada';

	//comprobando si el formulario se envía corréctamente
	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

		if($_POST['titulo'] == "" || strcmp($_POST['titulo'], strip_tags($_POST['titulo'])) != 0)
			$validarFormulario = false;

		if($validarFormulario && $_POST['contenido'] == "" || strcmp($_POST['contenido'], strip_tags($_POST['contenido'])) != 0)
			$validarFormulario = false;

		if($validarFormulario && $_POST['etiqueta'] == "" || strcmp($_POST['etiqueta'], strip_tags($_POST['etiqueta'])) != 0)
			$validarFormulario = false;

		if(!$validarFormulario){
			print_r($_POST);
			$titulo = $_POST['titulo'];
			$contenido = $_POST['contenido'];
			$etiqueta = $_POST['etiqueta'];
		}
		else{
			header('Location: /listarentradas.php');
			exit();
		}
	}
?>

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
	
	<h2><?= $tituloPagina ?></h2>

	<form method="POST" action="#">
		<label for="id">ID entrada: </label>
			<input type="number" name="id" value="<?=$identrada?>"><br>
		<label for="titulo">Título: </label>	
			<input type="text" name="titulo" value="<?= $titulo ?>"><br>
		<label for="contenido">Contenido: </label>	
			<input type="text" name="contenido" value="<?= $contenido ?>"><br>
		<label for="etiquetas">Etiquetas: </label>	
			<input type="text" name="etiqueta" value="<?= $etiqueta ?>"><br>
			<input type="file" name="imagen"><br>
			<input type="hidden" name="verificar" value="1">
			<input type="submit" name="enviar">
	</form>

</body>
</html>