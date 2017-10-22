<?php

class Usuario{

	private $user;
	private $nombre;
	private $pass;
	private $rol;

	public function __construct($user, $nombre, $pass, $rol){

		$this->user = $user;
		$this->nombre = $nombre;
		$this->pass = $pass;
		$this->rol = $rol;

	}


	public function __set($atributo, $valor){

		$this->$atributo = $valor;

	}

	public function __get($atributo){

		return $this->$atributo;
	}


}


?>