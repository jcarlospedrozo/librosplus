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
                    <a class="nav-link" href="login" tabindex="-1" aria-disabled="true"> <img src="views/img/user.png" alt=""width="20px"></a>
                </li>
            </ul>
        </nav>
    </div>
</header>