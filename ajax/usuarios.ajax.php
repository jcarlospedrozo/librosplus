<?php
require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.modelo.php";

class AjaxUsuarios{

	public $validarEmail;

	public function ajaxValidarEmail(){

		$item = "emailUsuario";
		$valor = $this->validarEmail;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

		echo json_encode($respuesta);

	}
	
	public $email;
	public $nombre;
	public $foto;

	public function ajaxRegistroFacebook(){
		$datos = array("nombreUsuario"=>$this->nombre,
					   "emailUsuario"=>$this->email,
					   "contrasenaUsuario"=>"null",
					   "fotoUsuario"=>$this->foto,
					   "modoUsuario"=>"facebook",
					   "verificacion"=>1,
					   "emailEncriptado"=>"null");
		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);
		echo $respuesta;
	}
}

if(isset($_POST["validarEmail"])){
	$valEmail = new AjaxUsuarios();
	$valEmail -> validarEmail = $_POST["validarEmail"];
	$valEmail -> ajaxValidarEmail();
}

if(isset($_POST["emailUsuario"])){
	$regFacebook = new AjaxUsuarios();
	$regFacebook -> email = $_POST["emailUsuario"];
	$regFacebook -> nombre = $_POST["nombreUsuario"];
	$regFacebook -> foto = $_POST["fotoUsuario"];
	$regFacebook -> ajaxRegistroFacebook();
}
?>