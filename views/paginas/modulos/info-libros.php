<?php
$valor = $_POST["nombre-libro"];
$detallesLibro = ControladorDetalleLibro::ctrMostrarDetalleLibro($valor);
//echo'<pre>'; print_r($libros); echo'</pre>';
?>
<div class="container single-product">
    <div class="row">
        <div class="col-5">
            <img src="views/img/gallery-1.jpg" alt="" width="100%">
        </div>
        <div class="col-7 descripcion">
        <?php foreach ($detallesLibro as $key => $value): ?>
            <h1><?php echo $value["nombreLibro"] ?></h1>
            <h3>Descripción</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ab iste accusamus doloribus explicabo necessitatibus impedit, vel quaerat eum odit aut labore tenetur saepe. Assumenda, enim facilis. Maiores, saepe repudiandae?</p>
            <h4>8000</h4>

            <div class="row">
                <div class="col-6">
                    <!-- <input type="text" class="form-control fecha-reserva" placeholder="Entrada"> -->
                    <div class="input-group mb-2">
                        <input type="text" class="form-control fecha-reserva desde" id="inlineFormInputGroup" placeholder="Desde" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class='bx bx-calendar'></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control fecha-reserva hasta" id="inlineFormInputGroup" placeholder="Hasta" readonly required>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class='bx bx-calendar'></i></div>
                        </div>
                    </div>
                </div>
            </div>


            <input type="submit" class="btn btn-reserva" value="Ver disponibilidad">
        <?php endforeach ?>
        </div>
    </div>
</div>