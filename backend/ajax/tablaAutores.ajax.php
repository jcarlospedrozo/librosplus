<?php

include_once "../controllers/autores.controller.php";
include_once "../models/autores.model.php";

class TablaAutor{

	/*=============================================
	Editar Administrador
	=============================================*/	

	public $idAutor;

	public function mostrarTabla(){

		// $item = "id";
		// $valor = $this->idAdministrador;

		$respuesta = ControladorAutores::ctrMostrarAutores(null, null);

		if (count($respuesta) == 0) {
			$datosJson = '{"data":[]}';
			echo $datosJson;
			return;
		}

		$datosJson = '{
		"data":[';
		foreach ($respuesta as $key => $value) {

			$acciones = "<button type='button' class='btn btn-warning btn-sm editarAutor' data-toggle='modal' data-target='#editarAutor' idAutor='".$value["idAutor"]."'><i class='fas fa-pen text-white'></i></button> <button type='button' class='btn btn-danger  btn-sm eliminarAutor' idAutor='".$value["idAutor"]."'><i class='fas fa-trash-alt'></i></button>";
			$datosJson .='[
				"'.($key + 1).'",
				"'.$value["nombreAutor"].'",
				"'.$acciones.'"
			],';

		}
		$datosJson = substr($datosJson, 0, -1);
		$datosJson .= ']}';
        echo $datosJson;
	}

	/*=============================================
	Activar o desactivar administrador
	=============================================*/	

	// public $idAdmin;
	// public $estadoAdmin;

	// public function ajaxActivarAdministrador(){

	// 	$tabla = "administradores";

	// 	$item1 = "id";
	// 	$valor1 = $this->idAdmin;

	// 	$item2 = "estado";
	// 	$valor2 = $this->estadoAdmin;

	// 	$respuesta = ModeloAdministradores::mdlActualizarAdministrador($tabla, $item1, $valor1, $item2, $valor2);

	// 	echo $respuesta;

	// }

	// /*=============================================
	// Eliminar Administrador
	// =============================================*/	

	// public $idEliminar;

	// public function ajaxEliminarAdministrador(){

	// 	$respuesta = ControladorAdministradores::ctrEliminarAdministrador($this->idEliminar);

	// 	echo $respuesta;

	// }
}

$tabla = new TablaAutor();
$tabla->mostrarTabla();