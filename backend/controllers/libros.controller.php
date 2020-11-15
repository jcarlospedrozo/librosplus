<?php

class ControladorLibros{
    //Mostrar libros
    static public function ctrMostrarLibros($valor){
		$tabla1 = "categorias";
		$tabla2 = "libros";

		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $valor);
		return $respuesta;
	}
}