<?php session_start(); 
$nombre='';
if(isset($_SESSION['login']) ){
    $nombre = $_SESSION['login'];
}

$Btnlogin = '<a href="login.php" class="btn btn-primary">Login</a>';
$Btnlogout = '<a href="logout.php" class="btn btn-danger">Logout</a>';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" href="librerias/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <script src="librerias/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="container-fluid" id="capaEncabezado">
            <div class="row">
                <!-- Bootstrap son 12 columnas y en los diferentes tamaños de pantallas tienen q sumar 12 -->
                <div class="col-md-2 col-sm-9 d-none d-sm-block">
                    <img src="icono/512x512.png" style="height: 5rem;">  <!-- rem es segun el tamaño de letra -->
                </div>
                <div class="col-md-8 d-none d-md-block divTitulo">
                    Marcos Donoso Casado - DI 2024
                </div>
                <div class="col-md-2 col-sm-3 d-none d-sm-block" >
                    <?php 
                    if($nombre != ''){
                        echo $Btnlogout;
                    }else{
                        echo $Btnlogin;
                    }
                    echo $nombre?>
                </div>
            </div>
        </div>   
        <!-- Menu HTML !-->
        <!-- <div class="container-fluid" id="capaMenu">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="obtenerVista('Usuarios','getVistaFiltros','capaContenido');">Usuarios</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else</a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div> -->

        <!-- Menu PHP !-->

        <?php
        require_once 'controladores/C_Menu.php';
        $menuController = new C_Menu();
        $menuController->cargarVistaMenu();
        ?>

        <div class="container-fluid" id="capaContenido"></div>

        <script src="app.js" async></script>
    </body>
</html>