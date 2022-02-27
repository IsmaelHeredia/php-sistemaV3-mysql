<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Producto.php");
include_once("data/productoDatos.php");
include_once("data/proveedorDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$productoDatos = new ProductoDatos();
$proveedorDatos = new ProveedorDatos();

$id = 0;

if(isset($_GET["id_producto"])) {
  $id = $_GET["id_producto"];
}

$nombre_producto = "";
$descripcion = "";
$precio = "";
$id_proveedor = "";

if($id > 0) {
  $producto = $productoDatos->Cargar($id);
  $nombre_producto = $producto->getNombre();
  $descripcion = $producto->getDescripcion();
  $precio = $producto->getPrecio();
  $id_proveedor = $producto->getId_proveedor();
}

$proveedores = $proveedorDatos->Listar("");

?>

<div class="card contenedor">
  <div class="card-header">
    Datos del producto
  </div>
  <div class="card-body">
    <form method="POST" id="formProducto" action="forms/productos/datos.php">
      <input type="hidden" id="txtID_producto" name="txtID_producto" value="<?php echo htmlentities($id); ?>" />
      <div class="mb-3">
        <label for="txtNombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo htmlentities($nombre_producto); ?>" required />
      </div>
      <div class="mb-3">
        <label for="txtDescripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="3" required /><?php echo htmlentities($descripcion); ?></textarea>
      </div>
      <div class="mb-3">
        <label for="txtPrecio" class="form-label">Precio</label>
        <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" value="<?php echo htmlentities($precio); ?>" required/>
      </div>
      <div class="mb-3">
        <label for="cmbProveedor" class="form-label">Proveedor</label>
        <select class="form-select" id="cmbProveedor" name="cmbProveedor" required />
          <?php
            foreach($proveedores as $proveedor) {
              $id_proveedor_lista = $proveedor->getId();
              $nombre_proveedor = $proveedor->getNombre();
              if($id_proveedor == $id_proveedor_lista) {
                echo "<option selected value='" . $id_proveedor_lista  ."'>" . htmlentities($nombre_proveedor) . "</option>";
              } else {
                echo "<option value='" . $id_proveedor_lista  ."'>" . htmlentities($nombre_proveedor) . "</option>";
              }
            }
          ?>
        </select>    
      </div>
      <div class="mb-3">
        <label class="form-label">Imágenes</label>
        <div class="dropzone dz-clickable" id="imagenes_producto">
            <div class="dz-default dz-message" data-dz-message="">
                <span>Click para subir imágenes</span>
            </div>
        </div>
      </div>
      <div class="mt-5 text-center">
        <p class="lead">
          <button type="submit" id="guardarProducto" name="guardarProducto" class="btn btn-primary">Guardar</button>
          <a class="btn btn-primary" href="administracion.php?tipo=listarProductos" role="button">Volver</a>
        </p>
      </div>
    </form>
  </div>
</div>