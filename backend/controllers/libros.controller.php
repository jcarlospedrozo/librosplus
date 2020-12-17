<?php

class ControladorLibros{

	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function ctrMostrarLibros($valor){

		$tabla1 = "categorias";
		$tabla2 = "libros";
		$tabla3 = "autores";

		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor);

		return $respuesta;

	}

	/*=============================================
	Nueva habitación
	=============================================*/

	static public function ctrNuevoLibro($datos){

		if(preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreLibro"]) && 
		   preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcionLibro"])){

			if($datos["fotoLibro"] != ""){
				
				list($ancho, $alto) = getimagesize($datos["fotoLibro"]);

				$nuevoAncho = 550;
				$nuevoAlto = 604;

				$directorio = "../views/img/".$datos["nombreCategoria"];	

				$ruta = strtolower($directorio."/".$datos["nombreLibro"].".png");

				$origen = imagecreatefrompng($datos["fotoLibro"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

				imagealphablending($destino, FALSE);
				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);	

			}else{

				echo'<script>

						Swal.fire({
								icon:"error",
							  	title: "¡Corregir!",
							  	text: "¡El recorrido virtual no puede estar vacío",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then((result) => {

								if(result.value){   
								    history.back();
								  } 
						});

				</script>';

				return;
			}


			$tabla = "libros";

			$datos = array("nombreLibro" => $datos["nombreLibro"],
							"descripcionLibro" => $datos["descripcionLibro"],
							"fotoLibro" => substr($ruta,3),
							"precioLibro" => $datos["precioLibro"],
							"idCategoria" => $datos["idCategoria"],
							"idAutor" => $datos["idAutor"]);

			$respuesta = ModeloLibros::mdlNuevoLibro($tabla, $datos);

			return $respuesta; 

		}else{

			echo '<script>

					Swal.fire({

						icon:"error",
						title: "¡Corregir!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then((result) => {

						if(result.value){

							history.back();

						}

					});	

				</script>';
		}


	}

	// /*=============================================
	// Editar habitación
	// =============================================*/

	static public function ctrEditarLibro($datos){

		if(preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcionLibro"])){
		   	
			if($datos["fotoLibro"] != "undefined"){	


				// unlink("../".$datos["fotoLibroAntigua"]);
				
				list($ancho, $alto) = getimagesize($datos["fotoLibro"]);

				$nuevoAncho = 550;
				$nuevoAlto = 604;

				$directorio = "../views/img/".$datos["nombreCategoria"];	

				$ruta = strtolower($directorio."/".$datos["nombreLibro"].".png");

				$origen = imagecreatefromjpeg($datos["fotoLibro"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

				$ruta = substr($ruta,3);

			}else{

				$ruta = $datos["fotoLibroAntigua"];
				
			}

			$tabla = "libros";

			$datos = array("idLibro" => $datos["idLibro"],
						   "nombreLibro" => $datos["nombreLibro"],
						   "descripcionLibro" => $datos["descripcionLibro"],
						   "fotoLibro" => $ruta,
						   "precioLibro" => $datos["precioLibro"],
						   "idCategoria" => $datos["idCategoria"],
						   "idAutor" => $datos["idAutor"],);

			$respuesta = ModeloLibros::mdlEditarLibro($tabla, $datos);

			return $respuesta; 

		}else{

			echo '<script>

					Swal.fire({

						icon:"error",
						title: "¡Corregir!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then((result) => {

						if(result.value){

							history.back();

						}

					});	

				</script>';
		}


	}

	/*=============================================
	Eliminar Libro
	=============================================*/

	static public function ctrEliminarLibro($datos){
		
		// Eliminamos fotos de la galería

		// $galeriaHabitacion = explode("," , $datos["galeriaHabitacion"]);

		// foreach ($galeriaHabitacion as $key => $value) {
			
		// 	unlink("../".$value);
		
		// }

		// Eliminamos imagen 360°

		unlink("../".$datos["imagenLibro"]);	

		$tabla = "libros";

		$respuesta = ModeloLibros::mdlEliminarLibro($tabla, $datos["idEliminar"]);

		return $respuesta;

	}


}