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

    $item = $cliente->verifyIdToken();
    echo '<pre>'; print_r($item); echo '</pre>';
}
?>
<div class="register">
    <div class="container">
        <div class="row fila-registro">
            <div class="col-6 imagen">
                <img src="views/img/undraw_book_lover_mkck.svg" alt="">
            </div>
            <div class="col-6 ingresar">
                <h1 class="text-center">Registrarse</h1>
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
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="registroNombre" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"  name="registroEmail" required aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"  name="registroPass" required>
                    </div>
                    <input type="submit" class="boton btn btn-lg btn-block" value="Regístrate">
                    <?php
                    $registroUsuario = new ControladorUsuarios();
                    $registroUsuario->ctrRegistroUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>