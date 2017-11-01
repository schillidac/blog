<?php 
	require_once('inc/clases/bd.inc.php'); 
	//Variable que se encarga de validar el login
	$comprobante = false;
	//Variable que se encarga de validar el rol del usuario
	$administrador = false;
	//Variable que se encarga de mostrar un mensaje según el resultado del login
	$mensaje = '';

	$user = '';
	$password = '';

	/* 
		<-----------------SE COMPRUEBA SI EL LOGIN SE REALIZA CORRÉCTAMENTE ----------------->
		1-Se comprueba si llega la variable verificador del login y si lo hace corréctamente
	*/
	if(isset($_POST['verificar']) && $_POST['verificar'] == 1){
		/* 
			1-Se comprueba que llegan las variables usuario y pass del formulario de login
		*/
		if(isset($_POST['usuario']) && isset($_POST['pass'])){
	
			$usuarios = $bdd->mostrarUsuarios();
			/* 
				1.2-Se comprueba que el usuario existe en la bdd y que la contraseña coincide, si existe, la variable comprobante cambia a true
			*/
			foreach($usuarios as $usuario){

				if($usuario->user == $_POST['usuario'] && $usuario->pass == $_POST['pass'])
					$comprobante = true;

				if($comprobante && strcmp($usuario->rol, 'admin') == 0)
					$administrador = true;

			}
			/* 
				1.3-Si comprobante está en false se guarda el contenido del login en las variables correspondientes  para mostrarse en los values
			*/

			if(!$comprobante){
				$user = $_POST['usuario'];
				$password = $_POST['pass'];
				$mensaje = 'Login incorrecto';
			}
			/* 
				1.4-Si comprobante es true y además el usuario tiene el rol de administrador se le redirecciona a listar entradas del backend, sino, símplemente se mostrará un mensaje de bienvenida en la página de login
			*/
			else{
				if($administrador){
					header('Location: /backend/listarentradas.php');
					exit();	
				}
				else{
					$mensaje = 'Bienvenido ' .$_POST['usuario']. '!';
				}
			}
		}
	}
	/* 
		1.4-Si la variable verificar que entra por get no existe o no es correcta redirecciono a la página de login con la variable de error
	*/
	else if(isset($_POST['verificar']) && $_POST['verificar'] != 1){
		$mensaje = 'Login incorrecto';
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
		?>
		<section id="contenido">
			<h2>Login</h2>
			<?php

				if($comprobante && !$administrador)

					echo $mensaje;

				else if(!$comprobante){

					echo $mensaje;
			?>
					<form method="POST" action="#">
						<label for="usuario">Usuario: </label>
							<input type="text" name="usuario" value="<?= $user ?>"><br>
						<label for="pass">Contraseña: </label>
							<input type="password" name="pass" value="<?= $password ?>"><br>
							<input type="hidden" name="verificar" value="1">
						<input type="reset">
						<input type="submit">
					</form>
			<?php 	
				} ?>
		</section><!--
	 --><?php
			require_once('inc/aside.inc.php');
		?>
	</div>
</body>
</html>