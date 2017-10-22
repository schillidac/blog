<?php

require_once('comentario.inc.php');

class Entrada{

	private $idEntrada;
	private $fechaHora;
	private $titulo;
	private $cuerpo;
	private $usuario;
	private $comentarios;

	public function __construct($idEntrada, $fechaHora, $titulo, $cuerpo, $usuario){

		$this->idEntrada = $idEntrada;
		$this->fechaHora = $fechaHora;
		$this->titulo = $titulo;
		$this->cuerpo = $cuerpo;
		$this->usuario = $usuario;

	}

	public function __set($atributo, $valor){

		$this->$atributo = $valor;

	}

	public function __get($atributo){

		return $this->$atributo;

	}

	public function insertarComentario($idComentario, $idEntrada, $fechaHora, $autor, $texto){

		$this->comentarios[] = new Comentario($idComentario, $idEntrada, $fechaHora, $autor, $texto);

	}


}


?>