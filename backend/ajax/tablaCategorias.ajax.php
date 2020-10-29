<?php

include_once "../controllers/categorias.controller.php";
include_once "../models/categorias.model.php";

class TablaAdmin{
    //tabla categorias
	public function mostrarTabla(){

		$categorias = ControladorCategorias::ctrMostrarCategorias(null, null);

		if (count($categorias) == 0) {
			$datosJson = '{"data":[]}';
			echo $datosJson;
			return;
		}

		$datosJson = '{
		"data":[';
		foreach ($categorias as $key => $value) {

			$imagen = "<img src='".$value["imagenCategoria"]."' class='img-fluid'>";

            $acciones = "<button type='button' class='btn btn-warning btn-sm editarCategoria' data-toggle='modal' data-target='#editarCategoria' idCategoria='".$value["idCategoria"]."'><i class='fas fa-pencil-alt text-white'></i></button> <button type='button' class='btn btn-danger btn-sm eliminarCategoria' idCategoria='".$value["idCategoria"]."' imgCategoria='".$value["imagenCategoria"]."' nombreCategoria='".$value["nombreCategoria"]."'><i class='fas fa-trash-alt'></i></button>";
            
			$datosJson .='[
				"'.($key + 1).'",
                "'.$value["rutaCategoria"].'",
                "'.$value["nombreCategoria"].'",
                "'.$imagen.'",
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