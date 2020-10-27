<?php
if ($admin["perfil"] != "Administrador") {
  echo '<script>
      window.location = "inicio";
    </script>';
    return;
}
?>
<div class="content-wrapper" style="min-height: 1667.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administradores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administradores</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#crearAdministrador">Crear nuevos administradores</button>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaAdministradores" width="100%">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Usuario</th>
                      <th scope="col">Perfil</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

<!-- Crear admiistrador -->
<div class="modal fade" id="crearAdministrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control" name="registroNombre" placeholder="Nombre" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user-lock"></i></div>
            </div>
            <input type="text" class="form-control" name="registroUsuario" placeholder="Usuario" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" name="registroPassword" placeholder="Contraseña" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
            </div>
            <select id="" class="form-control" name="registroPerfil" required>
              <option>Seleccione el perfil</option>
              <option>Administrador</option>
              <option>Editor</option>
            </select>
          </div>
          <?php
          $registroAdministrador = new ControladorAdministradores();
          $registroAdministrador->ctrRegistroAdministrador();
          ?>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
  </div>


  <!-- Editar admiistrador -->
<div class="modal fade" id="editarAdministrador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="editarId">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            <input type="text" class="form-control" name="editarNombre" value required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user-lock"></i></div>
            </div>
            <input type="text" class="form-control" name="editarUsuario" value required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" name="editarPassword" placeholder="Cambiar la contraseña">
            <input type="hidden" class="form-control" name="contrasenadActual">
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
            </div>
            <select class="form-control" name="editarPerfil" required>
              <option class="editarPerfilOption"></option>
              <option value="">Seleccione el perfil</option>
              <option value="Administrador">Administrador</option>
              <option value="Editor">Editor</option>
            </select>
          </div>
          <?php
          $registroAdministrador = new ControladorAdministradores();
          $registroAdministrador->ctrEditarAdministrador();
          ?>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>