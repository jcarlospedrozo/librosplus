<?php
require_once "conexion.php";

Class ModeloDetalleLibro{
	static public function mdlMostrarDetalleLibro($tabla, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where idLibro = :ruta");
		$stmt->bindParam(":ruta", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}