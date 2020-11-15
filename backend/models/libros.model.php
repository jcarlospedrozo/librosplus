<?php

require_once "conexion.php";

class ModeloLibros{
    //Mostrar libros
    static public function mdlMostrarLibros($tabla1, $tabla2, $valor){
		if($valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria WHERE idLibro = :idLibro");
			$stmt -> bindParam(":idLibro", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria ORDER BY $tabla2.idLibro DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;
	}
}