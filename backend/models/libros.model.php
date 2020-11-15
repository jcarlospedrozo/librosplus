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

	//nuevo libro
	static public function mdlNuevoLibro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreLibro, descripcionLibro, fotoLibro, idCategoria) VALUES (:tipo_h, :estilo, :galeria, :video, :recorrido_virtual, :descripcion_h)");

		$stmt->bindParam(":tipo_h", $datos["tipo_h"], PDO::PARAM_STR);
		$stmt->bindParam(":estilo", $datos["estilo"], PDO::PARAM_STR);
		$stmt->bindParam(":galeria", $datos["galeria"], PDO::PARAM_STR);
		$stmt->bindParam(":video", $datos["video"], PDO::PARAM_STR);
		$stmt->bindParam(":recorrido_virtual", $datos["recorrido_virtual"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_h", $datos["descripcion_h"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}
}