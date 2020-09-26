<?php
$valor = $_POST["nombre-libro"];
$libros1 = ControladorDetalleLibro::ctrMostrarDetalleLibro($valor);
//echo'<pre>'; print_r($libros); echo'</pre>';
?>
<div class="container single-product">
    <div class="row">
        <div class="col-6">
            <img src="views/img/gallery-1.jpg" alt="" width="80%">
        </div>
        <div class="col-6">
            <?php foreach ($libros1 as $key => $value): ?>
                <h1><?php echo $value["nombreLibro"] ?></h1>
                <h4>8000</h4>
                <a href="" class="btn">Reservar</a>
                <h3>Descripción</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ab iste accusamus doloribus explicabo necessitatibus impedit, vel quaerat eum odit aut labore tenetur saepe. Assumenda, enim facilis. Maiores, saepe repudiandae?</p>
            <?php endforeach ?>
        </div>
    </div>
</div>