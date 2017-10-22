<?php require_once('inc/clases/bd.inc.php'); ?>

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
	?>

	<h2>Búsqueda</h2>

	<?php 

		if(isset($_POST['busqueda']) && isset($_POST['palabras']) && ($_POST['palabras'] == 1 || $_POST['palabras'] == 0)){

			$busqueda = $_POST['busqueda'];
			echo 'Busqueda: ' .$busqueda. '<br>';
			$palabras = $_POST['palabras'];
			echo 'Palabras: ' .$palabras;

		}
		else{

			echo 'No se ha realizado la búsqueda correctamente';

		}


 	 ?>

</body>
</html>