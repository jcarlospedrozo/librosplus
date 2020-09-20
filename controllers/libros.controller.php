<?php

Class ControladorLibros{
	static public function ctrMostrarLibros(){
		$tabla = "libros";
		$respuesta = ModeloLibros::mdlMostrarLibros($tabla);
		return $respuesta;
	}
}