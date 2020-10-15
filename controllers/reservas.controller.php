<?php

Class ControladorReservas{
	static public function ctrMostrarReservas($valor){
		$tabla1 = "libros";
		$tabla2 = "reservas";
		$tabla3 = "categorias";
		$respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);
		return $respuesta;
	}

	static public function ctrMostrarCodigoReserva($valor)
	{
		$tabla = "reservas";
		$respuesta = ModeloReservas::mdlMostrarCodigoReserva($tabla, $valor);
		return $respuesta;
	}
}