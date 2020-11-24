<?php

class ControladorInicio{

	/*=============================================
	SUMAR VENTAS
	=============================================*/

	static public function ctrSumarVentas(){

		$tabla = "reservas";

		$respuesta = ModeloInicio::mdlSumarVentas($tabla);
		
		return $respuesta;

	}	

	/*=============================================
	MEJOR HABITACIÓN
	=============================================*/

	static public function ctrMejorLibro(){

		$tabla1 = "reservas";
		$tabla2 = "libros";

		$respuesta = ModeloInicio::mdlMejorLibro($tabla1, $tabla2);
		
		return $respuesta;

	}	

	/*=============================================
	PEOR HABITACIÓN
	=============================================*/

	static public function ctrPeorHabitacion(){

		$tabla1 = "reservas";
		$tabla2 = "libros";

		$respuesta = ModeloInicio::mdlPeorLibro($tabla1, $tabla2);
		
		return $respuesta;

	}	

	/*=============================================
	TRAER FOTO HABITACIÓN
	=============================================*/

	static public function ctrTraerFotoLibro($valor){

		$tabla1 = "reservas";
		$tabla2 = "libros";

		$respuesta = ModeloInicio::mdlTraerFotoLibro($tabla1, $tabla2, $valor);
		
		return $respuesta;

	}	

	/*=============================================
	Mostrar notificaciones
	=============================================*/

	static public function ctrMostrarNotificaciones(){

		$tabla = "notificaciones";

		$respuesta = ModeloInicio::mdlMostrarNotificaciones($tabla);
		
		return $respuesta;

	}	

	/*=============================================
	Actualizar notificaciones
	=============================================*/

	static public function ctrActualizarNotificaciones($tipo, $cantidad){

		$tabla = "notificaciones";

		$respuesta = ModeloInicio::mdlActualizarNotificaciones($tabla, $tipo, $cantidad);
		
		return $respuesta;

	}	


}