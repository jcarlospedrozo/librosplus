<?php

include_once "controllers/plantilla.controller.php";
include_once "controllers/ruta.controller.php";

include_once "controllers/administradores.controller.php";
include_once "models/administradores.model.php";

include_once "controllers/categorias.controller.php";
include_once "models/categorias.model.php";

include_once "controllers/libros.controller.php";
include_once "models/libros.model.php";

include_once "controllers/autores.controller.php";
include_once "models/autores.model.php";

include_once "controllers/reservas.controller.php";
include_once "models/reservas.model.php";

include_once "controllers/usuarios.controller.php";
include_once "models/usuarios.model.php";

include_once "controllers/inicio.controller.php";
include_once "models/inicio.model.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();