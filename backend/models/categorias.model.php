<?php

require_once "conexion.php";

class ModeloCategorias{
    //mostrar categorias
    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY idCategoria DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
        }
        $stmt->close();
		$stmt = null;
    }

	//registrar categoria
    static public function mdlRegistroCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rutaCategoria, nombreCategoria, imagenCategoria) VALUES (:ruta, :nombre, :imagen)");

		$stmt->bindParam(":ruta", $datos["rutaCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombreCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagenCategoria"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;
	}

	//editar categoria
	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rutaCategoria = :ruta, nombreCategoria = :nombre, imagenCategoria = :img WHERE idCategoria = :id");

		$stmt->bindParam(":ruta", $datos["rutaCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombreCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["imagenCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["idCategoria"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt-> close();
		$stmt = null;
	}

	//Validar existencia de libros en categoría
	static public function mdlValidarCategoria($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt-> close();
		$stmt = null;
	}

	//Eliminar Categoria
	static public function mdlEliminarCategoria($tabla, $id){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCategoria = :id");
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