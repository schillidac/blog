<?php 

	require_once('inc/clases/bd.inc.php'); 

	$permitirRegistro = true;

	//comprobación de las variables de entrada para validar el formulario

	if(isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['confirpass'])){

		if(!preg_match('/^([a-zñáéíóúA-ZÑÁÉÍÓÚ0-9\s]*)+$/', $_POST['usuario']))
			$permitirRegistro = false;

		if(!preg_match('/([A-Z]{1}[a-z]{1}[0-9]{1})/', $_POST['pass']))
			$permitirRegistro = false;

		if(!strcmp($_POST['pass'], $_POST['confirpass']))
			$permitirRegistro = false;

			//comprobar que no existen
			$usuarios = $bdd->mostrarUsuarios();
			
			foreach ($usuarios as $usuario) {

				if($usuario->user == $_POST['usuario'])
					$permitirRegistro = false;

			}

			if($_POST['pass'] != $_POST['confirpass'] && $permitirRegistro == true)
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
		if($permitirRegistro == true && isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['confirpass'])){
			echo 'Registro realizado con éxito';
		}
		//si tiene algún error muestra mensaje, para esto la variable $permitirRegistro habrá cambiado a false en las comprobaciones, sino por defecto muestra solo el formulario.
		else{

			if($permitirRegistro == false)
				echo 'Algo no ha salido bien';
	?>		
			<form method="POST" action="#">
				<label for="usuario">Usuario: </label><input type="text" name="usuario"><br>
				<label for="pass">Contraseña: </label><input type="password" name="pass"><br>
				<label for="pass">Confirmar contraseña: </label><input type="password" name="confirpass"><br>
				<input type="submit" value="enviar">
			</form>

	<?php } ?>

</body>
</html>