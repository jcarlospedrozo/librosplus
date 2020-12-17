<?php

require_once "../controllers/reservas.controller.php";
require_once "../models/reservas.model.php";

class AjaxUsuarios{

	/*=============================================
	Sumar reservas de usuarios
	=============================================*/	

	public $idUsuarioR;

	public function ajaxSumarReservas(){

		$respuesta = ControladorReservas::ctrMostrarReservas("idUsuario", $this->idUsuarioR);

		echo json_encode($respuesta);

	}
}

/*=============================================
Sumar reservas de usuarios
=============================================*/	

if(isset($_POST["idUsuarioR"])){

	$sumaReserva = new AjaxUsuarios();
	$sumaReserva -> idUsuarioR = $_POST["idUsuarioR"];
	$sumaReserva -> ajaxSumarReservas();

}