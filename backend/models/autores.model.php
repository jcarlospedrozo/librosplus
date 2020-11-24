<?php

require_once "conexion.php";

class ModeloAutores{
    //mostrar categorias
    static public function mdlMostrarAutores($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY idAutor DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
        }
        $stmt->close();
		$stmt = null;
    }

    //Registrar administradores
    static public function mdlRegistroAutores($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreAutor) VALUES (:nombre)");

		$stmt->bindParam(":nombre", $datos["nombreAutor"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;
    }

    //Editar administrador
    static public function mdlEditarAutor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombreAutor = :nombre WHERE idAutor = :idAutor");

		$stmt->bindParam(":nombre", $datos["nombreAutor"], PDO::PARAM_STR);
		$stmt->bindParam(":idAutor", $datos["idAutor"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
    }

    //Validar existencia de libros en categoría
	static public function mdlValidarAutor($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt-> close();
		$stmt = null;
	}
    
    //Eliminar autor
	static public function mdlEliminarAutor($tabla, $id){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idAutor = :id");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

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