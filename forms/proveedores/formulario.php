<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Proveedor.php");
include_once("data/proveedorDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$proveedorDatos = new ProveedorDatos();

$id = 0;

if(isset($_GET["id_proveedor"])) {
  $id = $_GET["id_proveedor"];
}

$nombre = "";
$direccion = "";
$telefono = "";

if($id > 0) {
  $proveedor = $proveedorDatos->Cargar($id);
  $nombre = $proveedor->getNombre();
  $direccion = $proveedor->getDireccion();
  $telefono = $proveedor->getTelefono();
}

?>

<div class="card contenedor">
  <div class="card-header">
    Datos del proveedor
  </div>
  <div class="card-body">
    <form method="POST" action="forms/proveedores/datos.php">
      <input type="hidden" id="txtID" name="txtID" value="<?php echo htmlentities($id); ?>" />
      <div class="mb-3">
        <label for="txtNombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo htmlentities($nombre); ?>" required />
      </div>
      <div class="mb-3">
        <label for="txtDescripcion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" value="<?php echo htmlentities($direccion); ?>" required />
      </div>
      <div class="mb-3">
        <label for="txtTelefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" value="<?php echo htmlentities($telefono); ?>" required />
      </div>
      <div class="mt-5 text-center">
        <p class="lead">
          <button type="submit" id="guardarProveedor" name="guardarProveedor" class="btn btn-primary">Guardar</button>
          <a class="btn btn-primary" href="administracion.php?tipo=listarProveedores" role="button">Volver</a>
        </p>
      </div>
    </form>
  </div>
</div>