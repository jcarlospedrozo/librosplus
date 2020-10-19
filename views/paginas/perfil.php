<?php

if (isset($_SESSION["validarSesion"])) {
    if ($_SESSION["validarSesion"] == "ok") {
        include "modulos/info-perfil.php";
    }
} else {
    echo '<script> window.location="'.$ruta.'"</script>';
}
?>