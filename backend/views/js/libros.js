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

ClassicEditor.create(document.querySelector('#descripcionLibro'), {

    toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor) {

    $(".ck-content").css({ "height": "400px" })

}).catch(function (error) {

    // console.log("error", error);

})

$("#fotoLibro").change(function () {
    var imagen = this.files[0];
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $("input[name='subirImgLibro']").val("");
        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagen["size"] > 2000000) {
        $("input[name='subirImgLibro']").val("");
        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;

            $(".subirImgLibro").html(

                `<img class="previsualizarImgLibroNueva" src="` + rutaImagen + `">`

            )
            // $(".previsualizarImgLibro").attr("src", rutaImagen);
        })
    }
})

/*=============================================
GUARDAR LIBRO
=============================================*/

$(".guardarLibro").click(function () {

    var idLibro = $(".idLibro").val();

    var idCategoria = $(".seleccionarCategoria").val().split(",")[0];
    var nombreCategoria = $(".seleccionarCategoria").val().split(",")[1];

    var idAutor = $(".seleccionarAutor").val().split(",")[0];
    var nombreAutor = $(".seleccionarAutor").val().split(",")[1];

    var nombreLibro = $(".seleccionarLibro").val();

    var fotoLibro = $(".previsualizarImgLibroNueva").attr("src");
    var fotoLibroAntigua = $(".fotoLibroAntigua").val();

    var precioLibro = $(".seleccionarPrecio").val();

    var descripcionLibro = $(".ck-content").html();


    if (nombreCategoria == "" || idCategoria == "") {

        Swal.fire({
            title: "Error al guardar",
            text: "El campo 'Seleccionar categoria' no puede ir vacío",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    } if (nombreAutor == "" || idAutor == "") {

        Swal.fire({
            title: "Error al guardar",
            text: "El campo 'Seleccionar autor' no puede ir vacío",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    } else if (nombreLibro == "") {

        Swal.fire({
            title: "Error al guardar",
            text: "El campo 'Nombrelibro' no puede ir vacío",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    } else if (descripcionLibro == "") {

        Swal.fire({
            title: "Error al guardar",
            text: "El campo de 'Descripción' no puede ir vacío",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    } else if (precioLibro == "") {

        Swal.fire({
            title: "Error al guardar",
            text: "El campo de 'Precio' no puede ir vacío",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    } else {

        var datos = new FormData();
        datos.append("idLibro", idLibro);
        datos.append("nombreLibro", nombreLibro);
        datos.append("descripcionLibro", descripcionLibro);
        datos.append("fotoLibro", fotoLibro);
        datos.append("fotoLibroAntigua", fotoLibroAntigua);
        datos.append("precioLibro", precioLibro);
        datos.append("idCategoria", idCategoria);
        datos.append("nombreCategoria", nombreCategoria);
        datos.append("idAutor", idAutor);
        datos.append("nombreAutor", nombreAutor);
        // datos.append("galeria", galeria);
        // datos.append("galeriaAntigua", galeriaAntigua);
        // datos.append("video", video);
        // datos.append("antiguoRecorrido", antiguoRecorrido);

        $.ajax({

            url: "ajax/libros.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {

                var xhr = $.ajaxSettings.xhr();

                xhr.onprogress = function (evt) {

                    var porcentaje = Math.floor((evt.loaded / evt.total * 100));

                    $(".preload").before(`

		    			<div class="progress mt-3" style="height:2px">
		    			<div class="progress-bar" style="width: `+ porcentaje + `%;"></div>
		    			</div>`
                    )

                };

                return xhr;

            },
            success: function (respuesta) {

                if (respuesta == "ok") {

                    Swal.fire({
                        icon: "success",
                        title: "¡Correcto!",
                        text: "¡El libro ha sido guardado exitosamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then((result) => {

                        if (result.value) {

                            window.location = "libros";

                        }

                    });

                }

            }

        })


    }


})

/*=============================================
Eliminar Habitacion
=============================================*/

$(document).on("click", ".eliminarLibro", function () {

    var idEliminar = $(this).attr("idEliminar");

    var imagenLibro = $(this).attr("imagenLibro");

    // var recorridoHabitacion = $(this).attr("recorridoHabitacion");

    Swal.fire({
        title: '¿Está seguro de eliminar este libro?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar'
    }).then((result) => {

        if (result.value) {

            var datos = new FormData();
            datos.append("idEliminar", idEliminar);
            datos.append("imagenLibro", imagenLibro);
            // datos.append("recorridoHabitacion", recorridoHabitacion);

            $.ajax({

                url: "ajax/libros.ajax.php",
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
                            text: "El libro ha sido borrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {

                            if (result.value) {

                                window.location = "libros";

                            }
                        })

                    }

                }

            })
        }

    })

})
