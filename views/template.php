<?php
$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros Plus</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="views/js/datepicker/css/bootstrap-datepicker.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="views/css/style.css">

	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="views/js/datepicker/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
<?php
include 'paginas/modulos/header.php';
if(isset($_GET["pagina"])){

	$rutasCategorias = ControladorCategorias::ctrMostrarCategorias();

	$validarRuta = "";

	foreach ($rutasCategorias as $key => $value) {

		if($_GET["pagina"] == $value["nombreCategoria"]){

			$validarRuta = "todos";

		}
		
	}

	if($_GET["pagina"] == "informacion"){

		include "paginas/".$_GET["pagina"].".php";
		
	}else if($validarRuta != ""){

		include "paginas/todos.php";

	}else{

		echo '<script>

		window.location = "'.$ruta.'";

		</script>';
	}

}else{

	include "paginas/index.php";

}


/*=============================================
PÁGINAS
=============================================*/


include "paginas/modulos/footer.php";

//include "paginas/modules/modal.php";

?>

<script src="views/js/libros-shopping.js"></script>
<script src="views/js/reserva.js"></script>
</body>
</html>