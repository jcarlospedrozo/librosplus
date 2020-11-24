<div class="content-wrapper" style="min-height: 1667.12px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Libros</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
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
        <!-- listado libros -->
        <div class="col-xl-5">
          <div class="card card-outline">

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

                  <!-- <tr>

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

        <!-- editar libros -->
        <?php
        if(isset($_GET["idLibro"])){
          $libro = ControladorLibros::ctrMostrarLibros($_GET["idLibro"]);
          // echo '<pre>'; print_r($libro); echo '</pre>';
        }else{
          $libro = null;
        }
        ?>
        <div class="col-xl-7">
          <div class="card">

            <!-- header-card -->

            <div class="card-header">

              <!-- <h5 class="card-title"><?php echo $libro["nombreCategoria"] ?> / <?php echo $libro["nombreLibro"] ?></h5> -->

              <div class="preload"></div>

              <div class="card-tools">

                <button type="button" class="btn btn-info btn-sm guardarLibro">

                  <i class="fas fa-save"></i>

                </button>

                <?php

                if ($libro != null) {

                  $fotoLibro = $libro["fotoLibro"];

                  echo '<button type="button" class="btn btn-danger btn-sm eliminarLibro" idEliminar="'.$libro["idLibro"].'" fotoLibro="'. $fotoLibro.'">
                  
                          <i class="fas fa-trash"></i> 

                        </button>';
                }

                ?>
              </div>

            </div>

            <!-- card-body -->

            <div class="card-body">

              <input type="hidden" class="idLibro" value="<?php echo $libro["idLibro"] ?>">

              <!-- Categoría y nombre de la habitación -->

              <div class="d-flex flex-column flex-md-row justify-content-start mb-3">

                <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">

                  <p class="mr-sm-2">Elige la Categoría:</p>

                  <?php

                  if ($libro != null) {

                    echo '<select class="form-control seleccionarTipo" readonly>
                        
                        <option value="' . $libro["idCategoria"] . ',' . $libro["nombreCategoria"] . '">' . $libro["nombreCategoria"] . '</option>

                       </select>';
                  } else {

                    echo '<select class="form-control seleccionarTipo">

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

                    echo '<input type="text" class="form-control seleccionarNombre" value="' . $libro["nombreLibro"] . '" readonly>';
                  } else {

                    echo '<input type="text" class="form-control seleccionarNombre">';
                  }

                  ?>

                </div>

              </div>

              <div class="d-flex flex-column flex-md-row justify-content-start mb-3">

                <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">

                  <p class="mr-sm-2">Elige el precio:</p>

                  <?php

                  if ($libro != null) {

                    echo '<input type="text" class="form-control seleccionarPrecio" value="' . $libro["precioLibro"] . '" readonly>';
                  } else {

                    echo '<input type="text" class="form-control seleccionarPrecio">';
                  }

                  ?>

                </div>

                <div class="form-inline">

                  <p class="mr-sm-2">Selecciona el autor del libro:</p>

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

              </div>

              <!-- Galería -->

              <div class="card rounded-lg card-secondary card-outline">

                <div class="card-header pl-2 pl-sm-3">

                  <h5>Imagen del libro:</h5>

                </div>

                <div class="card-body">

                <ul class="row p-0 vistaGaleria">
                    <?php

                    if ($libro != null) {

                      $fotoLibro = $libro["fotoLibro"];

                        echo '<li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                      
                                <img class="card-img-top" src="' . $fotoLibro . '">

                                <div class="card-img-overlay p-0 pr-3">
                                  
                                   <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="' . $fotoLibro . '">
                                     
                                     <i class="fas fa-times"></i>

                                   </button>

                                </div>

                              </li>';
                    }

                    ?>
                  </ul>
                </div>

                <input type="hidden" class="inputNuevaFoto">

                <input type="hidden" class="inputAntiguaFoto" value="<?php echo $fotoLibro; ?>">

                <div class="card-footer">

                  <input type="file" id="fotoLibro" class="d-none">

                  <label for="fotoLibro" class="text-dark text-center py-5 border rounded bg-white w-100 subirImagen">
                    Haz clic aquí o arrastra las imágenes <br>
                  </label>

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

                  $fotoLibro = $libro["fotoLibro"];

                  echo '<button type="button" class="btn btn-danger btn-sm eliminarLibro" idEliminar="' . $libro["idLibro"] . '" fotoLibro="' . $fotoLibro . '">
                  
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