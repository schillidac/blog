<?php 

	require_once('inc/clases/bd.inc.php'); 

//print_r($bdd->entradas);
		$entradas = $bdd->mostrarEntradas();
		$contenido = "";
		//llega el id de la entrada
		if(isset($_GET['idEntrada'])){

			//COMPRUEBO SI EL ID DE LA ENTRADA ES UN NÚMERO
			if(!preg_match('/[0-9]/', $_GET['idEntrada'])){
				header('location: /');
				exit();
			}
				
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


						 //------->FALTA AÑADIR LOS COMENTARIOS
				}
			}
		}
		else if(isset($_GET['mes']) || isset($_GET['ano'])){

			//COMPRUEBO QUE EL MES Y EL AÑO TIENEN EL FORMATO CORRECTO
			if((isset($_GET['mes']) && !preg_match('/^[0-9]{2}$/', $_GET['mes'])) || (isset($_GET['ano']) && !preg_match('/^[0-9]{4}$/', $_GET['ano']))){
				header('location: /');
				exit();
			}

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
		//no llega nada
		else {
			//le doy la vuelta al array y cuando el indice es superior a 2 (tercera entrada), hago un break
			//tanto con el array reverse como sin él el orden del indice es de 0,1,2,3...
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