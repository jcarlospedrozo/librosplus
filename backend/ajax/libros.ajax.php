<?php

require_once "../controllers/libros.controller.php";
require_once "../models/libros.model.php";

class AjaxLibros{

    public $nombreLibro;
    public $descripcionLibro;
    public $fotoLibro;
    public $precioLibro;
	public $idCategoria;
	public $nombreCategoria;
    public $idAutor;
    public $idLibro;
    public $fotoLibroAntigua;

	//Nuevo libro
	public function ajaxNuevolibro(){
	
		$datos = array( "nombreLibro" => $this->nombreLibro,
                        "descripcionLibro" => $this->descripcionLibro,
                        "fotoLibro" => $this->fotoLibro,
                        "precioLibro" => $this->precioLibro,
                        "idCategoria" => $this->idCategoria,
                        "nombreCategoria" => $this->nombreCategoria,
						"idAutor" => $this->idAutor);

		$respuesta = ControladorLibros::ctrNuevoLibro($datos);

		echo $respuesta;

	}

	//Editar libro
	public function ajaxEditarLibro(){
	
		$datos = array( "idLibro" => $this->idLibro,
                        "nombreLibro" => $this->nombreLibro,
                        "descripcionLibro" => $this->descripcionLibro,
						"fotoLibro" => $this->fotoLibro,
						"fotoLibroAntigua" => $this->fotoLibroAntigua,
                        "idCategoria" => $this->idCategoria,
						"nombreCategoria" => $this->nombreCategoria,
						"idAutor" => $this->idAutor);

		$respuesta = ControladorLibros::ctrEditarLibro($datos);

		echo $respuesta;

	}

	//Eliminar habitación

	public $idEliminar;
	public $fotoLibro1;

	public function ajaxEliminarLibro(){
	
		$datos = array( "idEliminar" => $this->idEliminar,
						"fotoLibro" => $this->fotoLibro1);

		$respuesta = ControladorLibros::ctrEliminarLibro($datos);

		echo $respuesta;

	}

}

//Guardar libro

if(isset($_POST["nombreCategoria"])){

	$libro = new AjaxLibros();
    $libro -> nombreLibro = $_POST["nombreLibro"];
	$libro -> descripcionLibro = $_POST["descripcionLibro"];
    $libro -> fotoLibro = $_POST["fotoLibro"];
    $libro -> fotoLibroAntigua = $_POST["fotoLibroAntigua"];
    $libro -> precioLibro = $_POST["precioLibro"];
	$libro -> idCategoria = $_POST["idCategoria"];
	$libro -> nombreCategoria = $_POST["nombreCategoria"];
	$libro -> idAutor = $_POST["idAutor"];

    if($_POST["idLibro"] != ""){

    	$libro -> idLibro = $_POST["idLibro"];
    	$libro -> ajaxEditarLibro();

    }else{

    	$libro -> ajaxNuevoLibro();

    }
  
}


//Eliminar habitación

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxLibros();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> fotoLibro = $_POST["fotoLibro"];
    $eliminar -> ajaxEliminarLibro();
	
}