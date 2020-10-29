//Tabla administradores

// $.ajax({
//     "url":"ajax/tablaCategorias.ajax.php",
// 	success: function(respuesta){
// 		console.log("respuesta", respuesta);
// 	}
// })

$("document").ready( function( ){
    $('.tablaCategorias').DataTable({
        "ajax": "ajax/tablaCategorias.ajax.php",
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
    })
})

//Subir imagen temporal Categoria
$("input[name='subirImgCategoria'], input[name='editarImgCategoria']").change(function(){
    var imagen = this.files[0];    
    /*=============================================
      VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
      =============================================*/  
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");
        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){
        $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");
        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });
    }else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".previsualizarImgCategoria").attr("src", rutaImagen);
        })
    }
})

//Ruta Categorias
function limpiarUrl(texto){
	var texto = texto.toLowerCase();
	texto = texto.replace(/[á]/g, 'a');
	texto = texto.replace(/[é]/g, 'e');
	texto = texto.replace(/[í]/g, 'i');
	texto = texto.replace(/[ó]/g, 'o');
	texto = texto.replace(/[ú]/g, 'u');
	texto = texto.replace(/[ñ]/g, 'n');
    texto = texto.replace(/ /g, '-');
    
	return texto;
}

$(document).on("keyup", "input[name='rutaCategoria']", function(){
	$("input[name='rutaCategoria']").val(
		limpiarUrl($("input[name='rutaCategoria']").val())
	)
})

//Editar Categoria
$(document).on("click", ".editarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");
  
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
  
    $.ajax({
        url:"ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            // console.log("respuesta", respuesta);
    
            $('input[name="idCategoria"]').val(respuesta["idCategoria"]);
            $('input[name="editarRutaCategoria"]').val(respuesta["rutaCategoria"]);        
            $('input[name="editarNombreCategoria"]').val(respuesta["nombreCategoria"]);
            $('input[name="imgCategoriaActual"]').val(respuesta["imagenCategoria"]);
            $('.previsualizarImgCategoria').attr("src", respuesta["imagenCategoria"]);  
        }
    })  
})

//Eliminar Categoria
$(document).on("click", ".eliminarCategoria", function () {

    var idCategoria = $(this).attr("idCategoria");
    var imgCategoria = $(this).attr("imgCategoria");
    var nombreCategoria = $(this).attr("nombreCategoria");

    var datos = new FormData();
    datos.append("categoriaLibro", idCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta.length != 0) {
                Swal.fire({
                    title: "Esta categoría no se puede borrar",
                    text: "¡Tiene libros vinculados!",
                    icon: "error",
                    confirmButtonText: "¡Cerrar!"
                });
                return;
            }
        }
    })

    Swal.fire({
        title: '¿Está seguro de eliminar este Categoría?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar Categoría!'
    }).then((result) => {
        if (result.value) {
            var datos = new FormData();
            datos.append("idEliminar", idCategoria);
            datos.append("imgCategoria", imgCategoria);
            datos.append("nombreCategoria", nombreCategoria);

            $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    if (respuesta == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "¡CORRECTO!",
                            text: "La categoria ha sido borrada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "categorias";
                            }
                        })
                    }
                }
            })
        }
    })
})