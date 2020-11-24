<?php
$item = "idUsuario";
$valor = $_SESSION["idUsuario"];

$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);
$reservas = ControladorReservas::ctrMostrarReservasUsuario($valor);
$hoy = date("Y-m-d");
$noVencidas = 0;
$vencidas = 0;

foreach ($reservas as $key => $value) {
	
	if($hoy >= $value["fechaDespacho"]){
		++$vencidas;		
	}else{
		++$noVencidas;
	}
}

?>

<div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-4 colIzqPerfil p-0 px-lg-3">
				
				<div class="cabeceraPerfil pt-4">

				<?php if ($usuario["modoUsuario"] == "facebook"): ?>
					
					<a href="#" class="float-left lead pt-1 px-3 mb-4 salir" style="text-decoration: none;">
						<h5><i class='bx bx-exit'></i> Salir</h5>
					</a>

				<?php else: ?>
					<a href="<?php echo $ruta;  ?>salir" class="float-left lead pt-1 px-3 mb-4" style="text-decoration: none;">
						<h5><i class='bx bx-exit'></i> Salir</h5>
					</a>

				<?php endif ?>

					<div class="clearfix"></div>

					<h1 class="p-2 pb-lg-5 text-center text-lg-left">Mi Perfil</h1>	
				</div>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">
					
					<figure class="text-center imgPerfil">
							
					<?php if ($usuario["fotoUsuario"] == ""): ?>

						<img src="<?php echo $servidor; ?>views/img/usuarios/default/default.png" class="img-fluid rounded-circle" width="150px">

						<?php else: ?>

						<?php if ($usuario["modoUsuario"] == "directo"): ?>

							<img src="<?php echo $servidor.$usuario["fotoUsuario"]; ?>" class="img-fluid rounded-circle">

						<?php else: ?>	

							<img src="<?php echo $usuario["fotoUsuario"]; ?>" class="img-fluid rounded-circle">
							
						<?php endif ?>

					<?php endif ?>

					</figure>

					<div id="accordion">

						<div class="card">

							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapseOne">
									Mis reservas
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2 text-white" style="background:#CEC5B6"> <?php echo $vencidas; ?> Vencidas</li>
									<li class="px-2" style="background:#FFFDF4"> <?php echo $noVencidas; ?> Por vencerse</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

								<hr class="my-0">

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

							</div>

						</div>

						<div class="card">

							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
									Mis datos
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">
										
										<li class="list-group-item small"><?php echo $usuario["nombreUsuario"]; ?></li>
										<li class="list-group-item small"><?php echo $usuario["emailUsuario"]; ?></li>
										<?php if($usuario["modoUsuario"] == "directo"): ?>
										<li class="list-group-item small">
											<button class="btn btn-dark" data-toggle="modal" data-target="#cambiarPassword">Cambiar Contraseña</button>
										</li>
										<?php endif ?>

										
										<li class="list-group-item small">
											<button class="btn btn-primary" data-toggle="modal" data-target="#cambiarFotoPerfil">Cambiar Imagen</button>
										</li>

										<!-- Modal cambiar perfil-->
										<div class="modal fade" id="cambiarFotoPerfil" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<form action="" method="post" enctype="multipart/form-data">
														<div class="modal-header">
															<h4 class="modal-title">Cambiar Imagen</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<input type="hidden" name="idUsuarioFoto" value="<?php echo $usuario["idUsuario"]; ?>">

															<div class="form-group">
																<input type="file" class="form-control-file border" name="cambiarImagen" required>

																<input type="hidden" name="fotoActual" value="<?php echo $usuario["idUsuario"]; ?>">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

															<button type="submit" class="btn btn-primary">Enviar</button>
														</div>

														<?php
															$cambiarImagen = new ControladorUsuarios();
															$cambiarImagen -> ctrCambiarFotoPerfil();
														?>
													</form>
												</div>
											</div>
										</div>

										<!-- Modal cambiar password -->
										<div class="modal fade" id="cambiarPassword" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<form action="" method="post">
														<div class="modal-header">
															<h4 class="modal-title">Cambiar Contraseña</h4>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["idUsuario"]; ?>">

															<div class="form-group">
																<input type="password" class="form-control" name="editarPassword" placeholder="Cambiar Contraseña" required>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

															<button type="submit" class="btn btn-primary">Enviar</button>
														</div>
														<?php
															$cambiarPassword = new ControladorUsuarios();
															$cambiarPassword -> ctrCambiarPassword();
														?>
													</form>
												</div>
											</div>
										</div>


									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-8 colDerPerfil">

				<div class="row">

					<div class="col-6 d-none d-lg-block">
						
						<h4 class="float-left">Hola <?php echo $usuario["nombreUsuario"]; ?></h4>

					</div>

					<div class="col-12">

						<?php if(isset($_COOKIE["codigoReserva"])): ?>

							<?php

								$validarPagoReserva = false;
								$hoy = date("Y-m-d");

								if($hoy >= $_COOKIE["fechaIngreso"] || $hoy >= $_COOKIE["fechaSalida"]){
									echo '<div class="alert alert-danger">Lo sentimos, las fechas de la reserva no pueden ser igual o inferiores al día de hoy, vuelve a intentarlo.</div>';

									$validarPagoReserva = false;
								}else{
									$validarPagoReserva = true;
								}

								$valor = $_COOKIE["idLibro"];
								$validarReserva = ControladorReservas::ctrMostrarReservas($valor);
								// echo'<pre>'; print_r($validarReserva); echo'</pre>';

								$opcion01 = array();
								$opcion02 = array();
								$opcion03 = array();

								if ($validarReserva != 0) {
									foreach ($validarReserva as $key => $value) {
										
										/* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */     
										if($_COOKIE["fechaIngreso"] == $value["fechaDespacho"]){
											array_push($opcion01, false);
										}else{
											array_push($opcion01, true);
										}

										 /* VALIDAR CRUCE DE FECHAS OPCIÓN 2 */
										 if($_COOKIE["fechaIngreso"] > $value["fechaDespacho"] && $_COOKIE["fechaIngreso"] < $value["fechaDevolucion"]){
											array_push($opcion02, false);	
										}else{
											array_push($opcion02, true);
										} 
	
										 /* VALIDAR CRUCE DE FECHAS OPCIÓN 3 */
										 if($_COOKIE["fechaIngreso"] < $value["fechaDespacho"] && $_COOKIE["fechaSalida"] > $value["fechaDespacho"]){
											array_push($opcion03, false);
										}else{
											array_push($opcion03, true);
										}

										if($opcion01[$key] == false || $opcion02[$key] == false || $opcion03[$key] == false){

											$validarPagoReserva = false;
	
											echo 'Lo sentimos, las fechas de la reserva que habías seleccionado han sido ocupadas  
												<a href="'.$ruta.'" class="btn btn-danger btn-sm">vuelve a intentarlo </a>';
	
											break;	
	
										}else{
	
											$validarPagoReserva = true;
	
										}
									}
								}

							?>

							<?php if($validarPagoReserva): ?>

								<div class="card">
									<div class="card-header">
										Tienes una reserva pendiente por pagar
									</div>
									<div class="card-body text-center">
										<img src="<?php echo $_COOKIE["imgLibro"]; ?>" class="img-thumbnail  foto-libro w-50">
										<h5><strong><?php echo $_COOKIE["nombreLibro"]; ?></strong></h5>
										<h6> Desde <?php echo $_COOKIE["fechaIngreso"]; ?> Hasta <?php echo $_COOKIE["fechaSalida"]; ?></h6>
										<h4>$<?php echo number_format($_COOKIE["pagoReserva"]); ?></h4>

									</div>
									<div class="card-footer text-muted">
										<form action="<?php echo $ruta. 'perfil'; ?>" method="POST">
											<script
												src="https://www.mercadopago.com.co/integrations/v1/web-tokenize-checkout.js"
												data-public-key="TEST-9e06671a-e8d5-4e8e-aaf6-21f6591c4dca"
												data-transaction-amount="<?php echo $_COOKIE["pagoReserva"]; ?>"
												data-summary-product-label="<?php echo $_COOKIE["nombreLibro"]; ?>"
												data-summary-product="<?php echo $_COOKIE["pagoReserva"]; ?>">
											</script>
										</form>
									</div>
								</div>

								<?php 
									if (isset($_REQUEST["token"])) {
										$token = $_REQUEST["token"];
										// echo'<pre>'; print_r($token); echo'</pre>';
										$payment_method_id = $_REQUEST["payment_method_id"];
										// echo'<pre>'; print_r($payment_method_id); echo'</pre>';
										$installments = $_REQUEST["installments"];
										// echo'<pre>'; print_r($installments); echo'</pre>';
										$issuer_id = $_REQUEST["issuer_id"];
										// echo'<pre>'; print_r($issuer_id); echo'</pre>';

										MercadoPago\SDK::setAccessToken("TEST-6969764269189584-101923-695e559590b40c2a09c2493b582da36a-661020407");
										//...
										$payment = new MercadoPago\Payment();
										$payment->transaction_amount = $_COOKIE["pagoReserva"];
										$payment->token = $token;
										$payment->description = $_COOKIE["nombreLibro"];
										$payment->installments = $installments;
										$payment->payment_method_id = $payment_method_id;
										$payment->issuer_id = $issuer_id;
										$payment->payer = array(
										"email" => "casandra_ko@hotmail.com"
										);
										// Guarda y postea el pago
										$payment->save();
										//...
										// Imprime el estado del pago
										// echo $payment->status;
										//...
										if($payment->status == "approved"){

											$datos = array( "idLibro" => $_COOKIE["idLibro"],
											"idUsuario" => $usuario["idUsuario"],
											"pagoReserva" => $_COOKIE["pagoReserva"],
											"transaccionReserva" => $payment->id,
											"codigoReserva" => $_COOKIE["codigoReserva"],
											"fechaDespacho" => $_COOKIE["fechaIngreso"],
											"fechaDevolucion" => $_COOKIE["fechaSalida"]);

											$respuesta = ControladorReservas::ctrGuardarReserva($datos);

											if ($respuesta == "ok") {
												echo '<script>
												
													document.cookie = "idLibro=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "imgLibro=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "nombreLibro=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
													document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";

													swal({
														icon:"success",
														title: "¡Correcto!",
														text: "¡La reserva ha sido creada con éxito!"
													}).then(function(result){
														if(result.value){   
															history.back();
														} 
													});											
												</script>';
											}

										} else {
											echo '<h1>¡Algo salió mal!</h1>
											<p>Ha ocurrido un error con el pago. Por favor vuelve a intentarlo.</p>';
										}
									}
								?>
							<?php endif ?>
						<?php endif ?>

					</div>

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">
						
						<table class="table">
							<thead class="thead-light">
								<tr>
									<th>#</th>
									<th>Codigo</th>
									<th>Libro</th>
									<th>Desde</th>
									<th>Hasta</th>
									<!-- <th>Comentarios</th> -->
								</tr>
							</thead>
							<tbody>
								<?php
								if (!$reservas) {
									echo '<div class="d-lg-none d-flex py-2">Aún no tiene reservas</div>';
									return;
								}
								else {
									foreach ($reservas as $key => $value) {
										$libro = ControladorLibros::ctrMostrarLibro($value["idLibro"]);
										echo '
										<tr>
											<th scope="row">'.($key + 1).'</th>
											<td>'.$value["codigoReserva"].'</td>
											<td>'.$libro["nombreLibro"].'</td>
											<td>'.$value["fechaDespacho"].'</td>
											<td>'.$value["fechaDevolucion"].'</td>
										</tr>';
	
									}
									echo '<p class="help-block small">
										Si desea modificar o cancelar una reserva, por favor escribir al Whatsapp <a href="https://api.whatsapp.com/send?phone=573175826912" target="_blank">+57 317 582 6912</a>	
										</p>';
								}

								?>
							</tbody>
						</table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>
