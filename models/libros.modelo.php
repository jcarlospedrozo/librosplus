<?php
require_once "conexion.php";

Class ModeloLibros{
	static public function mdlMostrarLibros($tabla1, $tabla2, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.nombreCategoria, $tabla2.nombreLibro FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria WHERE nombreCategoria = :ruta");
		
		$stmt->bindParam(":ruta", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}