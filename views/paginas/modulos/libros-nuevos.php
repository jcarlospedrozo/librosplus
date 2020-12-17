<?php
$librosNuevos = ControladorLibros::ctrMostrarLibrosNuevos();
// $libros = ControladorLibros::ctrMostrarLibros($valor);
// echo'<pre>'; print_r($categorias); echo'</pre>';
?>
<div class="small-container">
    <h2 class="title">Libros Nuevos</h2>
    <div class="row">
        <?php foreach ($librosNuevos as $key => $value): ?>
            <div class="col-3 libros">
                <img src="<?php echo $servidor.$value["fotoLibro"] ?>" class="foto-libro" alt="">
                <h3><?php echo $value['nombreLibro'] ?></h3>
                <p><?php echo $value['nombreAutor'] ?></p>
                <a href="<?php echo $ruta.$value["rutaCategoria"]; ?>" class="btn btn-primary boton">Ver todo</a>
            </div>
        
        <?php endforeach ?>
    </div>
</div>