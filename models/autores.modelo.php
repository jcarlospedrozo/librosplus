<?php
require_once "conexion.php";

Class ModeloAutores{
	static public function mdlMostrarAutores($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}