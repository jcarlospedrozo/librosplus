<?php

class ControladorAutores{
    //Mostrar autores
    static public function ctrMostrarAutores($item, $valor)
    {
        $tabla = "autores";
        $respuesta = ModeloAutores::mdlMostrarAutores($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrRegistroAutor()
    {
        if (isset($_POST["nombreAutor"])) {
            if (preg_match('/^[\/\=\\&\\$\\;\\_\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreAutor"])) {

				$tabla = "autores";

				$datos = array("nombreAutor" => $_POST["nombreAutor"]);

				
				$respuesta = ModeloAutores::mdlRegistroAutores($tabla, $datos);
				
				if($respuesta == "ok"){

					echo'<script>
                        Swal.fire({
                            icon:"success",
                            title: "¡Correcto!",
                            text: "El autor ha sido creado correctamente"
						}).then((result) => {
                            if(result.value){   
                                window.location = "autores";
                            } 
						});
					</script>';
				}
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
            }
        }
    }
    
    //Editar autor
	public function ctrEditarAutor()
	{
		if(isset($_POST["editarAutor"])){
			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ. ]+$/', $_POST["editarAutor"])){

			   	$tabla = "autores";
				$datos = array("idAutor"=> $_POST["editarId"],
							   "nombreAutor" => $_POST["editarAutor"]);
				
				$respuesta = ModeloAutores::mdlEditarAutor($tabla, $datos);
				
				if($respuesta == "ok"){
					echo'<script>
                        Swal.fire({
                            icon:"success",
                            title: "¡Correcto!",
                            text: "El escritor ha sido editado correctamente"
						}).then(function(result){
                            if(result.value){   
                                window.location = "autores";
                            } 
						});
					</script>';
				}
			}else{
				echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
			}
		}
    }

    //Validar existencia de libros en categoría
	static public function ctrValidarAutor($item, $valor){
		$tabla = "libros";
		$respuesta = ModeloAutores::mdlValidarAutor($tabla, $item, $valor);
		return $respuesta;
	}
    
    //Eliminar autor
	static public function ctrEliminarAutor($id){		
		$tabla = "autores";
		$respuesta = ModeloAutores::mdlEliminarAutor($tabla, $id);
		return $respuesta;
	}
}