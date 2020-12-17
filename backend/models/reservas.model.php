<?php

require_once "conexion.php";

class ModeloReservas{

	/*=============================================
	MOSTRAR USUARIOS-RESERVAS CON INNER JOIN
	=============================================*/

	static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idUsuario = $tabla2.idUsuario INNER JOIN $tabla3 ON $tabla3.idLibro = $tabla2.idLibro WHERE $tabla2.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idUsuario = $tabla2.idUsuario INNER JOIN $tabla3 ON $tabla3.idLibro = $tabla2.idLibro ORDER BY $tabla2.idReserva DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	//Cambiar reserva

	static public function mdlCambiarReserva($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fechaDespacho = :fechaDespacho, fechaDevolucion = :fechaDevolucion WHERE idReserva = :idReserva");

		$stmt->bindParam(":fechaDespacho", $datos["fechaDesde"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaDevolucion", $datos["fechaHasta"], PDO::PARAM_STR);
		$stmt->bindParam(":idReserva", $datos["idReserva"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}
		$stmt-> close();
		$stmt = null;
	}
}