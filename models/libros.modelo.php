<?php
require_once "conexion.php";

Class ModeloLibros{
	static public function mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.nombreCategoria, $tabla2.idLibro, $tabla2.nombreLibro, $tabla3.nombreAutor FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria INNER JOIN $tabla3 ON $tabla3.idAutor = $tabla2.idAutor WHERE nombreCategoria = :ruta");
		
		$stmt->bindParam(":ruta", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}