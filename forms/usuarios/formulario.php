<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Usuario.php");
include_once("data/usuarioDatos.php");
include_once("data/tipoUsuarioDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$usuarioDatos = new UsuarioDatos();
$tipoUsuarioDatos = new TipoUsuarioDatos();

$id = 0;

if(isset($_GET["id_usuario"])) {
  $id = $_GET["id_usuario"];
}

$nombre_usuario = "";
$tipo = "";

if($id > 0) {
  $usuario = $usuarioDatos->Cargar($id);
  $nombre_usuario = $usuario->getNombre();
  $id_tipo = $usuario->getId_tipo();
}

$tipoUsuarios = $tipoUsuarioDatos->Listar("");

?>

<div class="card contenedor">
  <div class="card-header">
    Datos del usuario
  </div>
  <div class="card-body">
    <form method="POST" action="forms/usuarios/datos.php">
      <input type="hidden" id="txtID" name="txtID" value="<?php echo htmlentities($id); ?>" />
      <div class="mb-3">
        <label for="txtNombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo htmlentities($nombre_usuario); ?>" required />
      </div>
      <?php if($id == 0) { ?>
        <div class="mb-3">
          <label for="txtClave" class="form-label">Clave</label>
          <input type="password" class="form-control" id="txtClave" name="txtClave" required />
        </div>
      <?php } ?>
      <div class="mb-3">
        <label for="cmbTipo" class="form-label">Tipo</label>
        <select class="form-select" id="cmbTipo" name="cmbTipo" required >
          <?php
            foreach($tipoUsuarios as $tipo) {
              $id_tipousuario_lista = $tipo->getId();
              $nombre_tipo = $tipo->getNombre();
              if($id_tipo == $id_tipousuario_lista) {
                echo "<option selected value='" . $id_tipousuario_lista  ."'>" . htmlentities($nombre_tipo) . "</option>";
              } else {
                echo "<option value='" . $id_tipousuario_lista  ."'>" . htmlentities($nombre_tipo) . "</option>";
              }
            }
          ?>
        </select>    
      </div>
      <div class="mt-5 text-center">
        <p class="lead">
          <?php if($id == 0) { ?>
            <button type="submit" id="agregarUsuario" name="agregarUsuario" class="btn btn-primary">Guardar</button>
          <?php } else { ?>
            <button type="submit" id="editarUsuario" name="editarUsuario" class="btn btn-primary">Guardar</button>
          <?php } ?>
          <a class="btn btn-primary" href="administracion.php?tipo=listarUsuarios" role="button">Volver</a>
        </p>
      </div>
    </form>
  </div>
</div>