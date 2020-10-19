<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorUsuarios{
    public function ctrRegistroUsuario()
    {
        if (isset($_POST["registroNombre"])) {
            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
             preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPass"])) {

                $encriptarEmail = md5($_POST["registroEmail"]);
                $encriptarPassword = crypt($_POST["registroPass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                
                $datos = array("nombreUsuario" => $_POST["registroNombre"],
                    "emailUsuario" => $_POST["registroEmail"],
                    "contrasenaUsuario" => $encriptarPassword,
                    "fotoUsuario" => "",
                    "modoUsuario" => "directo",
                    "verificacion" => 0,
                    "emailEncriptado" => $encriptarEmail
                );

                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);
                if ($respuesta == "ok") {
                    date_default_timezone_set("America/Bogota");

                    $ruta = ControladorRuta::ctrRuta();
                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
					$mail->isMail();
					$mail->setFrom('support@librosplus.com', 'Libros Plus');
                    $mail->addReplyTo('support@librosplus.com', 'Libros Plus');
                    $mail->Subject = "Por favor verifique su dirección de correo electrónico";
					$mail->addAddress($_POST["registroEmail"]);
                    $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                <center>                     
                                    <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                                    <hr style="border:1px solid #ccc; width:80%">
                                    <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>
                                    <a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
                                        <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
                                    </a>
                                    <br>
                                    <hr style="border:1px solid #ccc; width:80%">
                                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                                </center>                            
                            </div>
                        </div>
                    ');
                    $envio = $mail->Send();

                    if (!$envio) {
                        echo '<script>
                        swal({
                            icon: "error",
                            title: "¡Error!",
                                text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente"
							})
                        </script>';
                    } else {
                        echo'<script>
                        swal({
                            title: "¡Su cuenta ha sido creada correctamente!",
                            text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
                            icon: "success"
                        })
						</script>';
                    }
                }
            } else {
				echo'<script>
					swal({
                        icon:"error",
                        title: "¡Corregir!",
                        text: "¡No se permiten caracteres especiales!"
					})
				</script>';
			}
        }
    }

    public static function ctrMostrarUsuario($item, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
        return $respuesta;
    }

    public static function ctrActualizarUsuario($id, $item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
		return $respuesta;
    }
    
    public function ctrIngresoUsuario()
    {
        if(isset($_POST["ingresoEmail"])){
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPass"])) {

                $encriptarPassword = crypt($_POST["ingresoPass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = "usuarios";
    			$item = "emailUsuario";
    			$valor = $_POST["ingresoEmail"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                if ($respuesta["emailUsuario"] == $_POST["ingresoEmail"] && $respuesta["contrasenaUsuario"] == $encriptarPassword) {
                    if ($respuesta["verificacion"] == 0) {
                        echo'<script>
								swal({
                                    icon:"error",
                                    title: "¡Error!",
                                    text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!"
								})
							</script>';
                        return;
                    } else {
                        $_SESSION["validarSesion"] = "ok";
    					$_SESSION["idUsuario"] = $respuesta["idUsuario"];
    					$_SESSION["nombreUsuario"] = $respuesta["nombreUsuario"];
    					$_SESSION["fotoUsuario"] = $respuesta["fotoUsuario"];
                        $_SESSION["emailUsuario"] = $respuesta["emailUsuario"];
                        $_SESSION["modoUsuario"] = $respuesta["modoUsuario"];	
                        
                        $ruta = ControladorRuta::ctrRuta();
						echo '<script>
							window.location = "'.$ruta.'perfil";				
						</script>';
                    }
                } else {
                    echo'<script>
					swal({
                        icon:"error",
                        title: "¡Error!",
                        text: "¡El email o contraseña no coinciden!"
					})
                    </script>';
                }

            } else {
                echo'<script>
					swal({
                        icon:"error",
                        title: "¡Corregir!",
                        text: "¡No se permiten caracteres especiales!"
					})
				</script>';
            }
        }
    }

    static public function ctrRegistroRedesSociales($datos)
    {
        $tabla = "usuarios";
		$item = "emailUsuario";
		$valor = $datos["emailUsuario"];
		$emailRepetido = false;

		$verificarExistenciaUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		if($verificarExistenciaUsuario){

			$emailRepetido = true;

		}else{

			$registrarUsuario = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

		}

		if($emailRepetido || $registrarUsuario == "ok"){

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

			if($traerUsuario["modoUsuario"] == "facebook"){

				session_start();

				$_SESSION["validarSesion"] = "ok";
                $_SESSION["idUsuario"] = $traerUsuario["idUsuario"];
                $_SESSION["nombreUsuario"] = $traerUsuario["nombreUsuario"];
                $_SESSION["fotoUsuario"] = $traerUsuario["fotoUsuario"];
                $_SESSION["emailUsuario"] = $traerUsuario["emailUsuario"];
                $_SESSION["modoUsuario"] = $traerUsuario["modoUsuario"];	

				echo "ok";
            
			}else if($traerUsuario["modoUsuario"] == "google"){

                $_SESSION["validarSesion"] = "ok";
                $_SESSION["idUsuario"] = $traerUsuario["idUsuario"];
                $_SESSION["nombreUsuario"] = $traerUsuario["nombreUsuario"];
                $_SESSION["fotoUsuario"] = $traerUsuario["fotoUsuario"];
                $_SESSION["emailUsuario"] = $traerUsuario["emailUsuario"];
                $_SESSION["modoUsuario"] = $traerUsuario["modoUsuario"];

                return "ok";

			}else{

				echo "";
			}
		}
    }
}
?>