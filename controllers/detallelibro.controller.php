<?php

Class ControladorDetalleLibro{
	static public function ctrMostrarDetalleLibro($valor){
		$tabla1 = "libros";
		$tabla2 = "categorias";
		$respuesta = ModeloDetalleLibro::mdlMostrarDetalleLibro($tabla1, $tabla2, $valor);
		return $respuesta;
	}
}