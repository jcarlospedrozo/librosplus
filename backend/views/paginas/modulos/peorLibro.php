<?php 

$peorLibro = ControladorInicio::ctrPeorHabitacion();

$traerFoto = ControladorInicio::ctrTraerFotoLibro($peorLibro["fotoLibro"]);

// $traerFotoArray = json_decode($traerFoto["galeria"], true);

?>


<div class="card card-danger card-outline">

	<div class="card-header">
		<h5 class="m-0">Libro menos alquilado</h5>
	</div>

	<div class="card-body">

		<!-- <img src="<?php echo $traerFotoArray[0]; ?>" class="img-thumbnail"> -->

		<h6 class="card-title py-3"><?php echo $peorLibro["nombreLibro"]; ?></h6> <br><br>

		<a href="reservas" class="btn btn-danger">Ver reservas</a>

	</div>

</div>