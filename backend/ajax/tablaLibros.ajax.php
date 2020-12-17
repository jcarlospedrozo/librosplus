<?php

require_once "../controllers/libros.controller.php";
require_once "../models/libros.model.php";

class TablaLibros{

	/*=============================================
	Tabla Categorías
	=============================================*/ 

	public function mostrarTabla(){

		$libros = ControladorLibros::ctrMostrarLibros(null);

		if(count($libros)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($libros as $key => $value) {

			/*=============================================
			ACCIONES
			=============================================*/

			$acciones = "<a href='index.php?pagina=libros&idLibro=".$value["idLibro"]."' class='btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>";	


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["nombreCategoria"].'",
						"'.$value["nombreLibro"].'",
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
Tabla Habitaciones
=============================================*/ 

$tabla = new TablaLibros();
$tabla -> mostrarTabla();
