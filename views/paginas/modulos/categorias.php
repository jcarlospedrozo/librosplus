<?php
$categorias = ControladorCategorias::ctrMostrarCategorias();
//echo'<pre>'; print_r($categorias); echo'</pre>';
?>

<div class="categorias">
    <div class="small-container">
        <div class="row">
            <?php foreach ($categorias as $key => $value): ?>
                <div class="col-4">
                    <img src="<?php echo $servidor.$value["imagenCategoria"] ?>" alt="">
                    <div class="datos-categoria">
                        <h3 class="nombre-categoria"><?php echo $value['nombreCategoria']?></h3>
                        <a href="<?php echo $ruta.$value["nombreCategoria"]; ?>" class="btn btn-primary boton">Ver todo</a>
                    </div>
                </div>
            <?php endforeach?>
        </div>
    </div>
</div>