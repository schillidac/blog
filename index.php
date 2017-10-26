<?php 

	require_once('inc/clases/bd.inc.php'); 

		$entradas = $bdd->mostrarEntradas();
		$contenido = "";

		/* 
			1-Compruebo si llega el id de la entrada
		*/
		if(isset($_GET['idEntrada'])){

			/* 
				1.1-Compruebo si el id de la entrada tiene el formato correcto
			*/
			if(!preg_match('/[0-9]/', $_GET['idEntrada'])){
				header('location: /');
				exit();
			}
			/* 
				1.2-Recorro el array de entradas y la que coincida con el id que entra por get la muestro
			*/	
			foreach ($entradas as $entrada){

				if($entrada->idEntrada == $_GET['idEntrada']){

					$contenido 	.= 	'<article>
										<h2>' .$entrada->titulo .'</h2>
										<div> Creado por ' .$entrada->usuario. ' en la fecha ' .$entrada->fechaHora. '</div>
										<p>' .$entrada->cuerpo. '</p>
										<a href="/addcomentario.php?idEntrada=' .$entrada->idEntrada. '">Añadir comentario</a>
										<section id="comentarios">
											AQUÍ IRÁN LOS COMENTARIOS MEDIANTE CONSULTAS
										</section>
						 		   	</article>';

				}
			}
		}
		/* 
			2-Compruebo si llega el mes o el año
		*/
		else if(isset($_GET['mes']) || isset($_GET['ano'])){
			/* 
				2.1-Compruebo si el mes y el añó tienen el formato correcto, si no lo tienen redirecciono al index
			*/
			if((isset($_GET['mes']) && !preg_match('/^[0-9]{2}$/', $_GET['mes'])) || (isset($_GET['ano']) && !preg_match('/^[0-9]{4}$/', $_GET['ano']))){
				header('location: /');
				exit();
			}
			/* 
				2.2-Si el año y el mes tienen el formato correcto muestro las entradas correspondientes, con todas sus propiedades
			*/
			foreach ($entradas as $entrada){

				$fecha = explode("/" , $entrada->fechaHora);

				if((isset($_GET['mes']) && $fecha[1] == $_GET['mes'] && isset($_GET['ano']) && $fecha[2] == $_GET['ano']) ||
				   (isset($_GET['ano']) && $fecha[2] == $_GET['ano'] && !isset($_GET['mes']))){

					$contenido 	.= 	'<article>
										<h3><a href="/?idEntrada=' .$entrada->idEntrada. '">' .$entrada->titulo .'</a></h3>
										<div> ' .$entrada->fechaHora. ' </div>
										<p>' .$entrada->cuerpo. '</p>
										<a href="/?idEntrada=' .$entrada->idEntrada. '">Leer más</a>
										<a href="/?idEntrada=' .$entrada->idEntrada. '#comentarios"> ' .count($entrada->comentarios). ' comentarios</a>
									 </article>';

				}
			}
		}
		/* 
			3-Si no llega nada muestro las tres últimas entradas
		*/
		else {
			// 3.1-Le doy la vuelta al array y cuando el indice es superior a 2 (tercera entrada), hago un break
			// 3.2-Tanto con el array reverse como sin él el orden del indice es de 0,1,2,3...
			foreach (array_reverse($entradas) as $indice=>$entrada) {

				if($indice > 2)
					break;

				$contenido 	.=	'<article>
									<h3><a href="/?idEntrada=' .$entrada->idEntrada. '">' .$entrada->titulo .'</a></h3>
									<div> ' .$entrada->fechaHora. ' </div>
									<p>' .$entrada->cuerpo. '</p>
									<a href="/?idEntrada=' .$entrada->idEntrada. '">Leer más</a>
									<a href="/?idEntrada=' .$entrada->idEntrada. '#comentarios"> ' .count($entrada->comentarios). ' comentarios</a>	
					 			</article>';				
			}	
		}

?>

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

	<section>
		<?= $contenido ?>
	</section>
	
</body>
</html>