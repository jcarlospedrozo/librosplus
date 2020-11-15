<?php

include_once "controllers/plantilla.controller.php";
include_once "controllers/ruta.controller.php";

include_once "controllers/administradores.controller.php";
include_once "models/administradores.model.php";

include_once "controllers/categorias.controller.php";
include_once "models/categorias.model.php";

include_once "controllers/libros.controller.php";
include_once "models/libros.model.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();