<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/productoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$productoDatos = new ProductoDatos();

$id = 0;

if(isset($_GET["id_producto"])) {
  $id = $_GET["id_producto"];
}

$producto = $productoDatos->Cargar($id);
$nombre_producto = $producto->getNombre();

?>

<div class="jumbotron">
  <form method="POST" action="forms/productos/datos.php">
    <input type="hidden" id="id_producto" name="id_producto" value="<?php echo htmlentities($id); ?>" />
    <fieldset>
        <div class="text-center">
            <h1>Eliminacíon</h1>
            <p class="lead">¿Estás seguro que deseas eliminar el producto <?php echo htmlentities($nombre_producto); ?> ?</p>
            <p class="lead">
                <button type="submit" id="borrarProducto" name="borrarProducto" class="btn btn-danger boton-largo">Borrar</button>
                <a class="btn btn-primary boton-largo" href="administracion.php?tipo=listarProductos" role="button">Volver</a>
            </div>
        </div>
    </fieldset>
  </form>
</div>