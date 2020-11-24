<?php

class ControladorLibros
{
	//Mostrar libros
	static public function ctrMostrarLibros($valor)
	{
		$tabla1 = "categorias";
		$tabla2 = "libros";
		$tabla3 = "autores";
		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor);
		return $respuesta;
	}

	//Guardar libro
	static public function ctrNuevoLibro($datos)
	{

		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombreLibro"]) && preg_match('/^[\/\=\\&\\$\\;\\_\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcionLibro"])) {

			if ($datos["fotoLibro"] != "") {

				$ruta = array();
				$guardarRuta = array();

				$fotoLibro = json_decode($datos["fotoLibro"], true);

				for ($i = 0; $i < count($fotoLibro); $i++) {

					list($ancho, $alto) = getimagesize($fotoLibro[$i]);

					$nuevoAncho = 550;
					$nuevoAlto = 604;

					/*=============================================
					Creamos el directorio donde vamos a guardar la imagen
					=============================================*/

					$directorio = "../views/img/" . $datos["nombreCategoria"];

					array_push($ruta, strtolower($directorio . "/" . $datos["nombreLibro"] . ($i + 1) . ".jpg"));

					$origen = imagecreatefromjpeg($fotoLibro[$i]);

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
							  	text: "¡La imagen no puede estar vacía",
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
				"nombreLibro" => $datos["nombreLibro"],
				"descripcionLibro" => $datos["descripcionLibro"],
				"fotoLibro" => json_encode($guardarRuta),
				"precioLibro" => $datos["precioLibro"],
				"idCategoria" => $datos["idCategoria"],
				"idAutor" => $datos["idAutor"]
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

	/*=============================================
	Editar habitación
	=============================================*/

	static public function ctrEditarLibro($datos){

		if(preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion"])){
		   	
			//Validamos que la galería no venga vacía

		   	if($datos["fotoLibroAntigua"] == "" && $datos["fotoLibro"] == ""){

				echo'<script>

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

			//Eliminar las fotos de la galería de la carpeta

			$traerLibro = ModeloLibros::mdlMostrarLibros("categorias", "libros", "autores", $datos["idLibro"]);

			if($datos["fotoLibroAntigua"] != ""){	

				$fotoLibroBD = json_decode($traerLibro["fotoLibro"], true);

				$fotoLibroAntigua = explode("," , $datos["fotoLibroAntigua"]);

				$guardarRuta = $fotoLibroAntigua;
		
				$borrarFoto = array_diff($fotoLibroBD, $fotoLibroAntigua);

				foreach ($borrarFoto as $key => $valueFoto){
						
					unlink("../".$valueFoto);

				}

			}else{


				$fotoLibroBD = json_decode($traerLibro["fotoLibro"], true);

				foreach ($fotoLibroBD as $key => $valueFoto){

					unlink("../".$valueFoto);

				}

				
			}
		   	
		   	// Cuando vienen fotos nuevas

		   	if($datos["fotoLibro"] != ""){

			   	$ruta = array();
			   	$guardarRuta = array();

				$fotoLibro = json_decode($datos["fotoLibro"], true);
				$fotoLibroAntigua = explode("," , $datos["fotoLibroAntigua"]);

				for($i = 0; $i < count($fotoLibro); $i++){

					list($ancho, $alto) = getimagesize($fotoLibro[$i]);

					$nuevoAncho = 550;
					$nuevoAlto = 604;

					$aleatorio = mt_rand(100,999); 

					/*=============================================
					Creamos el directorio donde vamos a guardar la imagen
					=============================================*/

					$directorio = "../views/img/".$datos["nombreCategoria"];	

					array_push($ruta, strtolower($directorio."/".$datos["estilo"].$aleatorio.".jpg"));

					$origen = imagecreatefromjpeg($fotoLibro[$i]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta[$i]);	

					array_push($guardarRuta, substr($ruta[$i], 3));

				}

				// Agregamos las fotos antiguas

				if($datos["fotoLibroAntigua"] != ""){

					foreach ($fotoLibroAntigua as $key => $value) {
						
						array_push($guardarRuta, $value);
					}

				}

			}

			

			$tabla = "libros";

			$datos = array("idLibro" => $datos["idLibro"],
			"nombreLibro" => $datos["nombreLibro"],
			"descripcionLibro" => $datos["descripcionLibro"],
			"fotoLibro" => json_encode($guardarRuta),
			"precioLibro" => $datos["precioLibro"],
			"idCategoria" => $datos["idCategoria"],
			"idAutor" => $datos["idAutor"]);

			$respuesta = ModeloLibros::mdlEditarLibro($tabla, $datos);

			return $respuesta; 

		}else{

			echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';
		}


	}

	//Eliminar Habitación

	static public function ctrEliminarLibro($datos){
		
		// Eliminamos fotos de la galería

		$fotoLibro = explode("," , $datos["fotoLibro"]);

		foreach ($fotoLibro as $key => $value) {
			
			unlink("../".$value);
		
		}	

		$tabla = "libros";

		$respuesta = ModeloLibros::mdlEliminarLibro($tabla, $datos["idEliminar"]);

		return $respuesta;

	}
}
