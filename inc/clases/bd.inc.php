<?php

require_once('usuario.inc.php');
require_once('entrada.inc.php');

class Bd{

	private $entradas;
	private $usuarios;


	//Métodos para las entradas
	public function insertarEntrada($idEntrada, $fechaHora, $titulo, $cuerpo, $usuario){

		$this->entradas[] = new Entrada($idEntrada, $fechaHora, $titulo, $cuerpo, $usuario);

	}

	public function eliminarEntrada($idEntrada){

		$contador = 0;

		foreach($this->entradas as $entrada){

			if($entrada->idEntrada == $idEntrada){

				unset($this->entradas[$contador]);
				$this->entradas = array_values($this->entradas);

			}

			$contador++;

		}
		
	}

	public function mostrarEntradas(){

		return $this->entradas;

	}


	//metodos para los usuarios
	public function insertarUsuario($user, $nombre, $pass, $rol){

		$this->usuarios[] = new Usuario($user, $nombre, $pass, $rol);

	}

	public function eliminarUsuario($user){

		$contador = 0;

		foreach($usuarios as $usuario){

			if($usuario->user == $user){

				unset($this->usuarios[$contador]);
				$this->usuarios = array_values($this->usuarios);
				
			}

			$contador++;

		}
		
	}

	public function mostrarUsuarios(){

		return $this->usuarios;

	}

	//metodos para los comentarios
	public function insertarComentario($idComentario, $idEntrada, $fechaHora, $autor, $texto){

		foreach ($this->entradas as $entrada) {

			if($idEntrada == $entrada->idEntrada){

				$entrada->insertarComentario($idComentario, $idEntrada, $fechaHora, $autor, $texto );

			}
		}
	}	

}


//OBJETOS A CREAR
//base de datos
$bdd = new Bd();
//entradas
$bdd->insertarEntrada(1, '15:00 18/1/2017', 'Entrada 1', 'Este es un párrafo','sergio');
$bdd->insertarEntrada(2, '15:00 18/2/2016', 'Entrada 2', 'Este es un párrafo','sergio');
$bdd->insertarEntrada(3, '14:00 18/3/2017', 'Entrada 3', 'Este es un párrafo','sergio');


//comentarios
$bdd->insertarComentario(1, 1, '18:00 18-10-2017', 'Sergio', 'Esto es un comentario');
//$bdd->insertarComentario(2, 1, '18-10-2017 18:30', 'Jose', 'Esto es otro comentario');

//usuarios
$bdd->insertarUsuario('sergio', 'Sergio', '12345', 'admin');
$bdd->insertarUsuario('jose', 'Jose', '12345', 'suscriptor');




?>