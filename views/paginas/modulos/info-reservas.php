<?php
if (isset($_POST["id-libro"])) {
    // echo'<pre>'; print_r($_POST["id-libro"]); echo'</pre>';
    // echo'<pre>'; print_r($_POST["fecha-desde"]); echo'</pre>';
    // echo'<pre>'; print_r($_POST["fecha-hasta"]); echo'</pre>';

    $valor = $_POST["id-libro"];
	$reservas = ControladorReservas::ctrMostrarReservas($valor);
	
	$indice = 0;
	
	if (!$reservas) {
		$valor = $_POST["ruta"];
		$reservas = ControladorLibros::ctrMostrarLibros($valor);

		foreach ($reservas as $key => $value) {
			if ($value["idLibro"] == $_POST["id-libro"]) {
				$indice = $key;
			}
		}
	}
	
	// echo'<pre>'; print_r($reservas); echo'</pre>';

	$precioReserva = $reservas[$indice]["precioLibro"];


} else {
    echo '<script> window.location = "'.$ruta. '"</script>';
}

?>

<div class="infoReservas" idLibro="<?php echo $_POST["id-libro"]; ?>" fechaDesde="<?php echo $_POST["fecha-desde"]; ?>" fechaHasta="<?php echo $_POST["fecha-hasta"]; ?>">	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">

					<div class="clearfix"></div>

					<h1 class="float-leftp-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

						<br>
						<a href="<?php echo $ruta;  ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="p-4 calendarioReservas">

				<?php if ($valor == $_POST["ruta"]): ?>

					<h1 class="pb-5 float-left">¡Está Disponible!</h1>

				<?php else: ?>

					<div class="infoDisponibilidad"></div>
					
				<?php endif ?>

					<div class="float-right pb-3">
							
						<ul>
							<li>
								<i class="bx bxs-square" style="color:#847059"></i> No disponible
							</li>

							<li>
								<i class="bx bxs-square" style="color:#eee"></i> Disponible
							</li>

							<li>
								<i class="bx bxs-square" style="color:#FFCC29"></i> Tu reserva
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

					<form action="<?php echo $ruta; ?>reservas" method="post">
						<input type="hidden" name="id-libro" value="<?php echo $_POST["id-libro"]; ?>">
						<input type="hidden" name="ruta" value="<?php echo $_POST["ruta"]; ?>">

							<div class="row">
                                <div class="col-6 col-md-3 input-group pr-1">
                                    <input type="text" class="form-control fecha-reserva desde" autocomplete="off" name="fecha-desde" placeholder="Desde" value="<?php echo $_POST["fecha-desde"]; ?>"required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class='bx bx-calendar'></i></div>                                
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 input-group pl-1">
                                    <input type="text" class="form-control fecha-reserva hasta" autocomplete="off" name="fecha-hasta" placeholder="Hasta" value="<?php echo $_POST["fecha-hasta"]; ?>"readonly required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class='bx bx-calendar'></i></div>                                
                                    </div>
                                </div>
                                <input type="submit" class="btn boton" value="Ver disponibilidad">
                            </div>

				</div>

			</div>

            <div class="col-12 col-lg-4 colDerReservas" style="display:none">

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong class="codigoReserva"></strong></h2>

				<div class="form-group">
				  <label>Desde:</label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-desde"];?>" readonly>
				</div>

				<div class="form-group">
				  <label>Hasta:</label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-hasta"];?>"  readonly>
				</div>

				<div class="form-group">
				  <label>Libro:</label>
				  <input type="text" class="form-control" value="<?php echo $reservas[$indice]["nombreLibro"]; ?>" readonly>

					<img src="<?php echo $servidor.$reservas[$indice]["fotoLibro"] ?>" class="img-fluid foto-libro">


				   <!-- ESCENARIO 2 Y 3 DE RESERVAS -->
				   <!-- <input type="text" class="form-control tituloReserva" value="" readonly>   -->

				</div>

				<div class="row py-4">

					<div class="col-6">
						
						<h2 class="precioReserva">$<?php echo number_format($precioReserva);?></h2>

					</div>
					
					<div class="col-6">

					<?php if(isset($_SESSION["validarSesion"])): ?>

						<?php if($_SESSION["validarSesion"] == "ok"): ?>

							<a href="<?php echo $ruta;?>perfil">
								<button class="boton btn btn-lg">Confirmar</button>
							</a>

						<?php endif ?>

					<?php else: ?>
				
						<a href="<?php echo $ruta;?>login">
							<button class="boton btn btn-lg">Confirmar</button>
						</a>

					<?php endif ?>

					</div>
			
				</div>

			</div>
        </div>
    </div>
</div>