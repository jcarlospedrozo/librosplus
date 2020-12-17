<?php

Class ControladorReservas{
	static public function ctrMostrarReservas($valor){
		$tabla1 = "libros";
		$tabla2 = "reservas";
		$respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $valor);
		return $respuesta;
	}

	static public function ctrMostrarCodigoReserva($valor)
	{
		$tabla = "reservas";
		$respuesta = ModeloReservas::mdlMostrarCodigoReserva($tabla, $valor);
		return $respuesta;
	}

	static public function ctrGuardarReserva($valor)
	{
		$tabla = "reservas";
		$respuesta = ModeloReservas::mdlGuardarReserva($tabla, $valor);
		return $respuesta;
		if($respuesta != ""){
			// $tablaTestimonios = "testimonios";
			// $datos = array("id_res" => $respuesta,
			// 			   "id_us" => $valor["id_usuario"],
			// 			   "id_hab" => $valor["id_habitacion"],
			// 			   "testimonio" => "",
			// 			   "aprobado" => 0);

			// $crearTestimonio = ModeloReservas::mdlCrearTestimonio($tablaTestimonios, $datos);
			// return $crearTestimonio;
			$traerNotificaciones = ModeloReservas::mdlMostrarNotificaciones("notificaciones", "reservas");
			$cantidad = $traerNotificaciones["cantidad"] + 1;

			$actualizarNotificaciones = ModeloReservas::mdlActualizarNotificaciones("notificaciones", "reservas", $cantidad);
		}
	}

	static public function ctrMostrarReservasUsuario($valor){
		$tabla = "reservas";
		$respuesta = ModeloReservas::mdlMostrarReservasUsuario($tabla, $valor);
		return $respuesta;
	}
}
