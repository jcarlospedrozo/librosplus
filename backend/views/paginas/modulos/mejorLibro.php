<?php 

$mejorLibro = ControladorInicio::ctrMejorLibro();

?>


<div class="card card-success card-outline">

	<div class="card-header">
		<h5 class="m-0">Libro más alquilado</h5>
	</div>

	<div class="card-body">


		<h6 class="card-title py-3"><?php echo $mejorLibro["nombreLibro"]; ?></h6> <br><br>

		<a href="reservas" class="btn btn-success">Ver reservas</a>

	</div>

</div>