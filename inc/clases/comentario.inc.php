<?php

class Comentario{

	private $idComentario;
	private $idEntrada;
	private $fechaHora;
	private $autor;
	private $texto;

	//constructor con todos los atributos
	public function __construct($idComentario, $idEntrada, $fechaHora, $autor, $texto){

		$this->idComentario = $idComentario;
		$this->idEntrada = $idEntrada;
		$this->fechaHora = $fechaHora;
		$this->autor = $autor;
		$this->texto = $texto;

	}

	//métodos mágicos set y get
	public function __set($atributo, $valor){

		$this->$atributo = $valor;

	}

	public function __get($atributo){

		return $this->$atributo;

	}

}

?>