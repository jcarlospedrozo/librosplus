<?php
require_once "conexion.php";

Class ModeloDetalleLibro{
	static public function mdlMostrarDetalleLibro($tabla1, $tabla2, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria where $tabla1.idLibro = :ruta");
		$stmt->bindParam(":ruta", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}