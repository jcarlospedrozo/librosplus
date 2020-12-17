<?php 
  if($admin["perfil"] != "Administrador"){
    echo '<script>
      window.location = "categorias";
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
          <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">

      <div class="card-body">

        <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Reservas</th>

            </tr>

          </thead>

          <tbody>


          </tbody>

        </table>

      </div>

    </div>
  </section>
  <!-- /.content -->
</div>