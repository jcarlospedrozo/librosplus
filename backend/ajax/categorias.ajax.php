<?php

include_once "../controllers/categorias.controller.php";
include_once "../models/categorias.model.php";

class AjaxCategorias {

	//Editar categorias
	public $idCategoria;
	public function ajaxMostrarCategoria(){
		$respuesta = ControladorCategorias::ctrMostrarCategorias("idCategoria", $this->idCategoria);
		echo json_encode($respuesta);
	}

	//Validar existencia de habitaciones en categoría
	public $categoriaLibro;
	public function ajaxValidarCategoria(){
		$respuesta = ControladorCategorias::ctrValidarCategoria("idCategoria", $this->categoriaLibro);
		echo json_encode($respuesta);
	}

	//Eliminar Categoria
	public $idEliminar;
	public $imgCategoria;
	public $nombreCategoria;
	public function ajaxEliminarCategoria(){
		$respuesta = ControladorCategorias::ctrEliminarCategoria($this->idEliminar, $this->imgCategoria, $this->nombreCategoria);
		echo $respuesta;
	}
}

if(isset($_POST["idCategoria"])){

	$editar = new AjaxCategorias();
	$editar -> idCategoria = $_POST["idCategoria"];
	$editar -> ajaxMostrarCategoria();

}

//Validar existencia de libros en categoría
if(isset($_POST["categoriaLibro"])){
	$validar = new AjaxCategorias();
	$validar -> categoriaLibro = $_POST["categoriaLibro"];
	$validar -> ajaxValidarCategoria();
}

//Eliminar Categoria
if(isset($_POST["idEliminar"])){
	$eliminar = new AjaxCategorias();
	$eliminar -> idEliminar = $_POST["idEliminar"];
	$eliminar -> imgCategoria = $_POST["imgCategoria"];
	$eliminar -> nombreCategoria = $_POST["nombreCategoria"];
	$eliminar -> ajaxEliminarCategoria();
}