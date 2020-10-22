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

	static public function mdlGuardarReserva($tabla, $datos)
	{
		// $connection = Conexion::conectar();
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idLibro, idUsuario, pagoReserva, transaccionReserva, codigoReserva, fechaDespacho, fechaDevolucion) VALUES (:idLibro, :idUsuario, :pagoReserva, :transaccionReserva, :codigoReserva, :fechaDespacho, :fechaDevolucion)");

		$stmt->bindParam(":idLibro", $datos["idLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pagoReserva", $datos["pagoReserva"], PDO::PARAM_STR);
		$stmt->bindParam(":transaccionReserva", $datos["transaccionReserva"], PDO::PARAM_STR);
		$stmt->bindParam(":codigoReserva", $datos["codigoReserva"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaDespacho", $datos["fechaDespacho"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaDevolucion", $datos["fechaDevolucion"], PDO::PARAM_STR);

		if($stmt->execute()){
			// $id = $connection->lastInsertId();
			// return $id;
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarReservasUsuario($tabla, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idUsuario = :idUsuario ORDER BY idReserva DESC LIMIT 5");
		$stmt -> bindParam(":idUsuario", $valor, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}
}