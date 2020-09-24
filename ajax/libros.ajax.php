<?php
require_once "../controllers/autores.controller.php";
require_once "../models/autores.modelo.php";


class AjaxAutores{
	public $ruta;
	public function ajaxTraerAutor(){
		$valor = $this->ruta;
		$respuesta = ControladorAutores::ctrMostrarAutores($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["ruta"])){
	$ruta = new AjaxAutores();
	$ruta->ruta = $_POST["ruta"];
	$ruta->ajaxTraerAutor();
}

