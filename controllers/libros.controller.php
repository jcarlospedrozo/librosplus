<?php

Class ControladorLibros{
	static public function ctrMostrarLibros($valor){
		$tabla1 = "categorias";
		$tabla2 = "libros";
		$tabla3 = "autores";
		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor);
		return $respuesta;
	}
}