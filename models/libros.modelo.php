<?php
require_once "conexion.php";

Class ModeloLibros{
	static public function mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria INNER JOIN $tabla3 ON $tabla3.idAutor = $tabla2.idAutor WHERE rutaCategoria = :ruta");
		
		$stmt->bindParam(":ruta", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarLibro($tabla, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idLibro = :idLibro");
		$stmt -> bindParam(":idLibro", $valor, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}
}