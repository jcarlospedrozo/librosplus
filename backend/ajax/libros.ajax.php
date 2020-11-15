<?php

require_once "../controladores/libros.controlador.php";
require_once "../modelos/libros.modelo.php";

class AjaxLibros{

	public $idCategoria;
	public $nombreCategoria;
    public $nombreLibro;
    public $precioLibro;
    public $autorLibro;
    public $galeria;
    public $descripcionLibro;
    public $idLibro;
    public $galeriaAntigua;

	//Nuevo libro
	public function ajaxNuevolibro(){
	
		$datos = array( "nombreLibro" => $this->nombreLibro,
                        "descripcionLibro" => $this->descripcionLibro,
                        "galeria" => $this->galeria,
                        "precioLibro" => $this->precioLibro,
                        "idCategoria" => $this->idCategoria,
                        "nombreCategoria" => $this->nombreCategoria,
                        "autorLibro" => $this->autorLibro);

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
						"galeria" => $this->galeria,
						"galeriaAntigua" => $this->galeriaAntigua,
                        "idCategoria" => $this->idCategoria,
                        "nombreCategoria" => $this->nombreCategoria,

		$respuesta = ControladorHabitaciones::ctrEditarHabitacion($datos);

		echo $respuesta;

	}

	/*=============================================
	Eliminar habitación
	=============================================*/	

	public $idEliminar;
	public $galeriaHabitacion;
	public $recorridoHabitacion;

	public function ajaxEliminarHabitacion(){
	
		$datos = array( "idEliminar" => $this->idEliminar,
						"galeriaHabitacion" => $this->galeriaHabitacion,
						"recorridoHabitacion" => $this->recorridoHabitacion);

		$respuesta = ControladorHabitaciones::ctrEliminarHabitacion($datos);

		echo $respuesta;

	}

}

//Guardar libro

if(isset($_POST["tipo"])){

	$libro = new AjaxLibros();
	$libro -> idCategoria = $_POST["idCategoria"];
	$libro -> nombreCategoria = $_POST["nombreCategoria"];
    $libro -> nombreLibro = $_POST["nombreLibro"];
    $libro -> galeria = $_POST["galeria"];
    $libro -> galeriaAntigua = $_POST["galeriaAntigua"];
    $libro -> descripcion = $_POST["descripcion"];

    if($_POST["idLibro"] != ""){

    	$libro -> idLibro = $_POST["idLibro"];
    	$libro -> ajaxEditarLibro();

    }else{

    	$libro -> ajaxNuevoLibro();

    }
  
}

/*=============================================
Eliminar habitación
=============================================*/	

if(isset($_POST["idEliminar"])){

	$eliminar = new AjaxLibros();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> galeriaHabitacion = $_POST["galeriaHabitacion"];
    $eliminar -> recorridoHabitacion = $_POST["recorridoHabitacion"];
    $eliminar -> ajaxEliminarHabitacion();
	
}