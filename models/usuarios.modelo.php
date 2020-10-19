<?php
require_once "conexion.php";

Class ModeloUsuarios{
    static public function mdlRegistroUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreUsuario, emailUsuario, contrasenaUsuario, fotoUsuario, modoUsuario, verificacion, emailEncriptado) VALUES (:nombre, :email, :pass, :foto, :modo, :verificacion, :emailEncriptado)");

        $stmt->bindParam(":nombre", $datos["nombreUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["emailUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pass", $datos["contrasenaUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["fotoUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modoUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            //return "error";
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }
        
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarUsuario($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt-> close();
		$stmt = null;
	}

	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idUsuario = :idUsuario");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":idUsuario", $id, PDO::PARAM_INT);
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
?>