<?php
require_once "conexion.php";

Class ModeloReservas{
	static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor){
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idLibro = $tabla2.idLibro INNER JOIN $tabla3 ON $tabla1.idCategoria = $tabla3.idCategoria WHERE $tabla1.idLibro = :idLibro");
        $stmt->bindParam(":idLibro", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarCodigoReserva($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigoReserva = :codigoReserva");
		$stmt -> bindParam(":codigoReserva", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}
}