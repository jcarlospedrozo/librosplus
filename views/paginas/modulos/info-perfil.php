<?php
$item = "idUsuario";
$valor = $_SESSION["idUsuario"];

$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);
// $reservas = ControladorReservas::ctrMostrarReservasUsuario($valor);

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

					<h1 class="p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
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
									MIS RESERVAS
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2" style="background:#FFFDF4"> 1 Por vencerse</li>
									<li class="px-2 text-white" style="background:#CEC5B6"> 5 vencidas</li>

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
									MIS DATOS
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">
										
										<li class="list-group-item small"><?php echo $usuario["nombreUsuario"]; ?></li>
										<li class="list-group-item small"><?php echo $usuario["emailUsuario"]; ?></li>
										<li class="list-group-item small">
											<button class="btn btn-dark">Cambiar Contraseña</button>
										</li>
										<li class="list-group-item small">
											<button class="btn btn-primary">Cambiar Imagen</button>
										</li>

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

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">
						
						<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Comentarios</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>1</td>
					        <td>Suite Contemporánea</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        
								<button type="button" class="btn btn-secondary"><i class='bx bxs-pencil'></i></button>
								<button type="button" class="btn btn-warning text-white"><i class='bx bx-show'></i></button>
								
					        </td>
					      </tr>
					       <tr>
					        <td>2</td>
					        <td>Especial Caribeña</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								<button type="button" class="btn btn-secondary"><i class='bx bxs-pencil'></i></button>
								<button type="button" class="btn btn-warning text-white"><i class='bx bx-show'></i></button>
								
					        </td>
					      </tr>

					       <tr>
					        <td>3</td>
					        <td>Suite Clásica</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								<button type="button" class="btn btn-secondary"><i class='bx bxs-pencil'></i></button>
								<button type="button" class="btn btn-warning text-white"><i class='bx bx-show'></i></button>
								
					        </td>
					      </tr>
					    </tbody>
					  </table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>
