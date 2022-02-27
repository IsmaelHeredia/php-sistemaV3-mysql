<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/proveedorDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$proveedorDatos = new ProveedorDatos();

$id = 0;

if(isset($_GET["id_proveedor"])) {
  $id = $_GET["id_proveedor"];
}

$proveedor = $proveedorDatos->Cargar($id);
$nombre_proveedor = $proveedor->getNombre();

?>

<div class="jumbotron">
  <form method="POST" action="forms/proveedores/datos.php">
    <input type="hidden" id="id_proveedor" name="id_proveedor" value="<?php echo htmlentities($id); ?>" />
    <fieldset>
        <div class="text-center">
            <h1>Eliminacíon</h1>
            <p class="lead">¿Estás seguro que deseas eliminar al proveedor <?php echo htmlentities($nombre_proveedor); ?> ?</p>
            <p class="lead">
                <button type="submit" id="borrarProveedor" name="borrarProveedor" class="btn btn-danger boton-largo">Borrar</button>
                <a class="btn btn-primary boton-largo" href="administracion.php?tipo=listarProveedores" role="button">Volver</a>
            </div>
        </div>
    </fieldset>
  </form>
</div>