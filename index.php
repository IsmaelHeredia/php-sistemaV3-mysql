<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

while (! file_exists("functions") ) {
    chdir("..");
}

if(!isset($_SESSION)) { session_start(); }

include_once("config/vars.php");
include_once("data/accesoDatos.php");
include_once("functions/Helper.php");

global $session_mensaje;
global $directorio_principal;
global $cookie_recordarme;
global $nombre_session;

$helper = new Helper();

if($helper->verificar_usuario_logeado() == true) {
    header("Location: $directorio_principal/administracion.php");
}

$accesoDatos = new AccesoDatos();

//echo password_hash("supervisor", PASSWORD_BCRYPT);exit;

if(isset($_POST["ingresar"])) {
  $usuario = $_POST["usuario"];
  $clave = $_POST["clave"];
  $recordar_usuario = 0;
  if(isset($_POST["cbRecordarme"])) {
    $recordar_usuario = 1;
  }
  $token = $accesoDatos->ingreso($usuario,$clave);
  if($token != null) 
  {
      if($recordar_usuario == 1) {
          setcookie(
              $cookie_recordarme,
              $token,
              time() + (10 * 365 * 24 * 60 * 60)
          );
      }

      $_SESSION[$nombre_session] = $token;

      $_SESSION[$session_mensaje] = "Ingreso correcto";

      header("Location: $directorio_principal/administracion.php");die();
  } else {
      $_SESSION[$session_mensaje] = "Ingreso fallido";
      header("Location: $directorio_principal/index.php");die();
  }
  exit;
}

include_once("layouts/header.php");

?>

  <div class="card card-primary contenedor">
    <div class="card-header bg-primary">Ingreso</div>
      <div class="card-body">
          <div class="card-block">
            <form action="#" method="POST" class="needs-validation" id="accesoForm">
              <fieldset>
                <legend>Datos</legend>
                <div class="mb-3">
                  <label class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" required />
                  <div class="invalid-feedback">
                      El usuario es requerido
                  </div>       
                </div>
                <div class="mb-3">
                  <label class="form-label">Clave</label>
                  <input type="password" class="form-control" id="clave" name="clave" required />
                  <div class="invalid-feedback">
                      La clave es requerida
                  </div>                
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="cbRecordarme" name="cbRecordarme">
                  <label class="form-check-label" for="cbRecordarme">Recordarme</label>
                </div>
               <div class="mt-5 text-center">
                  <p class="lead">
                    <button type="submit" name="ingresar" id="ingresar" class="btn btn-primary boton-largo">Ingresar</button>
                  </p>
                </div>
              </fieldset>
            </form>
          </div>
    </div>
  </div>

<?php
include_once("layouts/footer.php");
?>