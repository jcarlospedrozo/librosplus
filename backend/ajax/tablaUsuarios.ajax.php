<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class TablaUsuarios{

	/*=============================================
	Tabla Categorías
	=============================================*/ 

	public function mostrarTabla(){

		$usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);
		// echo '<pre>'; print_r($usuarios); echo '</pre>';
		if(count($usuarios)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

		 }
		 

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($usuarios as $key => $value) {

			if($value["fotoUsuario"] != ""){

				$foto = "<img src='".$value["fotoUsuario"]."' class='rounded-circle' width='50px'>";

			}else{

				$foto = "<img src='views/img/usuarios/default/default.png' class='rounded-circle' width='50px'>";
			}

			/*=============================================
			CANTIDAD DE RESERVAS
			=============================================*/	

			$reservas = "<div class='sumarReservas' idusuario='".$value["idUsuario"]."'>0</div>";
			
			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$foto.'",
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

