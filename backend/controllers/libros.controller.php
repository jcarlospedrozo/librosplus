<?php

class ControladorLibros
{
	//Mostrar libros
	static public function ctrMostrarLibros($valor)
	{
		$tabla1 = "categorias";
		$tabla2 = "libros";

		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $valor);
		return $respuesta;
	}

	//Guardar libro
	static public function ctrNuevoLibro($datos)
	{

		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreLibro"]) && preg_match('/^[\/\=\\&\\$\\;\\_\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion"])) {

			if ($datos["galeria"] != "") {

				$ruta = array();
				$guardarRuta = array();

				$galeria = json_decode($datos["galeria"], true);

				for ($i = 0; $i < count($galeria); $i++) {

					list($ancho, $alto) = getimagesize($galeria[$i]);

					$nuevoAncho = 550;
					$nuevoAlto = 604;

					/*=============================================
					Creamos el directorio donde vamos a guardar la imagen
					=============================================*/

					$directorio = "../views/img/" . $datos["nombreCategoria"];

					array_push($ruta, strtolower($directorio . "/" . $datos["nombreLibro"] . ($i + 1) . ".jpg"));

					$origen = imagecreatefromjpeg($galeria[$i]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta[$i]);

					array_push($guardarRuta, substr($ruta[$i], 3));
				}
			} else {

				echo '<script>

						Swal.fire({
								icon:"error",
							  	title: "¡Corregir!",
							  	text: "¡La galería no puede estar vacía",
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

			$datos = array(
				"idCategoria" => $datos["idCategoria"],
				"nombreLibro" => $datos["nombreLibro"],
				"galeria" => json_encode($guardarRuta),
				"descripcion_h" => $datos["descripcion"]
			);

			$respuesta = ModeloLibros::mdlNuevoLibro($tabla, $datos);

			return $respuesta;
		}
		else {

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
}
