<?php
class ControladorAdministradores{
    //ingreso administradores
    public function ctrIngresoAdmin()
    {
        if (isset($_POST["ingresoUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])) {

                $encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $tabla = "administradores";
                $item = "usuario";
                $valor = $_POST["ingresoUsuario"];
                
                $respuesta = ModeloAdministradores::mdlMostrarAdmin($tabla, $item, $valor);
                // echo '<pre>'; print_r($respuesta); echo '</pre>';

                if ($respuesta["usuario"] == $_POST["ingresoUsuario"] && $respuesta["contrasena"] == $encriptarPassword) {

                    if ($respuesta["estado"] == 1) {
                        $_SESSION["validarSesionBackend"] = "ok";
                        $_SESSION["idBackend"] = $respuesta["idAdministrador"];
    
                        echo '<script>
                            window.location = "'.$_SERVER["REQUEST_URI"].'";
                        </script>';
                    } else {
                        echo "<div class='alert alert-danger mt-3 small'>Error: El usuario esta desactivado</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger mt-3 small'>Error: Usuario y/o contraseña incorrectos</div>";
                }
                
            } else {
				echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
            }
        }
    }

    //Mostrar administradores
    static public function ctrMostrarAdministradores($item, $valor)
    {
        $tabla = "administradores";
        $respuesta = ModeloAdministradores::mdlMostrarAdmin($tabla, $item, $valor);
        return $respuesta;
    }

    //Registrar administradores
    public function ctrRegistroAdministrador()
    {
        if (isset($_POST["registroNombre"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroNombre"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])) {
                $encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "administradores";

				$datos = array("nombre" => $_POST["registroNombre"],
							   "usuario" =>  $_POST["registroUsuario"],
							   "contrasena" => $encriptarPassword,
							   "perfil" => $_POST["registroPerfil"],
							   "estado" => 0);

				
				$respuesta = ModeloAdministradores::mdlRegistroAdministradores($tabla, $datos);
				
				if($respuesta == "ok"){

					echo'<script>
                        Swal.fire({
                            icon:"success",
                            title: "¡Correcto!",
                            text: "El administrador ha sido creado correctamente"
						}).then((result) => {
                            if(result.value){   
                                window.location = "administradores";
                            } 
						});
					</script>';
				}
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
            }
        }
    }

    //Editar administrador
    public function ctrEditarAdministrador(){
		if(isset($_POST["editarNombre"])){
			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])){

			   	if($_POST["editarPassword"] != ""){
			   		if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
			   			$password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');  			
			   		}else{
			   			echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
			   			return;
			   		}
			   	}else{
			   		$password = $_POST["contrasenadActual"];
			   	}

				$tabla = "administradores";
				$datos = array("idAdministrador"=> $_POST["editarId"],
							   "nombre" => $_POST["editarNombre"],
							   "usuario" =>  $_POST["editarUsuario"],
							   "contrasena" => $password,
							   "perfil" => $_POST["editarPerfil"]);
				
				$respuesta = ModeloAdministradores::mdlEditarAdministrador($tabla, $datos);
				
				if($respuesta == "ok"){
					echo'<script>
                        Swal.fire({
                            icon:"success",
                            title: "¡Correcto!",
                            text: "El administrador ha sido editado correctamente"
						}).then(function(result){
                            if(result.value){   
                                window.location = "administradores";
                            } 
						});
					</script>';
				}
			}else{
				echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales</div>";
			}
		}
    }
    
	//Eliminar Administrador
	static public function ctrEliminarAdministrador($id){
		$tabla = "administradores";
		$respuesta = ModeloAdministradores::mdlEliminarAdministrador($tabla, $id);
		return $respuesta;
	}
}
?>