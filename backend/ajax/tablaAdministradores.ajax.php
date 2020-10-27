<?php

include_once "../controllers/administradores.controller.php";
include_once "../models/administradores.model.php";

class TablaAdmin{

	/*=============================================
	Editar Administrador
	=============================================*/	

	public $idAdministrador;

	public function mostrarTabla(){

		// $item = "id";
		// $valor = $this->idAdministrador;

		$respuesta = ControladorAdministradores::ctrMostrarAdministradores(null, null);

		if (count($respuesta) == 0) {
			$datosJson = '{"data":[]}';
			echo $datosJson;
			return;
		}

		$datosJson = '{
		"data":[';
		foreach ($respuesta as $key => $value) {

			if($value["idAdministrador"] != 1){
				if ($value["estado"] == 0) {
					$estado = "<button class='btn btn-dark btn-sm btnActivar'estadoAdmin='1' idAdmin='".$value["idAdministrador"]."'>Desactivado</button>";
				} else {
					$estado = "<button class='btn btn-info btn-sm btnActivar'estadoAdmin='0' idAdmin='".$value["idAdministrador"]."'>Activado</button>";
				}
			} else {
				$estado = "<button class='btn btn-info btn-sm'>Activado</button>";
			}

			$acciones = "<button type='button' class='btn btn-warning btn-sm editarAdministrador' data-toggle='modal' data-target='#editarAdministrador' idAdministrador='".$value["idAdministrador"]."'><i class='fas fa-pen text-white'></i></button> <button type='button' class='btn btn-danger  btn-sm eliminarAdministrador' idAdministrador='".$value["idAdministrador"]."'><i class='fas fa-trash-alt'></i></button>";
			$datosJson .='[
				"'.($key + 1).'",
				"'.$value["nombre"].'",
				"'.$value["usuario"].'",
				"'.$value["perfil"].'",
				"'.$estado.'",
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

$tabla = new TablaAdmin();
$tabla->mostrarTabla();