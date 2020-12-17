<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
      <img src="views/img/plantilla/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Libros Plus</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="views/img/plantilla/logo1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Libros Plus</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?php echo $ruta; ?>" target="_blank" class="nav-link active">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Ver sitio
              </p>
            </a>
          </li>

          <?php if($admin["perfil"] == "Administrador"): ?>
          <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="administradores" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Administradores
              </p>
            </a>
          </li>
          <?php endif ?>

          <li class="nav-item">
            <a href="categorias" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Categorías
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="libros" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Libros
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="autores" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Autores
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="reservas" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Reservas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>