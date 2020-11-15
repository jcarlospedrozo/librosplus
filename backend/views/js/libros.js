ClassicEditor.create(document.querySelector('#descripcionLibro'), {
	toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
}).then(function (editor) {
	//  $(".ck-content").css({"height":"400px"})
}).catch(function (error) {
	// console.log("error", error);
})


//Tabla libros

// $.ajax({
//     "url":"ajax/tablaLibros.ajax.php",
//     success: function(respuesta){

//      console.log("respuesta", respuesta);

//     }
// })

$("document").ready(function () {
	$('.tablaLibros').DataTable({
		"ajax": "ajax/tablaLibros.ajax.php",
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

//Arrastrar imagen
var archivosTemporales = [];

$(".subirImagen").on("dragenter", function (e) {
	e.preventDefault();
	e.stopPropagation();

	$(".subirImagen").css({ "background": "url(views/img/plantilla/pattern.jpg)" })
})

$(".subirImagen").on("dragleave", function (e) {
	e.preventDefault();
	e.stopPropagation();

	$(".subirImagen").css({ "background": "" })
})

$(".subirImagen").on("dragover", function (e) {
	e.preventDefault();
	e.stopPropagation();
})


$("#galeria").change(function () {

	var archivos = this.files;

	multiplesArchivos(archivos);

})

$(".subirImagen").on("drop", function (e) {

	e.preventDefault();
	e.stopPropagation();

	$(".subirImagen").css({ "background": "" })

	var archivos = e.originalEvent.dataTransfer.files;

	multiplesArchivos(archivos);

})

function multiplesArchivos(archivos) {

	for (var i = 0; i < archivos.length; i++) {

		var imagen = archivos[i];

		if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

			Swal.fire({
				title: "Error al subir la imagen",
				text: "¡La imagen debe estar en formato JPG o PNG!",
				icon: "error",
				confirmButtonText: "¡Cerrar!"
			});

			return;

		} else if (imagen["size"] > 2000000) {

			Swal.fire({
				title: "Error al subir la imagen",
				text: "¡La imagen no debe pesar más de 2MB!",
				icon: "error",
				confirmButtonText: "¡Cerrar!"
			});

			return;

		} else {

			var datosImagen = new FileReader;
			datosImagen.readAsDataURL(imagen);

			$(datosImagen).on("load", function (event) {

				var rutaImagen = event.target.result;

				$(".vistaGaleria").append(`

					<li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                      
	                    <img class="card-img-top" src="`+ rutaImagen + `">

	                    <div class="card-img-overlay p-0 pr-3">
	                      
	                       <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoNueva" temporal>
	                         
	                         <i class="fas fa-times"></i>

	                       </button>

	                    </div>

	                </li>

      			`)


				if (archivosTemporales.length != 0) {
					archivosTemporales = JSON.parse($(".inputNuevaGaleria").val());
				}

				archivosTemporales.push(rutaImagen);
				$(".inputNuevaGaleria").val(JSON.stringify(archivosTemporales))
			})
		}
	}
}

//quitar imagen
$(document).on("click", ".quitarFotoNueva", function () {

	var listaFotosNuevas = $(".quitarFotoNueva");

	var listaTemporales = JSON.parse($(".inputNuevaGaleria").val());

	for (var i = 0; i < listaFotosNuevas.length; i++) {

		$(listaFotosNuevas[i]).attr("temporal", listaTemporales[i]);

		var quitarImagen = $(this).attr("temporal");

		if (quitarImagen == listaTemporales[i]) {

			listaTemporales.splice(i, 1);

			$(".inputNuevaGaleria").val(JSON.stringify(listaTemporales));

			$(this).parent().parent().remove();

		}

	}

})

$(document).on("click", ".quitarFotoNueva", function () {
	var listaFotosNuevas = $(".quitarFotoNueva");
	var listaTemporales = JSON.parse($(".inputNuevaGaleria").val());

	for (var i = 0; i < listaFotosNuevas.length; i++) {
		$(listaFotosNuevas[i]).attr("temporal", listaTemporales[i]);
		var quitarImagen = $(this).attr("temporal");

		if (quitarImagen == listaTemporales[i]) {
			listaTemporales.splice(i, 1);
			$(".inputNuevaGaleria").val(JSON.stringify(listaTemporales));
			$(this).parent().parent().remove();
		}
	}
})