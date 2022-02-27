<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Usuario.php");
include_once("data/usuarioDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$usuarioDatos = new UsuarioDatos();

$id = "1";
$usuario = $usuarioDatos->Cargar($id);
$nombre_usuario = $usuario->getNombre();

?>

<div class="card contenedor">
  <div class="card-header">
    Cambiar clave
  </div>
  <div class="card-body">
    <form method="POST" action="forms/cuenta/datos.php">
      <input type="hidden" id="txtID" name="txtID" value="<?php echo htmlentities($id); ?>" />
      <div class="mb-3">
        <label for="txtNombre" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo htmlentities($nombre_usuario); ?>" readonly />
      </div>
      <div class="mb-3">
        <label for="txtNuevaClave" class="form-label">Nueva clave</label>
        <input type="password" class="form-control" id="txtNuevaClave" name="txtNuevaClave" required />
      </div>
      <div class="mb-3">
        <label for="txtClave" class="form-label">Clave actual</label>
        <input type="password" class="form-control" id="txtClave" name="txtClave" required />
      </div>
      <div class="mt-5 text-center">
        <p class="lead">
          <button type="submit" id="cambiarClave" name="cambiarClave" class="btn btn-primary">Guardar</button>
          <a class="btn btn-primary" href="administracion.php" role="button">Volver</a>
        </p>
      </div>
    </form>
  </div>
</div>