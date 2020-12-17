<?php

require_once "../controllers/libros.controller.php";
require_once "../models/libros.model.php";

class AjaxLibros{

	public $idLibro;
	public $nombreLibro;
    public $descripcionLibro;
    public $fotoLibro;
    public $fotoLibroAntigua;
    public $precioLibro;
    public $idCategoria;
    public $nombreCategoria;
    public $idAutor;
    public $nombreAutor;

	/*=============================================
	NuevoLibro
	=============================================*/	

	public function ajaxNuevoLibro(){
	
		$datos = array( "nombreLibro" => $this->nombreLibro,
						"descripcionLibro" => $this->descripcionLibro,
						"fotoLibro" => $this->fotoLibro,
						"precioLibro" => $this->precioLibro,
						"idCategoria" => $this->idCategoria,
						"nombreCategoria" => $this->nombreCategoria,
                        "idAutor" => $this->idAutor,
                        "nombreAutor" => $this->nombreAutor);

		$respuesta = ControladorLibros::ctrNuevoLibro($datos);

		echo $respuesta;

	}

	/*=============================================
	Editar habitación
	=============================================*/	

	public function ajaxEditarLibro(){
	
		$datos = array( "idLibro" => $this->idLibro,
                        "nombreLibro" => $this->nombreLibro,
						"descripcionLibro" => $this->descripcionLibro,
						"fotoLibro" => $this->fotoLibro,
						"fotoLibroAntigua" => $this->fotoLibroAntigua,
						"precioLibro" => $this->precioLibro,
						"idCategoria" => $this->idCategoria,
						"nombreCategoria" => $this->nombreCategoria,
                        "idAutor" => $this->idAutor,
                        "nombreAutor" => $this->nombreAutor);

		$respuesta = ControladorLibros::ctrEditarLibro($datos);

		echo $respuesta;

	}

	/*=============================================
	Eliminar libro
	=============================================*/	

	public $idEliminar;
	public $imagenLibro;

	public function ajaxEliminarLibro(){
	
		$datos = array( "idEliminar" => $this->idEliminar,
						"imagenLibro" => $this->imagenLibro);

		$respuesta = ControladorLibros::ctrEliminarLibro($datos);

		echo $respuesta;

	}

}

/*=============================================
Guardar habitación
=============================================*/	

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
    $libro -> nombreAutor = $_POST["nombreAutor"];

    // if($_POST["idLibro"] != ""){

    // 	$libro -> idLibro = $_POST["idLibro"];
    // 	$libro -> ajaxEditarLibro();

    // }else{

    	$libro -> ajaxNuevoLibro();

    // }
  
}

/*=============================================
Eliminar habitación
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxLibros();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> imagenLibro = $_POST["imagenLibro"];
    // $eliminar -> recorridoHabitacion = $_POST["recorridoHabitacion"];
    $eliminar -> ajaxEliminarLibro();
	
}