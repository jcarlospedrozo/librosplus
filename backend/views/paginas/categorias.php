<div class="content-wrapper" style="min-height: 1667.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorías</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Categorías</li>
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
              <button class="btn btn-primary" data-toggle="modal" data-target="#crearCategoria">Crear nueva categoría</button>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaCategorias" width="100%">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Ruta</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Imagen</th>
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

  <!-- Crear categoria -->
<div class="modal fade" id="crearCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-list-ul"></i></div>
            </div>
            <input type="text" class="form-control" name="rutaCategoria" placeholder="Ingresa la ruta de la categoría" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-certificate"></i></div>
            </div>
            <input type="text" class="form-control" name="nombreCategoria" placeholder="Ingresa el nombre de categoría" required>
          </div>

          <hr class="pb-2">

          <div class="form-group my-2">
            <div class="btn btn-default btn-file">
                <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Categoría
                <input type="file" name="subirImgCategoria">
            </div>
            <img class="previsualizarImgCategoria img-fluid py-2">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
          <?php
          $registroCategoria = new ControladorCategorias();
          $registroCategoria->ctrRegistroCategoria();
          ?>
      </form>
    </div>
  </div>
</div>

<!-- Editar categoria -->
<div class="modal fade" id="editarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" class="form-control" name="idCategoria">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-list-ul"></i></div>
            </div>
            <input type="text" class="form-control" name="editarRutaCategoria" required>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-certificate"></i></div>
            </div>
            <input type="text" class="form-control" name="editarNombreCategoria" required readonly>
          </div>

          <hr class="pb-2">

          <div class="form-group my-2">
            <div class="btn btn-default btn-file">
                <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Categoría
                <input type="file" name="editarImgCategoria">
                <input type="hidden" name="imgCategoriaActual">
            </div>
            <img class="previsualizarImgCategoria img-fluid py-2">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?php
          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();
        ?>
      </form>
    </div>
  </div>
</div>