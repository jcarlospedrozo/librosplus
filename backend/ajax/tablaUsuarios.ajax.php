<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class TablaUsuarios{

	/*=============================================
	Tabla Categorías
	=============================================*/ 

	public function mostrarTabla(){

		$usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

		if(count($usuarios)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($usuarios as $key => $value) {

			/*=============================================
			CANTIDAD DE RESERVAS
			=============================================*/	

			$reservas = "<div class='sumarReservas' idUsuario='".$value["idUsuario"]."'>0</div>";
			
			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["nombreUsuario"].'",
						"'.$value["emailUsuario"].'",
						"'.$reservas.'"
					
				],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
Tabla Usuarios
=============================================*/ 

$tabla = new TablaUsuarios();
$tabla -> mostrarTabla();

