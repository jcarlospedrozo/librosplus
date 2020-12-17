<?php

Class ControladorCategorias{
	static public function ctrMostrarCategorias(){
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);
		return $respuesta;
	}

	static public function ctrMostrarCategoriasInicio(){
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategoriasInicio($tabla);
		return $respuesta;
	}
}