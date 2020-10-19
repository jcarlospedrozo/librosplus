<?php
$valor = $_GET["pagina"];
$categorias = ControladorCategorias::ctrMostrarCategorias();
$libros = ControladorLibros::ctrMostrarLibros($valor);
//echo'<pre>'; print_r($libros); echo'</pre>';
?>
<div class="container">
    <div class="row sidebar-fila">
        <div class="col-3">
            <div class="sidebar">
                <aside>
                    <div>
                        <h3>Categorias</h3>
                    </div>
                    <div class="categorias-list">
                        <ul class="list">
                            <?php foreach ($categorias as $key => $value): ?>
                                <li class="items">
                                    <a class="categoriaslibros" href="<?php echo $ruta.$value["nombreCategoria"]; ?>"><?php echo $value["nombreCategoria"]?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
        <div class="col-9 libros-todos">
            <div class="row">
                <?php foreach ($libros as $key => $value): ?>
                        <div class="col-4 libros">
                            <form action="<?php echo $ruta; ?>informacion" method="post">
                                <input type="hidden" name="id-libro" value="<?php echo $value["idLibro"]; ?>">
                                <img src="<?php echo $servidor.$value["fotoLibro"] ?>" alt="">
                                <h3><?php echo $value["nombreLibro"]?></h3>
                                <p><?php echo $value["nombreAutor"]?></p>
                                <input type="hidden" id="ruta" name="ruta" value="<?php echo $value["nombreCategoria"]; ?>">
                                <input type="submit" class=" btn boton" value="Ver detalles">
                            </form>
                        </div>
                <?php endforeach ?>
            </div>
            
            <div class="page-btn">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>&#8594;</span>
            </div>
        </div>
    </div>
</div>
