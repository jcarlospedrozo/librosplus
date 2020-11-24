<?php

require_once "../controllers/reservas.controller.php";
require_once "../models/reservas.model.php";

class TablaReservas{

	/*=============================================
	Tabla Reservas
	=============================================*/ 

	public function mostrarTabla(){

		$reservas = ControladorReservas::ctrMostrarReservas(null, null);

		if(count($reservas)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($reservas as $key => $value) {
			
			/*=============================================
			ACCIONES
			=============================================*/

			$fechaDesde = new DateTime($value["fechaDespacho"]);
			$fechaHasta = new DateTime($value["fechaDevolucion"]);
			$diff = $fechaDesde->diff($fechaHasta);
			$dias = $diff->days;

			if($value["fechaDespacho"] != "0000-00-00" && $value["fechaDevolucion"] != "0000-00-00"){

				$acciones = "<button class='btn btn-warning btn-sm editarReserva' data-toggle='modal' data-target='#editarReserva' idReserva='".$value["idReserva"]."' idLibro='".$value["idLibro"]."' fechaDesde='".$value["fechaDespacho"]."' fechaHasta='".$value["fechaDevolucion"]."' diasReserva='".$dias."'><i class='fas fa-pencil-alt text-white'></i></button> <button class='btn btn-danger btn-sm eliminarReserva' idReserva='".$value["idReserva"]."'><i class='fas fa-trash-alt'></i></button>";	

			}else{

				$acciones = "<button class='btn btn-dark btn-sm'>Cancelada</button>";	
			}


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["codigoReserva"].'",
						"'.$value["nombreUsuario"].'",
						"$ '.number_format($value["pagoReserva"],  2, ",", ".").'",
						"'.$value["transaccionReserva"].'",
						"'.$value["fechaDespacho"].'",
						"'.$value["fechaDevolucion"].'",
						"'.$acciones.'"
						
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
Tabla Reservas
=============================================*/ 

$tabla = new TablaReservas();
$tabla -> mostrarTabla();
