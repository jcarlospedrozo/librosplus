<?php
$notificaciones = ControladorInicio::ctrMostrarNotificaciones();
// echo '<pre>'; print_r($notificaciones); echo '</pre>';
$totalNotificaciones = 0;

foreach ($notificaciones as $key => $value) {
    $totalNotificaciones += $value["cantidad"];
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../../index3.html" class="nav-link">Hola <?php echo $admin["nombre"]; ?></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?php if($totalNotificaciones != 0) {echo $totalNotificaciones;} ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?php echo $totalNotificaciones; ?> Notificaciones</span>
                <div class="dropdown-divider"></div>
                <a href="index.php?pagina=reservas&notification=0" class="dropdown-item">
                    <i class="fas fa-calendar-alt mr-2"></i><?php echo $totalNotificaciones; ?> Reservas nuevas
                    <span class="float-right text-muted text-sm">2 minutos</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <!-- Boton salir -->
        <li class="nav-item">
            <a class="nav-link" href="salir">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>