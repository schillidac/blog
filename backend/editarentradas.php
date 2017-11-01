<?php 
	require_once('../inc/clases/bd.inc.php'); 

	//1.Variables para usar en el formulario

	$tituloPagina = '';
	$identrada = '';
	$titulo = '';
	$contenido = '';
	$etiqueta = '';
	$comentarios = '';
	$validarFormulario = true;
	$entradas = $bdd->mostrarEntradas();

	/*
		SE COMPRUEBA SI EL USUARIO QUIERE EDITAR O CREAR ENTRADA

		2.Se comprueba si llega el ID de la entrada, si llega...
			la variable titulo valdrá editar entrada, y las demás variables contendrán los datos de la entrada para mostrarse en el formulario
	*/
	if(isset($_GET['idEntrada'])){
		foreach ($entradas as $entrada) {
			if($entrada->idEntrada == $_GET['idEntrada']){

				$tituloPagina = 'Editar Entrada';
				$identrada = $_GET['idEntrada'];
				$titulo = $entrada->titulo;
				$contenido = $entrada->cuerpo;
				$comentarios = $entrada->comentarios;
			}
		}


	}
	/*
		3.Si no se ha enviado un id de entrada por url significa que el usuario quiere crear una entrada nueva,
			por lo tanto la variable titulo valdrá crear entrada, luego se mostrará dentro de un h2
	*/
	else
		$tituloPagina = 'Crear Entrada';

	/*
		SE COMPRUEBA SI LA ENTRADA SE HA EDITADO O CREADO CORRECTAMENTE

		4.Se comprueba que la variable verificar del formulario de esa página ha llegado y lo hace correctamente
	*/
	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

		//4.1 Si el titulo de la entrada está vacío o tiene HTML la variable validar formulario valdrá false
		if($_POST['titulo'] == "" || strcmp($_POST['titulo'], strip_tags($_POST['titulo'])) != 0)
			$validarFormulario = false;

		/*
			4.2 Si validar formulario es true y
				contenido está vacío o contiene HTML, no se validará el formulario
		*/
		if($validarFormulario && $_POST['contenido'] == "" || strcmp($_POST['contenido'], strip_tags($_POST['contenido'])) != 0)
			$validarFormulario = false;
		/*
			4.3 Si validar formulario es true y...
					entrada está vacía o contiene HTML, no se validará el formulario
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
			4.5 Si validar formulario es true redirecciona a listar entradas.
		*/		
		else{
			header('Location: listarentradas.php');
			exit();
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $tituloPagina ?></title>
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div id="contenedor">
		<?php 
			require_once('../inc/header.inc.php'); 
		?>
		<section id="contenido"> 
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
			<?php 
				//si comentarios es igual a null significa que la entrada no tiene ninguno, sino mostrará los comentarios que tenga
				if($comentarios == null)
					echo '<h3>La entrada no tiene comentarios</h3>';
				else{
					echo '<h3>Comentarios de la entrada</h3>';
			 		foreach ($comentarios as $indice => $comentario) {	
			 			echo 	'<h4>' .$comentario->autor. '</h4>
			 					 <p>' .$comentario->texto. '</p>
			 					 <a href="#">Borrar comentario</a>';
			 		}
				}

	 		?>
		</section>

	</div>
</body>
</html>