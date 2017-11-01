<?php 

	require_once('inc/clases/bd.inc.php'); 

	$user = '';
	$password = '';
	$confirmPass = '';

	//1. Variable que se encarga de validar el registro
	$permitirRegistro = true;

	/* 
		2-Se comprueba que la variable verificador llega y cumple con los requisitos
	*/
	if(isset($_POST['verificador']) && $_POST['verificador'] == 1){
		/* 
			2.1-Se comprueba que el usuario llega y cumple con los requisitos
			 Se permiten letras minúsculas, números, espacios, guiones, barras bajas, asteriscos y arrobas, además el nombre debe tener entre 3 y 15 caracteres

			 Se interpreta de esta forma ya que diferenciamos entre nombre de usuario y nombre real, en este caso el nombre de usuario es permisivo con los caracteres entrantes
		*/												
		if(!isset($_POST['usuario'])  || !preg_match('/^[a-z0-9\s-_*@]{3,15}$/', $_POST['usuario']))
			$permitirRegistro = false;
		/* 
			2.2-Se comprueba que la contraseña llega y cumple con los requisitos
		*/
		if(!isset($_POST['pass']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}/', $_POST['pass']))
			$permitirRegistro = false;
		/* 
			2.3-Se comprueba que la contraseña de confirmación es igual a la original
		*/	
		if(!isset($_POST['confirpass']) || strcmp($_POST['pass'], $_POST['confirpass']) != 0)
			$permitirRegistro = false;

		/* 
			2.4-Si la variable permitir registro es igual a true se comprueba si el usuario ya existe
		*/	
		if($permitirRegistro){
			
			$usuarios = $bdd->mostrarUsuarios();

			foreach ($usuarios as $usuario) {
				/* 
					2.4.1-Si el usuario existe la variable permitir registro pasa a false;
				*/
				if(strcmp($usuario->user, strtolower($_POST['usuario'])) == 0)
					$permitirRegistro = false;

			}
		}

		/* 
			2.4-Se guardan las variables del formulario para mostrarlas en los values en caso de un registro incorrecto
		*/
		$user = $_POST['usuario'];
		$password = $_POST['pass'];
		$confirmPass = $_POST['confirpass'];
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
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
					<input type="text" name="usuario" value="<?= $user ?>"><br>
				<label for="pass">Contraseña: </label>
					<input type="password" name="pass" value="<?= $password ?>"><br>
				<label for="pass">Confirmar contraseña: </label>
					<input type="password" name="confirpass" value="<?= $confirmPass ?>"><br>
				<input type="hidden" name="verificador" value="1">
				<input type="reset">
				<input type="submit">
			</form>
			
		</section><!--

	 --><?php } 
			require_once('inc/aside.inc.php');
		?>
	</div>

</body>
</html>