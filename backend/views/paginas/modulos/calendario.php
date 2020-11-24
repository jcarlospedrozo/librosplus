<?php 

$traerReservas = ControladorReservas::ctrMostrarReservas(null, null);

// $descripcion = array();
$fechaDesde = array();
$fechaHasta = array();

foreach ($traerReservas as $key => $value) {
	
	// array_push($descripcion, $value["descripcion_reserva"]);	
	array_push($fechaDesde, $value["fechaDespacho"]);
	array_push($fechaHasta, $value["fechaDevolucion"]);
}

?>


<div class="card card-primary card-outline">

	<div class="card-header">

		<h5 class="m-0">Reservas del mes</h5>

	</div>

	<div class="card-body">

		<div id="calendarIndex"></div>

		<a href="reservas" class="btn btn-primary mt-3">Ver reservas</a>

	</div>

</div>

<script>

var fechaActual = new Date();
var mes = ("0"+Number(fechaActual.getMonth()+1)).slice(-2);
var dia = ("0"+fechaActual.getDate()).slice(-2);
	
	 $('#calendarIndex').fullCalendar({
	    defaultDate:fechaActual.getFullYear()+"-"+mes+"-"+dia,
        header: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        events:[

		<?php

			for($i = 0; $i < count($idReserva); $i++){

				echo '{"title":"'.$descripcion[$i].'",
					   "start":"'.$fechaDesde[$i].'",
					   "end":"'.$fechaHasta[$i].'",
					   "color": "#FFCC29"},';

			}

		?>

        ]


      });


</script>
