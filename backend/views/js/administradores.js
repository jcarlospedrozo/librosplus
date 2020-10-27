//Tabla administradores

// $.ajax({
//     "url":"ajax/tablaAdministradores.ajax.php",
// 	success: function(respuesta){
// 		console.log("respuesta", respuesta);
// 	}
// })

$("document").ready( function( ){
    $('.tablaAdministradores').DataTable({
        "ajax": "ajax/tablaAdministradores.ajax.php",
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

//Editar administrador
$(document).on("click", ".editarAdministrador", function () {
    var idAdministrador = $(this).attr("idAdministrador");

	var datos = new FormData();
  	datos.append("idAdministrador", idAdministrador);

  	$.ajax({
  		url:"ajax/administradores.ajax.php",
  		method: "POST",
  		data: datos,
  		cache: false,
		contentType: false,
    	processData: false,
    	dataType: "json",
    	success:function(respuesta){ 	
    		$('input[name="editarId"]').val(respuesta["idAdministrador"]);
    		$('input[name="editarNombre"]').val(respuesta["nombre"]);
    		$('input[name="editarUsuario"]').val(respuesta["usuario"]);
    		$('input[name="contrasenadActual"]').val(respuesta["contrasena"]);
    		$('.editarPerfilOption').val(respuesta["perfil"]);
    		$('.editarPerfilOption').html(respuesta["perfil"]);
    	}
  	})
})

//Activar o desactivar administrador
$(document).on("click", ".btnActivar", function(){
	var idAdmin = $(this).attr("idAdmin");
	var estadoAdmin = $(this).attr("estadoAdmin");
	var boton = $(this);

	var datos = new FormData();
  	datos.append("idAdmin", idAdmin);
  	datos.append("estadoAdmin", estadoAdmin);

    $.ajax({
        url:"ajax/administradores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == "ok"){
                if(estadoAdmin == 0){
                    $(boton).removeClass('btn-info');
                    $(boton).addClass('btn-dark');
                    $(boton).html('Desactivado');
                    $(boton).attr('estadoAdmin', 1);
                }else{
                    $(boton).addClass('btn-info');
                    $(boton).removeClass('btn-dark');
                    $(boton).html('Activado');
                    $(boton).attr('estadoAdmin',0);
                }
            }
        }
    })  
})

//Eliminar Administrador
$(document).on("click", ".eliminarAdministrador", function(){

	var idAdministrador = $(this).attr("idAdministrador");

	if(idAdministrador == 1){

		Swal.fire({
            icon: "error",
            title: "Error",
            text: "Este administrador no se puede eliminar"
        });
        return;
	}

	Swal.fire({
	    icon: 'warning',
	    text: '¿Está seguro de eliminar este administrador?',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, eliminar administrador!'
	  }).then((result) => {
	    if(result.value){
	    	var datos = new FormData();
            datos.append("idEliminar", idAdministrador);
               
       		$.ajax({
                url:"ajax/administradores.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){
                    if(respuesta == "ok"){
                        Swal.fire({
                        icon: "success",
                        title: "¡Correcto!",
                        text: "El administrador ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result) => {
                            if(result.value){
                                window.location = "administradores";
                            }
                        })
                    }
                }
	        })  
	    }
	})
})