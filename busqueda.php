<?php 

	require_once('inc/clases/bd.inc.php');

	/*
		La búsqueda se realiza con el método get por los siguientes motivos:
			1. El navegador puede cachear la url y guardarla en el historial
			2. Puede ser indexada por los buscadores
			3. El usuario puede guardar esa url para visitarla después
	*/

	$busqueda = '';
	$palabras = '';
	$mensaje = '';
	$tituloPagina = 'Busqueda';
	$comprobante = true;

	//2. Si los radio button llegan con el valor 1 o 0 se mostrará la búsqueda
	if(isset($_GET['busqueda']) && isset($_GET['palabras']) && ($_GET['palabras'] == 1 || $_GET['palabras'] == 0)){
		//2.1 Se comprueba que la búsqueda venga sin etiquetas HTML y con contenido
		if(strcmp($_GET['busqueda'], strip_tags($_GET['busqueda'])) != 0 || $_GET['busqueda'] == '')
			$comprobante = false;
	}
	else
		$comprobante = false;

	if($comprobante){
		$busqueda = $_GET['busqueda'];
		$palabras = $_GET['palabras'];
		$tituloPagina = 'Resultados de búsqueda para ' .$busqueda; 
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $tituloPagina ?></title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="contenedor">
		<?php 
			require_once('inc/header.inc.php'); 
			require_once('inc/buscar.inc.php');
		?>

		<section id="contenido">
			<?php
				echo 	'<h2>' .$tituloPagina. '</h2>';
				//3. Se muestra el resultado de la búsqueda, si comprobante es false se mostrará mensaje de error
				if($comprobante)
					echo 	'Búsqueda: ' .$busqueda. '<br>
						  	 Palabras: ' .$palabras;
				else
					echo 	'No se ha realizado la búsqueda corréctamente';
			?>
		</section><!--
	 --><?php
			require_once('inc/aside.inc.php');
		?>
	</div>
</body>
</html>