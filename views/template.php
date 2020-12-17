<?php
session_start();
$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>Libros Plus</title>

    <link rel="icon" href="views/img/logo1.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="views/js/datepicker/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="views/css/fullcalendar.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="views/css/style.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="views/js/moment.min.js"></script>
	<script src="views/js/fullcalendar/fullcalendar.min.js"></script>
	<script src="views/js/fullcalendar/fullcalendar.js"></script>
	<script src="views/js/fullcalendar/locale/es.js"></script>
	<script src="views/js/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="views/js/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script></head>
<body>
<?php
include 'paginas/modulos/header.php';
// include "paginas/modulos/modal.php";

if(isset($_GET["pagina"])){

	$rutasCategorias = ControladorCategorias::ctrMostrarCategorias();

	$validarRuta = "";

	foreach ($rutasCategorias as $key => $value) {
		if($_GET["pagina"] == $value["rutaCategoria"]){
			$validarRuta = "todos";
		}
	}

	$item = "emailEncriptado";
	$valor = $_GET["pagina"];

	$validarCorreo = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

	if($validarCorreo["emailEncriptado"] == $_GET["pagina"]){

		$id = $validarCorreo["idUsuario"];
		$item = "verificacion";
		$valor = 1;

		$verificarUsuario = ControladorUsuarios::ctrActualizarUsuario($id, $item, $valor);
		if($verificarUsuario == "ok"){
			echo'<script>
					Swal.fire({
						icon:"success",
						title: "¡Correcto!",
						text: "¡Su cuenta ha sido verificada, ya puede ingresar al sistema!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if(result.value){   
							history.back();
						} 
					})
				</script>';
			return;
		}
	}


	if($_GET["pagina"] == "informacion" || $_GET["pagina"] == "reservas" || $_GET["pagina"] == "login" || $_GET["pagina"] == "register" || $_GET["pagina"] == "perfil"  || $_GET["pagina"] == "salir"){

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



?>
<input type="hidden" value="<?php echo $ruta; ?>" id="urlPrincipal">
<input type="hidden" value="<?php echo $servidor; ?>" id="urlServidor">

<script src="views/js/plantilla.js"></script>
<script src="views/js/libros-shopping.js"></script>
<script src="views/js/reserva.js"></script>
<script src="views/js/usuarios.js"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '770126790213592',
      xfbml      : true,
      version    : 'v8.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>