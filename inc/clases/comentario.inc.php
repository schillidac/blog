<?php

class Comentario{

	private $idComentario;
	private $idEntrada;
	private $fechaHora;
	private $autor;
	private $texto;

	public function __construct($idComentario, $idEntrada, $fechaHora, $autor, $texto){

		$this->idComentario = $idComentario;
		$this->idEntrada = $idEntrada;
		$this->fechaHora = $fechaHora;
		$this->autor = $autor;
		$this->texto = $texto;

	}

	public function __set($atributo, $valor){

		$this->$atributo = $valor;

	}

	public function __get($atributo){

		return $this->$atributo;

	}

}

?>