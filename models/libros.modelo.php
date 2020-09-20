<?php
require_once "conexion.php";

Class ModeloLibros{
	static public function mdlMostrarLibros($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}