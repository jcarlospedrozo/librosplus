<div class="content-wrapper" style="min-height: 717px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Libros</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Libros</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <!--=====================================
        Listado de habitaciones
        ======================================-->

        <div class="col-12 col-xl-5">

          <div class="card card-primary card-outline">

            <!-- header-card -->

            <div class="card-header pl-2 pl-sm-3">

              <a href="libros" class="btn btn-primary btn-sm">Crear nuevo libro</a>

              <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>

              </div>

            </div>

            <!-- body-card -->

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablaLibros" width="100%">

                <thead>

                  <tr>

                    <th style="width:10px">#</th>
                    <th>Categoría</th>
                    <th>Libro</th>
                    <th style="width:10px">Acciones</th>

                  </tr>

                </thead>

                <tbody>

                  <!--  <tr>
                    
                    <td>1</td>
                    <td>Suite</td>
                    <td>Oriental</td>
                    <td>
                      <button class="btn btn-secondary btn-sm">
                        <i class="far fa-eye"></i>
                      </button>
                    </td> 

                  </tr> -->

                </tbody>

              </table>

            </div>

          </div>

        </div>

        <!--=====================================
        Editor de habitaciones
        ======================================-->


        <?php

        if (isset($_GET["idLibro"])) {

          $libro = ControladorLibros::ctrMostrarlibros($_GET["idLibro"]);
          // echo '<pre>'; print_r($libro);  echo '</pre>';
        } else {

          $libro = null;
        }



        ?>

        <div class="col-12 col-xl-7">

          <div class="card card-primary card-outline">

            <!-- header-card -->

            <div class="card-header">

              <div class="preload"></div>

              <div class="card-tools">

                <button type="button" class="btn btn-info btn-sm guardarLibro">

                  <i class="fas fa-save"></i>

                </button>

                <?php

                if ($libro != null) {

                  // $fotoLibro = $libro["fotoLibro"];

                  echo '<button type="button" class="btn btn-danger btn-sm eliminarLibro" idEliminar="' . $libro["idLibro"] . '" imagenLibro="' . $libro["fotoLibro"] . '">
                  
                          <i class="fas fa-trash"></i> 

                        </button>';
                }

                ?>
              </div>

            </div>

            <!-- card-body -->

            <div class="card-body">

              <input type="hidden" class="idLibro" value="<?php echo $libro['idLibro']?>">

              <!-- Categoría y nombre de la habitación -->

              <div class="d-flex flex-column flex-md-row justify-content-start mb-3">

                <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">

                  <p class="mr-sm-2">Selecciona la Categoría:</p>

                  <?php

                  if ($libro != null) {

                    echo '<select class="form-control seleccionarCategoria" readonly>
                        
                        <option value="' . $libro["idCategoria"] . ',' . $libro["nombreCategoria"] . '">' . $libro["nombreCategoria"] . '</option>

                       </select>';
                  } else {

                    echo '<select class="form-control seleccionarCategoria">

                         <option value="">Seleccione</option>';

                    $categorias = ControladorCategorias::ctrMostrarCategorias(null, null);

                    foreach ($categorias as $key => $value) {

                      echo '<option value="' . $value["idCategoria"] . ',' . $value["nombreCategoria"] . '">' . $value["nombreCategoria"] . '</option>';
                    }

                    echo '</select>';
                  }

                  ?>

                </div>

                <div class="form-inline">

                  <p class="mr-sm-2">Escribe el nombre del libro:</p>

                  <?php

                  if ($libro != null) {

                    echo '<input type="text" class="form-control seleccionarLibro" value="' . $libro["nombreLibro"] . '" readonly>';
                  } else {

                    echo '<input type="text" class="form-control seleccionarLibro">';
                  }

                  ?>

                </div>

              </div>

              <div class="d-flex flex-column flex-md-row justify-content-start mb-3">

                <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">

                  <p class="mr-sm-2">Selecciona el autor:</p>

                  <?php

                  if ($libro != null) {

                    echo '<select class="form-control seleccionarAutor" readonly>
                        
                        <option value="' . $libro["idAutor"] . ',' . $libro["nombreAutor"] . '">' . $libro["nombreAutor"] . '</option>

                       </select>';
                  } else {

                    echo '<select class="form-control seleccionarAutor">

                         <option value="">Seleccione</option>';

                    $autores = ControladorAutores::ctrMostrarAutores(null, null);

                    foreach ($autores as $key => $value) {

                      echo '<option value="' . $value["idAutor"] . ',' . $value["nombreAutor"] . '">' . $value["nombreAutor"] . '</option>';
                    }

                    echo '</select>';
                  }

                  ?>

                </div>

                <div class="form-inline">

                  <p class="mr-sm-2">Escribe el precio:</p>

                  <?php

                  if ($libro != null) {

                    echo '<input type="text" class="form-control seleccionarPrecio" value="' . $libro["precioLibro"] . '">';
                  } else {

                    echo '<input type="text" class="form-control seleccionarPrecio">';
                  }

                  ?>

                </div>

              </div>

              <!-- Galería -->

              <div class="card rounded-lg card-secondary card-outline">

                <div class="card-header pl-2 pl-sm-3">

                  <h5>Imagen del libro</h5>

                </div>

                <div class="card-body mx-auto subirImgLibro">

                  <!-- <div class="form-group my-2"> -->
                    <!-- <div class="btn btn-default btn-file">
                      <i class="fas fa-paperclip"></i> Adjuntar Imagen del libro
                      <input type="file" name="subirImgLibro">
                    </div> -->
                    <!-- <img class="previsualizarImgLibro img-fluid py-2"> -->
                    <!-- </div> -->
                    <?php if ($libro != null): ?>
                    <img  class="previsualizarImgLibroAntigua" src="<?php echo $libro['fotoLibro']; ?>">

                    <?php endif ?>

                </div>

                <!-- <input type="hidden" class="inputNuevaGaleria">

                <input type="hidden" class="inputAntiguaGaleria" value="<?php echo $galeria; ?>"> -->

                <div class="card-footer">
                  <input type="hidden" class="fotoLibroAntigua" value="<?php echo $libro["fotoLibro"]; ?>">
                  <div class="custom-file">
                    <input type="file" id="fotoLibro" class="custom-file-input">
                    <label class="custom-file-label" for="fotoLibro">Agregar imagen de libro</label>
                  </div>
                  

                  <!-- <label for="galeria" class="text-dark text-center py-5 border rounded bg-white w-100 subirGaleria"> -->

                     <!-- Haz clic aquí o arrastra la imagen <br>
                     <span class="help-block small">Dimensiones: 940px * 480px | Peso Max. 2MB | Formato: JPG o PNG</span> -->
                  <!-- </label> -->

                </div>

              </div>


              <!-- descripción -->

              <div class="card rounded-lg card-secondary card-outline">

                <div class="card-header pl-2 pl-sm-3">

                  <h5>Descripción:</h5>

                </div>

                <div class="card-body">

                  <textarea id="descripcionLibro" style="width: 100%">

                    <?php

                    if ($libro != null) {

                      echo $libro["descripcionLibro"];
                    }

                    ?>

                  </textarea>

                </div>

              </div>

            </div>

            <!-- footer-card -->

            <div class="card-footer">

              <div class="preload"></div>

              <div class="card-tools float-right">

                <button type="button" class="btn btn-info btn-sm guardarLibro">

                  <i class="fas fa-save"></i>

                </button>

                <?php

                if ($libro != null) {

                  // $fotoLibro = $libro["fotoLibro"];

                  echo '<button type="button" class="btn btn-danger btn-sm eliminarLibro" idEliminar="' . $libro["idLibro"] . '" imagenLibro="' . $libro["fotoLibro"] . '">
                  
                          <i class="fas fa-trash"></i> 

                        </button>';
                }

                ?>



              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->

</div>