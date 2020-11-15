<?php
$libros = ControladorLibros::ctrMostrarLibrosNuevos();
//echo'<pre>'; print_r($categorias); echo'</pre>';
?>
<div class="small-container">
    <h2 class="title">Libros Nuevos</h2>
    <div class="row">
        <?php foreach ($libros as $key => $value): ?>
            <div class="col-3 libros">
            <img src="<?php echo $servidor.$value["fotoLibro"] ?>" alt="">
            <h3><?php echo $value['nombreLibro']?></h3>
            <p><?php echo $value['nombreAutor']?></p>
            <input type="submit" class="btn btn-primary boton" value="Ver detalles">
        </div>
        <?php endforeach?>
    </div>
</div>