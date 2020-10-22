$('.fecha-reserva.desde').datepicker({
    format: "yyyy-mm-dd",
    startDate: '0d',
    datesDisabled: '0d',
	todayHighlight:true
});

$('.fecha-reserva.desde').change(function(){

    $('.fecha-reserva.hasta').attr("readonly", false);
      
    var fechaEntrada = $(this).val();
  
    $('.fecha-reserva.hasta').datepicker({
        startDate: fechaEntrada,
        datesDisabled: fechaEntrada,
        format: 'yyyy-mm-dd',
        language: "es"
    });
 })

if($(".infoReservas").html() != undefined){

    var idLibro = $('.infoReservas').attr('idLibro')
    var fechaDesde = $('.infoReservas').attr('fechaDesde')
    var fechaHasta = $('.infoReservas').attr('fechaHasta')
    var totalEventos = []
    var opcion1 = []
    var opcion2 = []
    var opcion3 = []
    var validarDisponibilidad = false

    var datos = new FormData();
    datos.append("idLibro", idLibro)

    $.ajax({

        url:urlPrincipal+"ajax/reservas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            if(respuesta.length == 0){
                $('#calendar').fullCalendar({
                    defaultDate: fechaDesde,
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    events: [
                      {
                        start: fechaDesde,
                        end: fechaHasta,
                        rendering: 'background',
                        color: '#FFCC29'
                      }
                    ]
                });
                colDerReservas()
            }
            else {
                for (let i = 0; i < respuesta.length; i++) {

                    //validar opcion 1
                    if (fechaDesde == respuesta[i]["fechaDespacho"]) {
                        opcion1[i] = false;
                    } else {
                        opcion1[i] = true;
                    }

                    //validar opcion 2
                    if (fechaDesde > respuesta[i]["fechaDespacho"] && fechaDesde < respuesta[i]["fechaDevolucion"]) {
                        opcion2[i] = false;
                    } else {
                        opcion2[i] = true;
                    }

                    //validar opcion 3
                    if (fechaDesde < respuesta[i]["fechaDespacho"] && fechaHasta > respuesta[i]["fechaDespacho"]) {
                        opcion3[i] = false;
                    } else {
                        opcion3[i] = true;
                    }

                    //validar disponibilidad
                    if (opcion1[i] == false || opcion2[i] == false || opcion3[i] == false) {
                        validarDisponibilidad = false
                    } else {
                        validarDisponibilidad = true
                    }

                    if (!validarDisponibilidad) {
                        totalEventos.push({
                            "start": respuesta[i]["fechaDespacho"],
                            "end": respuesta[i]["fechaDevolucion"],
                            "rendering": 'background',
                            "color": '#847059'
                        })

                        $(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>')
                        break
                    } else {
                        totalEventos.push({
                            "start": respuesta[i]["fechaDespacho"],
                            "end": respuesta[i]["fechaDevolucion"],
                            "rendering": 'background',
                            "color": '#847059'
                        })
                        $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>');
                        colDerReservas()
                    }
                }

                if (validarDisponibilidad) {
                    totalEventos.push({
                        "start": fechaDesde,
                        "end": fechaHasta,
                        "rendering": 'background',
                        "color": '#FFCC29'
                    })
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
        }
    })

    var caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"

    function codigoAleatorio(caracteres, longitud) {
        codigo = ""
        for (let i = 0; i < longitud; i++) {
            rand = Math.floor(Math.random() * caracteres.length)
            codigo += caracteres.substr(rand, 1)
        }

        return codigo
    }

    function colDerReservas() {
        $(".colDerReservas").show()

        var codigoReserva = codigoAleatorio(caracteres, 9)

        var datos = new FormData();
        datos.append("codigoReserva", codigoReserva);
     
        $.ajax({
            url:urlPrincipal+"ajax/reservas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                if (!respuesta) {
                    $(".codigoReserva").html(codigoReserva)
                    $(".pagarReserva").attr("codigoReserva", codigoReserva)
                } else {
                    $(".codigoReserva").html(codigoReserva + codigoAleatorio(caracteres, 3))
                    $(".pagarReserva").attr("codigoReserva", codigoReserva + codigoAleatorio(caracteres, 3))
                }
            }
        })
    }
}

/*=============================================
FUNCIÓN PARA GENERAR COOKIES
=============================================*/

function crearCookie(nombre, valor, diasExpedicion){
    var hoy = new Date();
    hoy.setTime(hoy.getTime() + (diasExpedicion * 24 * 60 * 60 * 1000));
    var fechaExpedicion = "expires=" + hoy.toUTCString();
    document.cookie = nombre + "=" + valor + "; " + fechaExpedicion;
}

$(".pagarReserva").click(function(){
    var idLibro = $(this).attr("idLibro");
    var imgLibro = $(this).attr("imgLibro");
    var nombreLibro = $(this).attr("nombreLibro");
    var pagoReserva = $(this).attr("pagoReserva");
    var codigoReserva = $(this).attr("codigoReserva");
    var fechaIngreso = $(this).attr("fechaIngreso");
    var fechaSalida = $(this).attr("fechaSalida");
  
    crearCookie("idLibro", idLibro, 1);
    crearCookie("imgLibro", imgLibro, 1);
    crearCookie("nombreLibro", nombreLibro, 1);
    crearCookie("pagoReserva", pagoReserva, 1);
    crearCookie("codigoReserva", codigoReserva, 1);
    crearCookie("fechaIngreso", fechaIngreso, 1);
    crearCookie("fechaSalida", fechaSalida, 1);
})