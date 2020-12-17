<?php

require_once "conexion.php";

class ModeloLibros{
    //Mostrar libros
    static public function mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor){
		if($valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria INNER JOIN $tabla3 ON $tabla3.idAutor = $tabla2.idAutor WHERE idLibro = :idLibro");
			$stmt -> bindParam(":idLibro", $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();
		}
		else{
			$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.idCategoria = $tabla2.idCategoria INNER JOIN $tabla3 ON $tabla3.idAutor = $tabla2.idAutor ORDER BY $tabla2.idLibro DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;
	}

	//nuevo libro
	static public function mdlNuevoLibro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreLibro, descripcionLibro, fotoLibro,  precioLibro, idCategoria, idAutor) VALUES (:nombreLibro, :descripcionLibro, :fotoLibro, :precioLibro,  :idCategoria, :idAutor)");

		$stmt->bindParam(":nombreLibro", $datos["nombreLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcionLibro", $datos["descripcionLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":fotoLibro", $datos["fotoLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":precioLibro", $datos["precioLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":idAutor", $datos["idAutor"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditarLibro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombreLibro = :nombreLibro, descripcionLibro = :descripcionLibro, fotoLibro = :fotoLibro, precioLibro = :precioLibro, idCategoria = :idCategoria, idAutor = :idAutor WHERE idLibro = :idLibro");

		$stmt->bindParam(":idLibro", $datos["idLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreLibro", $datos["nombreLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcionLibro", $datos["descripcionLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":fotoLibro", $datos["fotoLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":precioLibro", $datos["precioLibro"], PDO::PARAM_STR);
		$stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":idAutor", $datos["idAutor"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	//Eliminar habitacion

	static public function mdlEliminarLibro($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idLibro = :idLibro");

		$stmt -> bindParam(":idLibro", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();

		$stmt = null;

	}
}