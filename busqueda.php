<?php 

	require_once('inc/clases/bd.inc.php'); 

	$resultadoBusqueda = "";

	//1.- Si se accede a esta página sin la variable verificador o con un valor diferente a 1, redirecciona a la anterior.
	if(!isset($_POST['verificador']) || $_POST['verificador'] != 1){
		header('Location: '. $_SERVER['HTTP_REFERER']);

	}

	//2. Si los radio button llegan con el valor 1 o 0 se mostrará la búsqueda
	if(isset($_POST['busqueda']) && isset($_POST['palabras']) && ($_POST['palabras'] == 1 || $_POST['palabras'] == 0)){

		$resultadoBusqueda 	= 	'Busqueda: ' .$_POST['busqueda']. '<br>
						Palabras: ' .$_POST['palabras'];

	}
	else{
		//3. Si no se cuplen las condiciones anteriores se muestra un mensaje de error.
		$resultadoBusqueda 	= 	'No se ha realizado la búsqueda correctamente';

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="contenedor">
		<?php 
			require_once('inc/header.inc.php'); 
			require_once('inc/buscar.inc.php');
			require_once('inc/aside.inc.php');

			echo '<h2>Búsqueda</h2>';
			//4. Se muestra el resultado de la búsqueda
			echo $resultadoBusqueda;
		?>
	</div>
</body>
</html>