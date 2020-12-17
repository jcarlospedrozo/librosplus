<?php

class ControladorCategorias{
    //Mostrar administradores
    static public function ctrMostrarCategorias($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrRegistroCategoria()
    {
        if(isset($_POST["rutaCategoria"])){
			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["rutaCategoria"]) && 
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nombreCategoria"])){

				if(isset($_FILES["subirImgCategoria"]["tmp_name"]) && !empty($_FILES["subirImgCategoria"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["subirImgCategoria"]["tmp_name"]);

					$nuevoAncho = 550;
					$nuevoAlto = 604;

					/*=============================================
					Creamos el directorio donde vamos a guardar la imagen
					=============================================*/

					$directorio = "views/img/".strtolower($_POST["nombreCategoria"]);	

					if(!file_exists($directorio)){	
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["subirImgCategoria"]["type"] == "image/jpeg"){
						$aleatorio = mt_rand(100,999);
						$ruta = $directorio."/portada.jpg";
						$origen = imagecreatefromjpeg($_FILES["subirImgCategoria"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);	
                    }
                    
					else if($_FILES["subirImgCategoria"]["type"] == "image/png"){
						$aleatorio = mt_rand(100,999);
						$ruta = $directorio."/portada.png";
						$origen = imagecreatefrompng($_FILES["subirImgCategoria"]["tmp_name"]);						
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
								  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
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

					$tabla = "categorias";

					$datos = array("rutaCategoria" => $_POST["rutaCategoria"],
								   "nombreCategoria" => $_POST["nombreCategoria"],
								   "imagenCategoria" => $ruta);

					$respuesta = ModeloCategorias::mdlRegistroCategoria($tabla, $datos);

					if($respuesta == "ok"){
						echo '<script>
                            Swal.fire({
								icon:"success",
							  	title: "¡Correcto!",
							  	text: "¡La Categoria ha sido creada exitosamente!",
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
	}
	
	//Editar categoria
	public function ctrEditarCategoria()
	{
		if(isset($_POST["idCategoria"])){
			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["editarRutaCategoria"])){

			   	$ruta = $_POST["imgCategoriaActual"];
			
				if(isset($_FILES["editarImgCategoria"]["tmp_name"]) && !empty($_FILES["editarImgCategoria"]["tmp_name"])){				
					list($ancho, $alto) = getimagesize($_FILES["editarImgCategoria"]["tmp_name"]);

					$nuevoAncho = 550;
					$nuevoAlto = 604;

					$directorio = "views/img/".strtolower($_POST["editarNombreCategoria"]);	
				
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(isset($_POST["imgCategoriaActual"])){
						unlink($_POST["imgCategoriaActual"]);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImgCategoria"]["type"] == "image/jpeg"){
						$aleatorio = mt_rand(100,999);
						$ruta = $directorio."/portada.jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImgCategoria"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);	
					}
					// $ruta = $directorio."/portada.png";
					else if($_FILES["editarImgCategoria"]["type"] == "image/png"){
						$aleatorio = mt_rand(100,999);
						$ruta = $directorio."/portada.png";
						$origen = imagecreatefrompng($_FILES["editarImgCategoria"]["tmp_name"]);						
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
								text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
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
				}

				$tabla = "categorias";

			   	$datos = array("idCategoria"=> $_POST["idCategoria"],
							"rutaCategoria" => $_POST["editarRutaCategoria"],
							"nombreCategoria" => $_POST["editarNombreCategoria"],
							"imagenCategoria" => $ruta);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){
					echo '<script>
						Swal.fire({
							icon:"success",
						  	title: "¡Correcto!",
						  	text: "¡la Categoria ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result) => {
							if(result.value){   
								history.back();
							} 
						});
					</script>';
				}	
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
	}

	//Validar existencia de libros en categoría
	static public function ctrValidarCategoria($item, $valor){
		$tabla = "libros";
		$respuesta = ModeloCategorias::mdlValidarCategoria($tabla, $item, $valor);
		return $respuesta;
	}

	//Eliminar Categoria
	static public function ctrEliminarCategoria($id, $ruta, $tipo){		
		unlink("../".$ruta);
		rmdir("../views/img/".strtolower($tipo));

		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlEliminarCategoria($tabla, $id);
		return $respuesta;
	}
}
