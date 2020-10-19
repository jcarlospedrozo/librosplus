<!-- <div class="modal modal-dialog modal-dialog-centered"  id="modalRegistro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-6 ingresar">
                <h1 class="text-center">Registrarse</h1>
                <form method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="registroNombre" required>
                            </div>
                            <div class="col">
                                <label for="exampleInputEmail1">Apellido</label>
                                <input type="text" class="form-control" name="registroApellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"  name="registroEmail" required aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"  name="registroPass" required>
                    </div>
                    <input type="submit" class="btn btn-lg btn-block" value="Regístrate">
                    <?php
                    $registroUsuario = new ControladorUsuarios();
                    $registroUsuario->ctrRegistroUsuario();
                    ?>
                </form>
            </div>
    
        </div>
    </div>
</div> -->

<div class="modal formulario" id="modalRegistro">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Registarse</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">

			<!-- https://console.developers.google.com
			https://github.com/google/google-api-php-client -->

				<a href="<?php echo $rutaGoogle; ?>">

					<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
						<i class="fab fa-google"></i>
						Ingreso con Google
					</p>

				</a>

			</div>

      	</div>

      	<!--=====================================
		REGISTRO DIRECTO
		======================================-->

		<hr class="mt-0">

		<form method="post">

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-user"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Nombre" name="registroNombre" required>

              </div>
              
			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-user"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Apellido" name="registroApellido" required>

		  	</div>


			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" name="registroEmail" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña" name="registroPass" required>

		  	</div>
			

			<input type="submit" class="btn btn-dark btn-block" value="Registrarse">

			<?php

			$registroUsuario = new ControladorUsuarios();
			$registroUsuario -> ctrRegistroUsuario();


			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿Ya tienes una cuenta registrada? | 

		<strong>

			<a href="#modalIngreso" data-toggle="modal" data-dismiss="modal">
				Ingresar
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>
