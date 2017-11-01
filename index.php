<?php 

	require_once('inc/clases/bd.inc.php'); 

		$entradas = $bdd->mostrarEntradas();
		/*
			Esta variable se usará para almacenar el contenido que se mostrará en base a los tres comportamientos de la página.
			Se ha usado este método porque al haber varias posibilidades, se cree conveniente tener separado el código php del html en la medida de lo posible.
		*/
		$contenido = '';
		//Variable que se encarga de almacenar el titulo de la página según su comportamiento
		$tituloPagina = 'Entradas recientes';
		//Variable que se encarga de verificar si se debe mostrar el titulo como en un h2 o no, en el caso de mostrar una entrada, como el titulo de la entrada ya es un h2 no se mostrará de nuevo
		$mostrarTitulo = false;

		/* 
			1-Se comprueba si llega el id de la entrada
		*/
		if(isset($_GET['idEntrada'])){

			/* 
				1.1-Se comprueba si el id de la entrada tiene el formato correcto
			*/
			if(!preg_match('/[0-9]/', $_GET['idEntrada'])){
				header('location: /');
				exit();
			}
			/* 
				1.2-Se recorre el array de entradas, la entrada que coincida con el id que entra por get se muestra
			*/	
			foreach ($entradas as $entrada){

				if($entrada->idEntrada == $_GET['idEntrada']){

					$contenido 	.= 	'<article class="articulo-home">
										<h2>' .$entrada->titulo .'</h2>
										<div> Creado por ' .$entrada->usuario. ' en la fecha ' .$entrada->fechaHora. '</div>
										<p>' .$entrada->cuerpo. '</p>
										<a href="/addcomentario.php?idEntrada=' .$entrada->idEntrada. '">Añadir comentario</a>
										<section id="comentarios">
											AQUÍ IRÁN LOS COMENTARIOS MEDIANTE CONSULTAS
										</section>
						 		   	</article>';

					$tituloPagina = $entrada->titulo;

				}
			}
		}
		/* 
			2-Se comprueba si llega el mes o el año
		*/
		else if(isset($_GET['mes']) || isset($_GET['ano'])){
			/* 
				2.1-Se comprueba si el mes y el añó tienen el formato correcto, si no lo tienen se redirecciona al index
			*/
			if((isset($_GET['mes']) && !preg_match('/^[0-9]{2}$/', $_GET['mes'])) || (isset($_GET['ano']) && !preg_match('/^[0-9]{4}$/', $_GET['ano']))){
				header('location: /');
				exit();
			}
			/* 
				2.2-Para mostrar el título de la página, se verifica si llega mes para mostrarlo dentro de él
			*/
			if(isset($_GET['mes']))
				$tituloPagina = 'Archivo de entradas: ' .$_GET['mes']. ' ' .$_GET['ano'];
			else
				$tituloPagina = 'Archivo de entradas: ' .$_GET['ano'];

			/* 
				2.3-Si el año y el mes tienen el formato correcto se muestran las entradas correspondientes, con todas sus propiedades
			*/
			foreach ($entradas as $entrada){

				$fecha = explode("/" , $entrada->fechaHora);

				if((isset($_GET['mes']) && $fecha[1] == $_GET['mes'] && isset($_GET['ano']) && $fecha[2] == $_GET['ano']) ||
				   (isset($_GET['ano']) && $fecha[2] == $_GET['ano'] && !isset($_GET['mes']))){

					$contenido 	.= 	'<article class="articulo-home">
										<h3><a href="/?idEntrada=' .$entrada->idEntrada. '">' .$entrada->titulo .'</a></h3>
										<div> ' .$entrada->fechaHora. ' </div>
										<p>' .$entrada->cuerpo. '</p>
										<a href="/?idEntrada=' .$entrada->idEntrada. '">Leer más</a>
										<a href="/?idEntrada=' .$entrada->idEntrada. '#comentarios"> ' .count($entrada->comentarios). ' comentarios</a>
									 </article>';



				}
			}
			$mostrarTitulo = true;
		}
		/* 
			3-Si no llega nada se muestran las tres últimas entradas
		*/
		else {
			// 3.1-Se le da la vuelta al array y cuando el indice es superior a 2 (tercera entrada), se hace un break para salir del foreach
			// 3.2-Tanto con el array reverse como sin él el orden del indice es de 0,1,2,3...

			foreach (array_reverse($entradas) as $indice=>$entrada) {

				if($indice > 2)
					break;

				$contenido 	.=	'<article class="articulo-home">
									<h3><a href="/?idEntrada=' .$entrada->idEntrada. '">' .$entrada->titulo .'</a></h3>
									<div> ' .$entrada->fechaHora. ' </div>
									<p>' .$entrada->cuerpo. '</p>
									<a href="/?idEntrada=' .$entrada->idEntrada. '">Leer más</a>
									<a href="/?idEntrada=' .$entrada->idEntrada. '#comentarios"> ' .count($entrada->comentarios). ' comentarios</a>	
					 			</article>';				
			}
			$mostrarTitulo = true;	
		}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $tituloPagina ?></title>
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
			<?php
				if($mostrarTitulo)
					echo '<h2>' .$tituloPagina. '</h2>';

				echo $contenido; 
			?>
		</section><!--
		
	 --><?php
			require_once('inc/aside.inc.php');
		?>
	</div>	
</body>
</html>