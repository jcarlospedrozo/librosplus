$("document").ready( function( ){
    $('.tablaAutores').DataTable({
        "ajax": "ajax/tablaAutores.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {
            "decimal":        "",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 to 0 de 0 registros",
            "infoFiltered":   "(filtrado de _MAX_ total registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se han encontrado registros",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": activar para ordenar la columna de manera ascendente",
                "sortDescending": ": activar para ordenar la columna de manera descendente"
            }
        }
    });
});

//Editar autor
$(document).on("click", ".editarAutor", function () {
    var idAutor = $(this).attr("idAutor");

	var datos = new FormData();
  	datos.append("idAutor", idAutor);

  	$.ajax({
  		url:"ajax/autores.ajax.php",
  		method: "POST",
  		data: datos,
  		cache: false,
		contentType: false,
    	processData: false,
    	dataType: "json",
    	success:function(respuesta){ 	
    		$('input[name="editarId"]').val(respuesta["idAutor"]);
    		$('input[name="editarAutor"]').val(respuesta["nombreAutor"]);
    	}
  	})
})

//Eliminar Categoria
$(document).on("click", ".eliminarAutor", function () {

    var idAutor = $(this).attr("idAutor");
    var nombreAutor = $(this).attr("nombreAutor");

    var datos = new FormData();
    datos.append("autorLibro", idAutor);

    $.ajax({
        url: "ajax/autores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta.length != 0) {
                Swal.fire({
                    title: "Este autor no se puede borrar",
                    text: "¡Tiene libros vinculados!",
                    icon: "error",
                    confirmButtonText: "¡Cerrar!"
                });
                return;
            }
        }
    })

    Swal.fire({
        title: '¿Está seguro de eliminar este Escritor?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar escritor!'
    }).then((result) => {
        if (result.value) {
            var datos = new FormData();
            datos.append("idEliminar", idAutor);
            datos.append("nombreAutor", nombreAutor);

            $.ajax({
                url: "ajax/autores.ajax.php",
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
                            text: "el escritor ha sido borrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "autores";
                            }
                        })
                    }
                }
            })
        }
    })
})