<?php
session_start();
$ruta = ControladorRuta::ctrRuta();
$rutaBackend = ControladorRuta::ctrRutaBackend();

if(isset($_SESSION["idBackend"])){
	$admin = ControladorAdministradores::ctrMostrarAdministradores("idAdministrador", $_SESSION["idBackend"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Libros Plus - Dashboard</title>

    <link rel="icon" href="views/img/plantilla/logo1.png">

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/datatables.min.css"/>
    <link rel="stylesheet" href="views/css/plugins/adminlte.min.css">
 
    
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script src="views/js/plugins/adminlte.min.js"></script>
</head>

<?php if(!isset($_SESSION["validarSesionBackend"])): 
    include "paginas/login.php";    
?>

<?php else:?>
<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <?php
        include "paginas/modulos/header.php";
        include "paginas/modulos/menu.php";
        // Navegacion de paginas
        if (isset($_GET["pagina"])) {
            if ($_GET["pagina"] == "inicio" || $_GET["pagina"] == "administradores" || $_GET["pagina"] == "categorias" || $_GET["pagina"] == "libros" || $_GET["pagina"] == "reservas" || $_GET["pagina"] == "usuarios" || $_GET["pagina"] == "salir") {
                include "paginas/".$_GET["pagina"].".php";
            } else {
                include "paginas/error404.php";
            }
        } else {
            include "paginas/inicio.php";
        }
        include "paginas/modulos/footer.php";
        ?>
    </div>
    <script src="views/js/administradores.js"></script>
    <script src="views/js/categorias.js"></script>
    <script src="views/js/libros.js"></script>
</body>
<?php endif ?>
</html>