<?php

Class ControladorDetalleLibro{
	static public function ctrMostrarDetalleLibro($valor){
		$tabla = "libros";
		$respuesta = ModeloDetalleLibro::mdlMostrarDetalleLibro($tabla, $valor);
		return $respuesta;
	}
}