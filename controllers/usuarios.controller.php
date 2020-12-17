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
                    $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding: 40px 0">
                            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                <center>                     
                                    <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                                    <hr style="border:1px solid #ccc; width:80%">
                                    <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>
                                    <a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
                                        <div style="line-height:60px; background:#007bff; width:60%; color:white">Verifique su dirección de correo electrónico</div>
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
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
								text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result) => {
								if(result.value){   
									history.back();
								}
							})
                        </script>';
                    } else {
                        echo'<script>
                        Swal.fire({
                            title: "¡Su cuenta ha sido creada correctamente!",
                            text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
							icon: "success",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
                        }).then((result) => {
							if(result.value){   
								history.back();
							}
						})
						</script>';
                    }
                }
            } else {
				echo'<script>
					Swal.fire({
                        icon:"error",
                        title: "¡Corregir!",
						text: "¡No se permiten caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						}
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
								Swal.fire({
                                    icon:"error",
                                    title: "¡Error!",
									text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then((result) => {
									if(result.value){   
										history.back();
									}
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
					Swal.fire({
                        icon:"error",
                        title: "¡Error!",
                        text: "¡El email o contraseña no coinciden!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						}
					})
                    </script>';
                }

            } else {
                echo'<script>
					Swal.fire({
                        icon:"error",
                        title: "¡Corregir!",
                        text: "¡No se permiten caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						}
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

    public function ctrCambiarFotoPerfil()
    {
        if(isset($_POST["idUsuarioFoto"])){
            $ruta = "backend/".$_POST["fotoActual"];

            if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){
                list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

				$nuevoAncho = 500;
                $nuevoAlto = 500;
                
                $directorio = "backend/views/img/usuarios/".$_POST["idUsuarioFoto"];

                if ($ruta != "") {
                    unlink($ruta);
                } else {
                    if(!file_exists($directorio)){	
						mkdir($directorio, 0755);
					}
                }
                
                if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){
					$aleatorio = mt_rand(100,999);
					$ruta = $directorio."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);	
                }
                
                else if($_FILES["cambiarImagen"]["type"] == "image/png"){
					$aleatorio = mt_rand(100,999);
					$ruta = $directorio."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagealphablending($destino, FALSE);
					imagesavealpha($destino, TRUE);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
                }
                
                else{
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
						})
					</script>';
                }
                $ruta = substr($ruta, 8);
            }

            $tabla = "usuarios";
			$id = $_POST["idUsuarioFoto"];
			$item = "fotoUsuario";
            $valor = $ruta;
            
            $actualizarFotoPerfil = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

            if($actualizarFotoPerfil == "ok"){

				echo '<script>
					Swal.fire({
						icon:"success",
					  	title: "Correcto!",
						text: "¡La foto de perfil ha sido actualizada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						} 
					})
				</script>';
			}
        }
    }

    public function ctrCambiarPassword(){
		if(isset($_POST["editarPassword"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "usuarios";
				$id = $_POST["idUsuarioPassword"];
				$item = "contrasenaUsuario";
				$valor = $encriptar;

				$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

				if($actualizarPassword == "ok"){
					echo '<script>
						Swal.fire({
							icon:"success",
						  	title: "¡Correcto!",
						  	text: "¡Sus datos han sido actualizados!",
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
				echo'<script>
					Swal.fire({
						icon:"error",
					  	title: "¡Corregir!",
					  	text: "¡No se permiten caracteres especiales!",
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
    
    public function ctrRecuperarPassword(){
		if(isset($_POST["emailRecuperarPassword"])){
			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])){

				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

				function generarPassword($longitud){
					$password = "";
					$patron = "1234567890abcdefghijklmnopqrstuvwxyz";
					$max = strlen($patron)-1;

					for($i = 0; $i < $longitud; $i++){
						$password .= $patron{mt_rand(0,$max)};
					}

					return $password;
				}

				$nuevaPassword = generarPassword(11);
				$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$tabla = "usuarios";
				$item = "emailUsuario";
				$valor = $_POST["emailRecuperarPassword"];

				$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

				if($traerUsuario){
					$id = $traerUsuario["idUsuario"];
					$item = "contrasenaUsuario";
					$valor = $encriptar;

					$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

					if($actualizarPassword  == "ok"){

						/*=============================================
						VERIFICACIÓN CORREO ELECTRÓNICO
						=============================================*/

						date_default_timezone_set("America/Bogota");

						$ruta = ControladorRuta::ctrRuta();
						$mail = new PHPMailer;
						$mail->CharSet = 'UTF-8';
						$mail->isMail();
						$mail->setFrom('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
						$mail->addReplyTo('cursos@tutorialesatualcance.com', 'Tutoriales a tu Alcance');
						$mail->Subject = "Por favor verifique su dirección de correo electrónico";
						$mail->addAddress($_POST["emailRecuperarPassword"]);
						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding: 40px 0">

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>

                                    <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
                                    <hr style="border:1px solid #ccc; width:80%">
                                    <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>
                                    <a href="'.$ruta.'" target="_blank" style="text-decoration:none">
                                        <div style="line-height:30px; background:#007bff; width:60%; padding:20px; color:white">			
                                            Haz click aquí
                                        </div>

                                    </a>

                                    <h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

                                    <br>

                                    <hr style="border:1px solid #ccc; width:80%">
                                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
								</center>

							</div>

						</div>');

						$envio = $mail->Send();

						if(!$envio){

							echo'<script>
								Swal.fire({
                                    icon:"error",
                                    title: "¡Error!",
                                    text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["emailRecuperarPassword"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then((result) => {
									if(result.value){   
										history.back();
									} 
								});
							</script>';

						}else{


							echo'<script>
								Swal.fire({
									icon:"success",
								  	title: "¡Su solicitud ha sido recibida!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailRecuperarPassword"].' para su cambio de contraseña!",
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
						  	title: "¡Error!",
						  	text: "¡El correo no existe en el sistema",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result) => {
							if(result.value){   
								history.back();
							} 
						})
					</script>';

				}

			}else{
				echo'<script>
					Swal.fire({
						icon:"error",
					  	title: "¡Corregir!",
					  	text: "¡No se permiten caracteres especiales!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						} 
					})
				</script>';
			}
		}
	}
}
?>