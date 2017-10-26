<?php 

	require_once('inc/clases/bd.inc.php'); 

	$contenido = "";

	if(!isset($_POST['verificador']) || $_POST['verificador'] != 1){
		header('Location: '. $_SERVER['HTTP_REFERER']);

	}

	if(isset($_POST['busqueda']) && isset($_POST['palabras']) && ($_POST['palabras'] == 1 || $_POST['palabras'] == 0)){

		$contenido 	= 	'Busqueda: ' .$_POST['busqueda']. '<br>
						Palabras: ' .$_POST['palabras'];

	}
	else{

		$contenido 	= 	'No se ha realizado la búsqueda correctamente';

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<?php 
		require_once('inc/header.inc.php'); 
		require_once('inc/buscar.inc.php');
		require_once('inc/aside.inc.php');


		echo $contenido;
	?>

	<h2>Búsqueda</h2>

</body>
</html>