<?php 

	require_once('inc/clases/bd.inc.php'); 
	//Variable que se encargará de validar el login
	$comprobante = false;

	/* 
		1-Compruebo si llega el la variable verificador del login o si llega la variable verificadora del filtro de entradas
			la del login entra por post y la del filtro de entradas entra por get
	*/

	if(isset($_POST['verificar']) && $_POST['verificar'] == 1 || isset($_GET['verificar']) && $_GET['verificar'] == 1 ){
		/* 
			1-Compruebo que llegan las variables usuario y pass del formulario de login
		*/
		if(isset($_POST['usuario']) && isset($_POST['pass'])){
	
			$usuarios = $bdd->mostrarUsuarios();
			/* 
				1.2-Compruebo que el usuario existe en la bdd y que la contraseña coincide, si existe la variable comprobante cambia a true
			*/
			foreach($usuarios as $usuario){

				if($usuario->user == $_POST['usuario'] && $usuario->pass == $_POST['pass'])
				$comprobante = true;

			}
			/* 
				1.3-Si comprobante está en false redirecciono a la página de login con una variable de error que usaré para mostrar un mensaje
			*/

			if(!$comprobante){
				header('Location: /login.php?error=true');
				exit();
			}
		}
	}
	/* 
		1.4-Si la variable verificar que entra por get no existe o no es correcta redirecciono a la página de login con la variable de error
	*/
	else{
		header('Location: /login.php?error=true');
		exit();
	}
	/* 
		2-Verificacion del filtro de entradas
	*/
	$entradas = $bdd->mostrarEntradas();
	$contenido = "";
	/* 
		2.1-Si llega mes o año y busqueda entra en el if
	*/
	if((isset($_GET['mes']) || isset($_GET['ano'])) && isset($_GET['busqueda'])){
		/* 
			2.1.1-Si mes y año están vacíos o
					mes tiene contenido y año vacio o
						búsqueda está vacío, muestra error.
		*/
		if(($_GET['mes'] == null && $_GET['ano'] == null) || ($_GET['mes'] != null && $_GET['ano'] == null) || $_GET['busqueda'] == null)
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.2-Si la variable contenido está vacía y
					el mes tiene contenido y no cumple con los requisitos o
						el año tiene contenido y no cumple con los requisitos, muestra error.
		*/
		if($contenido == "" && ($_GET['mes'] != null && !preg_match('/^[0-9]{2}$/', $_GET['mes'])) || ($_GET['ano'] != null && !preg_match('/^[0-9]{4}$/', $_GET['ano'])))
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.3-Si la variable contenido está vacía y
					la búsqueda tiene contenido pero tiene html
						muestra error.
		*/
		if($contenido == "" && ($_GET['busqueda'] != null && strcmp($_GET['busqueda'], strip_tags($_GET['busqueda'])) != 0))
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.3-Si la variable contenido está vacía, significa que ha pasado todos los filtros, así que se muestran las variables
		*/	
		if($contenido == ""){
			//mostrar filtrado
			$contenido	=	'Mes: ' .$_GET['mes']. '<br>
				  			Año: ' .$_GET['ano']. '<br>
				  			Búsqueda: ' .$_GET['busqueda'];

		}
	}
	else{

		//Listado de las entradas

		$contenido 	=	'<ul>';

		foreach ($entradas as $entrada){

			$contenido 	.=	'<li>' .$entrada->titulo. '
								<a href="editarentradas.php?identrada=' .$entrada->idEntrada. '">Editar</a>
								<a href="editarentradas.php?identrada=' .$entrada->idEntrada. '">Eliminar</a>
				  			</li>';
		}

		$contenido 	.=	'</ul>';
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
	
	<h2>Listar Entradas</h2>

	<a href="editarentradas.php">Crear una entrada</a><br>
	
	<h3>Filtrar entradas</h3>

	<i>*Recuerda, el mes tiene dos cifras, el año cuatro y la búsqueda no debe contener HTML.</i><br><br>

	<form method="GET" action="#">
		<label for="mes">Mes: </label>
			<input type="number" name="mes" min="1" max="12" placeholder="01">
		<label for="ano">Año: </label>
			<input type="number" name="ano" placeholder="2017">
		<label for="busqueda">Búsqueda: </label>
			<input type="text" name="busqueda" placeholder="Introduce algo...">
			<input type="hidden" name="verificar" value="1">
			<input type="submit" name="enviar">
	</form><br>

	<?= $contenido ?>

</body>
</html>