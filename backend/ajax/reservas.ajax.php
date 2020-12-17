<?php

require_once "../controllers/reservas.controller.php";
require_once "../models/reservas.model.php";

class AjaxReservas{

	//Mostrar Reservas

	public $idLibro;

	public function ajaxMostrarReservas(){

		$respuesta = ControladorReservas::ctrMostrarReservas("idLibro", $this->idLibro);

		echo json_encode($respuesta);

	}

	//Cambiar Reservas

	public $idReserva;
	public $fechaDesde;
	public $fechaHasta;

	public function ajaxCambiarReserva(){

		$datos = array("idReserva" => $this->idReserva,
					   "fechaDesde" => $this->fechaDesde,
					   "fechaHasta" => $this->fechaHasta);

		$respuesta = ControladorReservas::ctrCambiarReserva($datos);

		echo $respuesta;

	}


}

//Mostrar Reservas

if(isset($_POST["idLibro"])){

	$editar = new AjaxReservas();
	$editar -> idLibro = $_POST["idLibro"];
	$editar -> ajaxMostrarReservas();

}

//Cambiar Reservas

if(isset($_POST["idReserva"])){

	$guardar = new AjaxReservas();
	$guardar -> idReserva = $_POST["idReserva"];
	$guardar -> fechaDesde = $_POST["fechaDesde"];
	$guardar -> fechaHasta = $_POST["fechaHasta"];
	$guardar -> ajaxCambiarReserva();

}