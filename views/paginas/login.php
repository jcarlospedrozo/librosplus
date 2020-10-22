<?php
$cliente = new Google_Client();
$cliente->setAuthConfig('models/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

$rutaGoogle = $cliente->createAuthUrl();

if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);

	$_SESSION['id_token_google'] = $token;

	$cliente->setAccessToken($token);
}

if($cliente->getAccessToken()){

	$item = $cliente->verifyIdToken();

	$datos = array("nombreUsuario"=>$item["name"],
				   "emailUsuario"=>$item["email"],
				   "contrasenaUsuario"=>"null",
				   "fotoUsuario"=>$item["picture"],
				   "modoUsuario"=>"google",
				   "verificacion"=>1,
				   "emailEncriptado"=>"null");

	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

	if($respuesta == "ok"){

			echo '<script>

			setTimeout(function(){
				
				window.location = "'.$ruta.'perfil";

			},1000);

			</script>';

	}

}

?>
<div class="login">
    <div class="container">
        <div class="row fila-ingresar">
            <div class="col-6 imagen">
                <img src="views/img/undraw_studying_s3l7.svg" alt="">
            </div>
            <div class="col-6 ingresar">
                <h1 class="text-center">Ingresar</h1>
                <form method="post">
                    <div class="form-group">
                        <p class="p-2 text-center text-white facebook" style="cursor:pointer; border-radius: 5px; background: #3b5998">
                        <i class='bx bxl-facebook' style='color:#ffffff'  ></i>
                            Ingreso con Facebook
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo $rutaGoogle; ?>">
                            <p class="p-2 bg-danger text-center text-white" style="cursor:pointer; border-radius: 5px">
                            <i class='bx bxl-google' style='color:#ffffff' ></i>
                                Ingreso con Google
                            </p>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" class="form-control" name="ingresoEmail" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" name="ingresoPass" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <a href="" data-toggle="modal" data-target="#recuperarContrasena">¿Olvidaste tu contraseña?</a>
                        <label class="form-check-label" for="exampleCheck1">¿No tienes cuenta registrada? <a href="<?php echo $ruta; ?>register">Regístrate</a></label>
                    </div>
                    <input type="submit" class="btn btn-primary boton btn-lg btn-block" value="Ingresar">

                    <?php
                    $ingresoUsuario = new ControladorUsuarios();
                    $ingresoUsuario -> ctrIngresoUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="recuperarContrasena" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Recuperar contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <!-- <p class="text-muted">Escriba su correo electrónico</p> -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electrónico</label>
                    <input type="email" class="form-control" name="emailRecuperarPassword" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Enviar">

                <?php

                $recuperarPassword = new ControladorUsuarios();
                $recuperarPassword -> ctrRecuperarPassword();

                ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>