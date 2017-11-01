<?php 

	require_once('../inc/clases/bd.inc.php'); 

	$meses = ['00' => 'Seleccione un mes', '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
	$mes = "";
	$ano = 2017;
	$busqueda = "";

	/* 
		2-Verificacion del filtro de entradas
	*/
	$entradas = $bdd->mostrarEntradas();
	$contenido = "";
	/* 
		2.1-Si llega mes o año y busqueda entra en el if
	*/
	if(isset($_GET['verificar']) && $_GET['verificar'] == 1 && (isset($_GET['mes']) || isset($_GET['ano'])) && isset($_GET['busqueda'])){

			//2.1.1 Si el usuario ha elegido algún més se guarda en su variable, año y busqueda se guardan siempre
			if($_GET['mes'] != 0)
				$mes = $meses[$_GET['mes']];

			$ano = $_GET['ano'];
			$busqueda = $_GET['busqueda'];
		/* 
			2.1.2-Si mes y año están vacíos o
					mes tiene contenido y año vacio o
						búsqueda está vacío, se muestra error.
		*/
		if(($_GET['mes'] == null && $_GET['ano'] == null) || ($_GET['mes'] != null && $_GET['ano'] == null))
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.3-Si la variable contenido está vacía y
					el mes tiene contenido y no cumple con los requisitos o
						el año tiene contenido y no cumple con los requisitos, muestra error.
		*/
		if($contenido == "" && ($_GET['mes'] != null && !preg_match('/^[0-9]{2}$/', $_GET['mes']) && $_GET['mes'] < 0 || $_GET['mes'] > 12) || ($_GET['ano'] != null && !preg_match('/^[0-9]{4}$/', $_GET['ano'])))
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.4-Si la variable contenido está vacía y
					la búsqueda tiene contenido pero contiene html
						muestra error.
		*/
		if($contenido == "" && ($_GET['busqueda'] != null && strcmp($_GET['busqueda'], strip_tags($_GET['busqueda'])) != 0))
			$contenido = 'Filtrado incorrecto';
		/* 
			2.1.5-Si la variable contenido está vacía, significa que ha pasado todos los filtros, así que se muestran las variables
		*/	
		if($contenido == ""){

			$contenido	=	'Mes: ' .$mes. '<br>
				  			 Año: ' .$ano. '<br>
				  			 Búsqueda: ' .$busqueda;

		}
	}
	else{

		//Listado de las entradas

		$contenido 	=	'<ul>';

		foreach ($entradas as $entrada){

			$contenido 	.=	'<li>' .$entrada->titulo. '
								<a href="editarentradas.php?idEntrada=' .$entrada->idEntrada. '">Editar</a>
								<a href="editarentradas.php?idEntrada=' .$entrada->idEntrada. '">Eliminar</a>
				  			</li>';
		}

		$contenido 	.=	'</ul>';
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listar Entradas</title>
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div id="contenedor">
		<?php 
			require_once('../inc/header.inc.php'); 
		?>
		
		<h2>Listar Entradas</h2>

		<a href="editarentradas.php">Crear una entrada</a><br>
		
		<h3>Filtrar entradas</h3>

		<i>*Recuerda, el año tiene cuatro cifras y la búsqueda no debe contener HTML.</i><br><br>
		<section id="contenido">
		<form method="GET" action="#">
			<label for="mes">Mes: </label>
				<select name="mes">
					<?php
						//se muestran los meses en un select
						foreach($meses as $numeroMes => $nombreMes){
							if(strcmp($nombreMes, $mes) == 0)
								echo '<option value="' .$numeroMes. '" selected>' .$nombreMes. '</option>';
							else
								echo '<option value="' .$numeroMes. '">' .$nombreMes. '</option>';
						}
					?>
				</select>
			<label for="ano">Año: </label>
				<input type="number" name="ano" placeholder="2017" value="<?= $ano ?>">
			<label for="busqueda">Búsqueda: </label>
				<input type="text" name="busqueda" placeholder="Introduce algo..." value="<?= $busqueda ?>">
				<input type="hidden" name="verificar" value="1">
				<input type="submit">
		</form><br>
		</section>	
		<section>
			<?= $contenido ?>
		</section>
	</div>

</body>
</html>