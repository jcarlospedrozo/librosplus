<?php
$categorias = ControladorCategorias::ctrMostrarCategorias();
?>

<header>
    <div class="container">
        <nav class="navbar navbar-light libros-plus">
            <a class="navbar-brand logo" href="<?php echo $ruta;  ?>">
                <img src="" class="d-inline-block align-top" alt="" loading="lazy">
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
                        <?php if ($_SESSION["fotoUsuario"] == ""): ?>
                            <i class='bx bx-user bx-sm'></i>
                        <?php else: ?>
                            <?php if ($_SESSION["modoUsuario"] == "directo"): ?>
                                <img src="<?php echo $servidor.$_SESSION["fotoUsuario"]; ?>" class="img-fluid rounded-circle" style="width:30px">
                            <?php else: ?>
                                <img src="<?php echo $_SESSION["fotoUsuario"]; ?>" class="img-fluid rounded-circle" style="width:30px">
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