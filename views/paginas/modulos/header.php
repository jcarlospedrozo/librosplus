<?php
$categorias = ControladorCategorias::ctrMostrarCategorias();

if (isset($_SESSION["validarSesion"])) {
    if ($_SESSION["validarSesion"] == "ok") {
        $item = "idUsuario";
        $valor = $_SESSION["idUsuario"];
        
        $usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);
    }
}
?>

<header>
    <div class="container">
        <nav class="navbar navbar-light libros-plus">
            <a class="navbar-brand logo" href="<?php echo $ruta;  ?>">
                <img src="views/img/logo1.png" class="d-inline-block align-top" alt="" loading="lazy">
                Libros Plus
            </a>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                <?php if (isset($_SESSION["validarSesion"])): ?>
                    <?php if ($_SESSION["validarSesion"] == "ok"): ?>
                        <a class="nav-link" tabindex="-1" aria-disabled="true" href="<?php echo $ruta.'perfil'; ?>">
                        <?php if ($usuario["fotoUsuario"] == ""): ?>
                            <i class='bx bx-user bx-sm'></i>
                        <?php else: ?>
                            <?php if ($usuario["modoUsuario"] == "directo"): ?>
                                <img src="<?php echo $servidor.$usuario["fotoUsuario"]; ?>" class="img-fluid rounded-circle" style="width:30px">
                            <?php else: ?>
                                <img src="<?php echo $usuario["fotoUsuario"]; ?>" class="img-fluid rounded-circle" style="width:30px">
                            <?php endif ?>	
                        <?php endif ?>	
                    </a>
                    <?php endif ?>	
                <?php else: ?>
                    <a class="nav-link" href="<?php echo $ruta; ?>login" tabindex="-1" aria-disabled="true"><i class='bx bx-user bx-sm'></i></a>
                <?php endif ?>
                </li>
            </ul>
        </nav>
    </div>
</header>