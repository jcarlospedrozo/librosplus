// $.ajax({
//     "url": "ajax/tablaReservas.ajax.php",
//         // method: "POST",
//         // data: datos,
//         // cache: false,
//         // contentType: false,
//         // processData: false,
//         // dataType: "json",
//     success: function (respuesta) {
//         console.log(respuesta);
//     }
// })

$("document").ready(function () {
	$('.tablaReservas').DataTable({
		"ajax": "ajax/tablaReservas.ajax.php",
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"language": {
			"decimal": "",
			"emptyTable": "No hay datos disponibles en la tabla",
			"info": "Mostrando _START_ de _END_ de _TOTAL_ registros",
			"infoEmpty": "Mostrando 0 to 0 de 0 registros",
			"infoFiltered": "(filtrado de _MAX_ total registros)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ registros",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "No se han encontrado registros",
			"paginate": {
				"first": "Primero",
				"last": "Ultimo",
				"next": "Siguiente",
				"previous": "Anterior"
			},
			"aria": {
				"sortAscending": ": activar para ordenar la columna de manera ascendente",
				"sortDescending": ": activar para ordenar la columna de manera descendente"
			}
		}
	})
})

//FECHAS RESERVA

$('.datepicker.desde').datepicker({
	startDate: '0d',
	datesDisabled: '0d',
	format: 'yyyy-mm-dd',
	todayHighlight: true,
	language: "es"
});

/*=============================================
EDITAR RESERVA
=============================================*/

$(document).on("click", ".editarReserva", function () {

	var idLibro = $(this).attr("idLibro");
	var fechaDesde = $(this).attr("fechaDesde");
	var fechaHasta = $(this).attr("fechaHasta");
	var idReserva = $(this).attr("idReserva");

	$(".agregarCalendario").html('<div id="calendar"></div>');

	// Agregar las fechas de reserva al formulario
	$(".datepicker.desde").val(fechaDesde);
	$(".datepicker.hasta").val(fechaHasta);

	// Agregar id del libro al botón ver disponibilidad
	$(".verDisponibilidad").attr("idLibro", idLibro);

	//Agregar id de la reserva al botón guardar
	$(".guardarNuevaReserva").attr("idReserva", idReserva);

	//Traer las reservas existentes del libro
	var totalEventos = [];
	var datos = new FormData();
	datos.append("idLibro", idLibro);

	$.ajax({
		url: "ajax/reservas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			for (var i = 0; i < respuesta.length; i++) {
				if (fechaDesde != respuesta[i]["fechaDesde"]) {
					// Agregamos las fechas que ya están reservadas de esa habitación
					totalEventos.push(
						{
							"start": respuesta[i]["fechaDespacho"],
							"end": respuesta[i]["fechaDevolucion"],
							"rendering": 'background',
							"color": '#847059'
						}
					)
				}
			}

			//Agregamos las fechas de la reserva
			totalEventos.push(
				{
					"start": fechaDesde,
					"end": fechaHasta,
					"rendering": 'background',
					"color": '#FFCC29'
				}
			)

			//CALENDARIO
			$('#calendar').fullCalendar({
				defaultDate: fechaDesde,
				header: {
					left: 'prev',
					center: 'title',
					right: 'next'
				},
				events: totalEventos
			});
		}
	})

	//Agregar la misma cantidad de días para la fecha de reserva

	var diasReserva = $(this).attr("diasReserva");

	$('.datepicker.desde').change(function () {
		var fechaDesde = new Date($(this).val());
		fechaDesde.setDate(fechaDesde.getDate() + Number(diasReserva) + 1);

		mes = ("0" + Number(fechaDesde.getMonth() + 1)).slice(-2);
		dia = ("0" + fechaDesde.getDate()).slice(-2);

		$('.datepicker.hasta').val(fechaDesde.getFullYear() + "-" + mes + "-" + dia);
	})
})

/*=============================================
VER DISPONIBILIDAD NUEVA RESERVA
=============================================*/

