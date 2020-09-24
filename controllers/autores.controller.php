<?php

Class ControladorAutores{
	static public function ctrMostrarAutores(){
		$tabla = "autores";
		$respuesta = ModeloAutores::mdlMostrarAutores($tabla);
		return $respuesta;
	}
}