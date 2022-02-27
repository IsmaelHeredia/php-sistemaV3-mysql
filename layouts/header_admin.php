<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

?>
<?php if(!isset($_SESSION)) { session_start(); } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema</title> 
    <link rel="icon" href="#">

    <!-- Bootstrap -->

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    
    <link href="css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/responsive.bootstrap5.min.css" rel="stylesheet">

    <link href="css/dropzone.css" rel="stylesheet">
    
    <link id="theme" href="css/style.css" rel="stylesheet" />

    <script src="js/jquery-3.5.1.js" charset="UTF-8"></script>
    <script src="js/popper.js" charset="UTF-8"></script>
    <script src="bootstrap/js/bootstrap.js" charset="UTF-8"></script>

    <script src="js/jquery.dataTables.min.js" charset="UTF-8"></script>
    <script src="js/dataTables.bootstrap5.min.js" charset="UTF-8"></script>
    <script src="js/dataTables.responsive.min.js" charset="UTF-8"></script>
    <script src="js/responsive.bootstrap5.min.js" charset="UTF-8"></script>
    
    <script src="js/highcharts.js" charset="UTF-8"></script>
    <script src="js/exporting.js" charset="UTF-8"></script>

    <script src="js/dropzone-min.js" charset="UTF-8"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="administracion.php">Administración</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="administracion.php" name="inicio"><i class="fa fa-home espacio-icono" aria-hidden="true"></i></span>Inicio<span class="sr-only"></span></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" id="gestionar"><i class="fa fa-tasks espacio-icono" aria-hidden="true"></i>Gestionar <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="gestionar">
                            <a class="dropdown-item" href="administracion.php?tipo=listarProductos">Productos</a>
                            <a class="dropdown-item" href="administracion.php?tipo=listarProveedores">Proveedores</a>   
                            <a class="dropdown-item" href="administracion.php?tipo=listarUsuarios">Usuarios</a>    
                        </div>
                    </li>     
                     <li class="nav-item"><a class="nav-link" href="administracion.php?tipo=estadisticas" name="inicio"><i class="fa fa-home espacio-icono" aria-hidden="true"></i></span>Estadísticas<span class="sr-only"></span></a></li>                                       
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cuenta" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle espacio-icono" aria-hidden="true"></i><?php echo htmlentities($usuario); ?> <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cuenta">
                            <a class="dropdown-item" href="administracion.php?tipo=cambiarUsuario" name="cambiar_usuario">Cambiar Usuario</a>
                            <a class="dropdown-item" href="administracion.php?tipo=cambiarClave" name="cambiar_clave">Cambiar Clave</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="salir.php">Salir</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>     
        <section>
          <div class="container-fluid" style="margin-top: 100px">
          <?php

            while (! file_exists("functions") ) {
                chdir("..");
            }

            include_once("config/vars.php");

            global $session_mensaje;

            if(isset($_SESSION[$session_mensaje])) {
                $mensaje = $_SESSION[$session_mensaje];
                unset($_SESSION[$session_mensaje]);
                echo "<script>alert(\"". htmlentities($mensaje) ."\")</script>";
            }

          ?>