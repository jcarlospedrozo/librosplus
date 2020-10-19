<?php
$valor = $_POST["id-libro"];
$detallesLibro = ControladorDetalleLibro::ctrMostrarDetalleLibro($valor);
// $libros = ControladorLibros::ctrMostrarLibros($valor);

// echo'<pre>'; print_r($detallesLibro); echo'</pre>';
?>
<div class="container single-product">
    <div class="row">
        <div class="col-5">
            <img src="<?php echo $servidor.$detallesLibro[0]["fotoLibro"] ?>" alt="" class="foto-libro" width="100%">
        </div>
        <div class="col-7 descripcion">
        <?php foreach ($detallesLibro as $key => $value): ?>
            <form action="<?php echo $ruta; ?>reservas" method="post">
                <input type="hidden" name="id-libro" value="<?php echo $value["idLibro"]; ?>">
                <h1><?php echo $value["nombreLibro"] ?></h1>
                <h3>Descripción</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic ab iste accusamus doloribus explicabo necessitatibus impedit, vel quaerat eum odit aut labore tenetur saepe. Assumenda, enim facilis. Maiores, saepe repudiandae?</p>
                <h4>8000</h4>

                <div class="row">
                    <div class="col-6">
                        <!-- <input type="text" class="form-control fecha-reserva" placeholder="Entrada"> -->
                        <div class="input-group mb-2">
                            <input type="text" class="form-control fecha-reserva desde" autocomplete="off" name="fecha-desde" placeholder="Desde" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class='bx bx-calendar'></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control fecha-reserva hasta" autocomplete="off" name="fecha-hasta" placeholder="Hasta" readonly required>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class='bx bx-calendar'></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn boton" value="Ver disponibilidad">
                <input type="hidden" id="ruta" name="ruta" value="<?php echo $value["nombreCategoria"]; ?>">
            </form>
        <?php endforeach ?>
        </div>
    </div>
</div>