<?php

require_once "controllers/template.controller.php";
require_once "controllers/ruta.controller.php";

require_once "controllers/categorias.controller.php";
require_once "models/categorias.modelo.php";

require_once "controllers/libros.controller.php";
require_once "models/libros.modelo.php";

require_once "controllers/autores.controller.php";
require_once "models/autores.modelo.php";

require_once "controllers/detallelibro.controller.php";
require_once "models/detallelibro.modelo.php";

require_once "controllers/reservas.controller.php";
require_once "models/reservas.modelo.php";

require_once "controllers/usuarios.controller.php";
require_once "models/usuarios.modelo.php";

require_once "vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
