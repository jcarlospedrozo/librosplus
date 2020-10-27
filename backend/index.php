<?php

include_once "controllers/plantilla.controller.php";
include_once "controllers/ruta.controller.php";

include_once "controllers/administradores.controller.php";
include_once "models/administradores.model.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();