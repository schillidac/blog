<?php 
	require_once('inc/clases/bd.inc.php'); 

	//1.Variables para usar en el formulario

	$tituloPagina = "";
	$identrada = "";
	$titulo = "";
	$contenido = "";
	$etiqueta = "";
	$validarFormulario = true;

	/*
		COMPROBAMOS SI EL USUARIO QUIERE EDITAR O CREAR ENTRADA

		2.Compruebo si llega el ID de la entrada, si llega...
			la variable titulo valdrá editar entrada, luego se mostrará dentro de un h2
				la variable identrada valdrá el id de la entrada

	*/
	if(isset($_GET['idEntrada'])){
		$tituloPagina = 'Editar Entrada';
		$identrada = $_GET['idEntrada'];
	}
	/*
		3.Si no se ha enviado un id de entrada por url significa que el usuario quiere crear una entrada nueva
			la variable titulo valdrá crear entrada, luego se mostrará dentro de un h2
	*/
	else
		$tituloPagina = 'Crear Entrada';

	/*
		COMPROBAMOS SI LA ENTRADA SE HA EDITADO O CREADO CORRECTAMENTE

		4.Comprobamos que la variable verificar del formulario de esa página ha llegado y lo hace correctamente
	*/
	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

		//4.1 Si el titulo de la entrada está vacío o tiene HTML la variable validar formulario valdrá false
		if($_POST['titulo'] == "" || strcmp($_POST['titulo'], strip_tags($_POST['titulo'])) != 0)
			$validarFormulario = false;

		/*
			4.2 Si validar formulario es true y...
				contenido está vacío o contiene HTML
		*/
		if($validarFormulario && $_POST['contenido'] == "" || strcmp($_POST['contenido'], strip_tags($_POST['contenido'])) != 0)
			$validarFormulario = false;
		/*
			4.3 Si validar formulario es true y...
					entrada está vacía o contiene HTML
		*/
		if($validarFormulario && $_POST['etiqueta'] == "" || strcmp($_POST['etiqueta'], strip_tags($_POST['etiqueta'])) != 0)
			$validarFormulario = false;

		/*
			4.4 Si validar formulario es false
					guardo las variables del formulario para mostrarlas después en los values de los campos
		*/
		if(!$validarFormulario){
			$titulo = $_POST['titulo'];
			$contenido = $_POST['contenido'];
			$etiqueta = $_POST['etiqueta'];
		}
		/*
			4.5 Si validar formulario es true redirecciono a listar entradas.
		*/		
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
	<title><?= $tituloPagina ?></title>
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