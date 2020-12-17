<?php

include_once "../controllers/autores.controller.php";
include_once "../models/autores.model.php";

class AjaxAutores {
    //Editar administrador
    public $idAutor;

	public function ajaxMostrarAutores(){
		$item = "idAutor";
		$valor = $this->idAutor;

		$respuesta = ControladorAutores::ctrMostrarAutores($item, $valor);
		echo json_encode($respuesta);
    }
    
    //Validar existencia de habitaciones en categoría
	public $autorLibro;
	public function ajaxValidarAutor(){
		$respuesta = ControladorAutores::ctrValidarAutor("idAutor", $this->autorLibro);
		echo json_encode($respuesta);
	}

    //Eliminar Categoria
	public $idEliminar;
	public $nombreAutor;
	public function ajaxEliminarAutor(){
		$respuesta = ControladorAutores::ctrEliminarAutor($this->idEliminar, $this->nombreAutor);
		echo $respuesta;
	}

}

//Editar administrador
if(isset($_POST["idAutor"])){
	
	$editar = new AjaxAutores();
	$editar -> idAutor = $_POST["idAutor"];
	$editar -> ajaxMostrarAutores();
	
}

//Validar existencia de libros en categoría
if(isset($_POST["autorLibro"])){
	$validar = new AjaxAutores();
	$validar -> autorLibro = $_POST["autorLibro"];
	$validar -> ajaxValidarAutor();
}

//Eliminar Administrador

if(isset($_POST["idEliminar"])){
	$eliminar = new AjaxAutores();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> nombreCategoria = $_POST["nombreAutor"];
	$eliminar -> ajaxEliminarAutor();

}


