<?php require_once('inc/clases/bd.inc.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
</head>
<body>
	<?php 
		require_once('inc/header.inc.php'); 
		require_once('inc/buscar.inc.php');
		require_once('inc/aside.inc.php');
	?>

	<?php
//print_r($bdd->entradas);
		$entradas = $bdd->mostrarEntradas();
		//llega el id de la entrada
		if(isset($_GET['idEntrada']) && $_GET['idEntrada']!='' ){

			foreach ($entradas as $entrada){

				if($entrada->idEntrada == $_GET['idEntrada']){

					echo '<article>
							<h2>' .$entrada->titulo .'</h2>
							<div> Creado por ' .$entrada->usuario. ' en la fecha ' .$entrada->fechaHora. '</div>
							<p>' .$entrada->cuerpo. '</p>
							<a href="/addcomentario.php?idEntrada=' .$entrada->idEntrada. '">Añadir comentario</a>
						 </article>';


						 //FALTA AÑADIR LOS COMENTARIOS
				}
			}
		}
		else if(isset($_GET['mes']) && isset($_GET['ano'])){

			//FALTA MOSTRAR SOLO POR AÑO

			foreach ($entradas as $entrada){

				$fecha = explode("/" , $entrada->fechaHora);

				if($fecha[1] == $_GET['mes'] && $fecha[2] == $_GET['ano']){

					echo '<article>
								<h3><a href="/?idEntrada=' .$entrada->idEntrada. '">' .$entrada->titulo .'</a></h3>
								<div> ' .$entrada->fechaHora. ' </div>
								<p>' .$entrada->cuerpo. '</p>
								<a href="/?idEntrada=' .$entrada->idEntrada. '">Leer más</a>
						 </article>';

				}
			}
		}
		//no llega nada
		else {

			for ($i = count($entradas)-1; $i>=0; $i--){

				echo '<article>
							<h3><a href="/?idEntrada=' .$entradas[$i]->idEntrada. '">' .$entradas[$i]->titulo .'</a></h3>
							<div> ' .$entradas[$i]->fechaHora. ' </div>
							<p>' .$entradas[$i]->cuerpo. '</p>
							<a href="/?idEntrada=' .$entradas[$i]->idEntrada. '">Leer más</a>
					 </article>';
			}
			
		}

	?>
	
</body>
</html>