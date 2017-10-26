<?php 

	require_once('inc/clases/bd.inc.php'); 

	//1. Variable que se encargará de validar el registro
	$permitirRegistro = true;


	/* 
		2-Comprobamos que la variable verificador llega y cumple con los requisitos
	*/
	if(isset($_POST['verificador']) && $_POST['verificador'] == 1){
		/* 
			2.1-Comprobamos que el usuario llega y cumple con los requisitos
		*/
		if(!isset($_POST['usuario'])  || !preg_match('/^([a-zñáéíóúA-ZÑÁÉÍÓÚ0-9\s]*)+$/', $_POST['usuario']))
			$permitirRegistro = false;
		/* 
			2.2-Comprobamos que la contraseña llega y cumple con los requisitos
		*/
		if(!isset($_POST['pass']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}/', $_POST['pass']))
			$permitirRegistro = false;
		/* 
			2.3-Comprobamos que la contraseña de confirmación es igual a la original
		*/	
		if(!isset($_POST['confirpass']) || strcmp($_POST['pass'], $_POST['confirpass']) != 0)
			$permitirRegistro = false;

		/* 
			2.4-Si la variable permitir registro es igual a true compruebo que el usuario no existe
		*/	
		if($permitirRegistro){
			
			$usuarios = $bdd->mostrarUsuarios();

			foreach ($usuarios as $usuario) {
				/* 
					2.4.1-Si el usuario existe la variable permitir registro pasa a false;
				*/
				if(strcmp($usuario->user, $_POST['usuario']) == 0)
					$permitirRegistro = false;

			}
		}

	}
	/*
		3.-Si la variable verificador no llega o no tiene el valor correspondiente permitir registro pasa a false
	*/
	else if(!isset($_POST['verificador']) || $_POST['verificador'] != 1){
		$permitirRegistro = false;
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
	?>

	<h2>Registro</h2>

	<?php 

		//si el formulario está validado muestra mensaje
		if($permitirRegistro){
			echo 'Registro realizado con éxito';
		}
		//si tiene algún error muestra mensaje, para esto la variable $permitirRegistro habrá cambiado a false en las comprobaciones, sino por defecto muestra solo el formulario.
		else{

			if(!$permitirRegistro && isset($_POST['verificador']))
				echo 'Algo no ha salido bien';
	?>		
			<form method="POST" action="#">
				<label for="usuario">Usuario: </label>
					<input type="text" name="usuario" value="Sergio"><br>
				<label for="pass">Contraseña: </label>
					<input type="password" name="pass" value="15@Hotmail"><br>
				<label for="pass">Confirmar contraseña: </label>
					<input type="password" name="confirpass" value="15@Hotmail"><br>
				<input type="hidden" name="verificador" value="1">
				<input type="submit" value="enviar">
			</form>

	<?php } ?>

</body>
</html>