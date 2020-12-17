<?php

Class ControladorLibros{
	static public function ctrMostrarLibros($valor){
		$tabla1 = "categorias";
		$tabla2 = "libros";
		$tabla3 = "autores";
		$respuesta = ModeloLibros::mdlMostrarLibros($tabla1, $tabla2, $tabla3, $valor);
		return $respuesta;
	}

	static public function ctrMostrarLibro($valor){
		$tabla = "libros";
		$respuesta = ModeloLibros::mdlMostrarLibro($tabla, $valor);
		return $respuesta;
	}

	static public function ctrMostrarLibrosNuevos(){
<<<<<<< HEAD
		$tabla1 = "categorias";
		$tabla2 = "libros";
		$tabla3 = "autores";
		$respuesta = ModeloLibros::mdlMostrarLibrosNuevos($tabla1, $tabla2, $tabla3);
=======
		$tabla1 = "libros";
		$tabla2 = "autores";
		$respuesta = ModeloLibros::mdlMostrarLibrosNuevos($tabla1, $tabla2);
>>>>>>> gestion-backend
		return $respuesta;
	}
}