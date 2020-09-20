<?php

require_once "controllers/template.controller.php";
require_once "controllers/ruta.controller.php";

require_once "controllers/categorias.controller.php";
require_once "models/categorias.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
