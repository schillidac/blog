<?php 

	require_once('inc/clases/bd.inc.php'); 

	//verificacion del login

	if(isset($_POST['verificar']) && $_POST['verificar'] == 1 || isset($_GET['verificar']) && $_GET['verificar'] == 1 ){

		if(isset($_POST['usuario']) && isset($_POST['pass'])){

			$comprobante = false;
			$usuarios = $bdd->mostrarUsuarios();

			foreach($usuarios as $usuario){

				if($usuario->user == $_POST['usuario'] && $usuario->pass == $_POST['pass'])
				$comprobante = true;

			}

			if(!$comprobante){
				header('Location: /login.php?error=true');
				exit();
			}
		}
	}
	else{
		header('Location: /login.php?error=true');
		exit();
	}

	//verificacion del filtro
	$entradas = $bdd->mostrarEntradas();
	$contenido = "";

	if((isset($_GET['mes']) || isset($_GET['ano'])) && isset($_GET['busqueda'])){

		if(($_GET['mes'] == null && $_GET['ano'] == null) || ($_GET['mes'] != null && $_GET['ano'] == null) || $_GET['busqueda'] == null)
			$contenido = 'Filtrado incorrecto';

		if($contenido == "" && ($_GET['mes'] != null && !preg_match('/^[0-9]{2}$/', $_GET['mes'])) || ($_GET['ano'] != null && !preg_match('/^[0-9]{4}$/', $_GET['ano'])))
			$contenido = 'Filtrado incorrecto';

		if($contenido == "" && ($_GET['busqueda'] != null && strcmp($_GET['busqueda'], strip_tags($_GET['busqueda'])) != 0))
			$contenido = 'Filtrado incorrecto';
	
		if($contenido == ""){
			//mostrar filtrado
			$contenido	=	'Mes: ' .$_GET['mes']. '<br>
				  			Año: ' .$_GET['ano']. '<br>
				  			Búsqueda: ' .$_GET['busqueda'];

		}
	}
	else{

		//mostrar todas las entradas

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