<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=noooooooooooo;dbname=laaaaaaaaaaa",
							"policiaaaaaaaaaaaaaa",
							"hahahahahahahahahas");

		$link->exec("set names utf8");

		return $link;

	}

}
