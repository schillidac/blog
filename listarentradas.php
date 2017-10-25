<?php 

	require_once('inc/clases/bd.inc.php'); 
	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){

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


	<?php 

		$entradas = $bdd->mostrarEntradas();

	?>
	
	<h3>Filtrar entradas</h3>

	<form method="POST" action="#">
		<label for="mes">Mes: </label>
			<input type="number" name="mes" min="1" max="12">
		<label for="ano">Año: </label>
			<input type="number" name="ano">
		<label for="busqueda">Búsqueda: </label>
			<input type="text" name="busqueda">
			<input type="submit" name="enviar">
	</form><br>

	<?php		

			if(isset($_POST['mes']) && isset($_POST['ano']) && isset($_POST['busqueda'])){

				//mostrar filtrado

				echo 'Mes: ' .$_POST['mes']. '<br>
					  Año: ' .$_POST['ano']. '<br>
					  Búsqueda: ' .$_POST['busqueda'];

			}
			else{

				//mostrar todas las entradas

				echo '<ul>';

				foreach ($entradas as $entrada){

					echo '<li>' .$entrada->titulo. '
								<a href="editarentradas.php?identrada=' .$entrada->idEntrada. '">Editar</a>
								<a href="editarentradas.php?identrada=' .$entrada->idEntrada. '">Eliminar</a>
						  </li>';
				}

				echo '</ul>';
			}

	?>
</body>
</html>