$(document).on("click", ".verDisponibilidad", function () {

	var fechaDesde = $(".datepicker.desde").val();
	var fechaHasta = $(".datepicker.hasta").val();
	var idLibro = $(this).attr("idLibro");

	// Reiniciar Calendario cada vez que busque disponibilidad
	$(".agregarCalendario").html('<div id="calendar"></div>');

	var totalEventos = [];
	var opcion1 = [];
	var opcion2 = [];
	var opcion3 = [];
	var validarDisponibilidad = false;

	var datos = new FormData();
	datos.append("idLibro", idLibro);

	$.ajax({

		url: "ajax/reservas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			for (var i = 0; i < respuesta.length; i++) {

				/* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */

				if (fechaDesde == respuesta[i]["fechaDespacho"]) {

					opcion1[i] = false;

				} else {

					opcion1[i] = true;

				}

				/* VALIDAR CRUCE DE FECHAS OPCIÓN 2 */

				if (fechaDesde > respuesta[i]["fechaDespacho"] && fechaDesde < respuesta[i]["fechaDevolucion"]) {

					opcion2[i] = false;

				} else {

					opcion2[i] = true;

				}

				/* VALIDAR CRUCE DE FECHAS OPCIÓN 3 */

				if (fechaDesde < respuesta[i]["fechaDespacho"] && fechaHasta > respuesta[i]["fechaDespacho"]) {

					opcion3[i] = false;

				} else {

					opcion3[i] = true;

				}

				/* VALIDAR DISPONIBILIDAD */

				if (opcion1[i] == false || opcion2[i] == false || opcion3[i] == false) {

					validarDisponibilidad = false;

				} else {

					validarDisponibilidad = true;

				}

				if (!validarDisponibilidad) {

					totalEventos.push(
						{
							"start": respuesta[i]["fechaDespacho"],
							"end": respuesta[i]["fechaDevolucion"],
							"rendering": 'background',
							"color": '#847059'
						}
					)

					$(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>');

					$(".guardarNuevaReserva").attr("fechaDesde", "");
					$(".guardarNuevaReserva").attr("fechaHasta", "");

					break;

				} else {

					totalEventos.push(
						{
							"start": respuesta[i]["fechaDespacho"],
							"end": respuesta[i]["fechaDevolucion"],
							"rendering": 'background',
							"color": '#847059'
						}

					)

					$(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>');

					$(".guardarNuevaReserva").attr("fechaDesde", fechaDesde);
					$(".guardarNuevaReserva").attr("fechaHasta", fechaHasta);

				}


			}

			if (validarDisponibilidad) {

				totalEventos.push(
					{
						"start": fechaDesde,
						"end": fechaHasta,
						"rendering": 'background',
						"color": '#FFCC29'
					}
				)

			}

			$('#calendar').fullCalendar({
				defaultDate: fechaDesde,
				header: {
					left: 'prev',
					center: 'title',
					right: 'next'
				},
				events: totalEventos
			});
		}
	})
})

//Guardar nueva reserva

$(document).on("click", ".guardarNuevaReserva", function () {

	var fechaDesde = $(this).attr("fechaDesde");
	var fechaHasta = $(this).attr("fechaHasta");
	var idReserva = $(this).attr("idReserva");

	if (fechaDesde == "" || fechaHasta == "") {

		Swal.fire({
			title: "Error al guardar",
			text: "¡No ha seleccionado fechas válidas!",
			icon: "error",
			confirmButtonText: "¡Cerrar!"
		});

		return;

	}

	var datos = new FormData();
	datos.append("idReserva", idReserva);
	datos.append("fechaDesde", fechaDesde);
	datos.append("fechaHasta", fechaHasta);

	$.ajax({

		url: "ajax/reservas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			if (respuesta == "ok") {
				Swal.fire({
					icon: "success",
					title: "¡Correcto!",
					text: "La reserva ha sido modificada correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then((result) => {
					if (result.value) {
						window.location = "reservas";
					}
				})
			}
		}
	})
})

//Cancelar reserva
$(document).on("click", ".eliminarReserva", function () {

	var idReserva = $(this).attr("idReserva");

	Swal.fire({
		title: '¿Está seguro de cancelar esta reserva?',
		text: "¡Si no lo está puede cancelar la acción!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, cancelar reserva!'
	}).then((result) => {

		if (result.value) {

			var datos = new FormData();
			datos.append("idReserva", idReserva);
			datos.append("fechaDesde", null);
			datos.append("fechaHasta", null);

			$.ajax({

				url: "ajax/reservas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function (respuesta) {

					if (respuesta == "ok") {
						Swal.fire({
							icon: "success",
							title: "¡Correcto!",
							text: "La reserva ha sido cancelada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result) => {
							if (result.value) {
								window.location = "reservas";
							}
						})
					}
				}
			})
		}
	})
})
