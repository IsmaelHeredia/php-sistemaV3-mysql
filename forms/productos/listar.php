<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/productoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$productoDatos = new ProductoDatos();

$productos = $productoDatos->Listar("");

?>

<div class="card contenedor">
  <div class="card-header">
    Lista de productos
  </div>
  <div class="card-body">

<?php

if(count($productos) > 0) {

	?>

	<table id="tabla_productos" name="tabla_productos" class="table table-striped nowrap" style="width:100%">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Descripción</th>
	      <th scope="col">Precio</th>
	      <th scope="col">Proveedor</th>
	      <th scope="col">Fecha</th>
	      <th scope="col">Opción</th>
	    </tr>
	  </thead>
	  <tbody>

	<?php

	foreach($productos as $producto) {
		$id = $producto->getId();
		$nombre = $producto->getNombre();
		$descripcion = $producto->getDescripcion();
		$precio = $producto->getPrecio();
		$proveedor = $producto->getProveedor()->getNombre();
		$fecha = $helper->convertir_fecha_usuario($producto->getFecha_registro());
		echo "<tr><td>". htmlentities($id) ."</td><td>". htmlentities($nombre) ."</td><td>". htmlentities($descripcion) ."</td><td>". htmlentities($precio) ."</td><td>". htmlentities($proveedor) ."</td><td>". htmlentities($fecha) ."</td><td><a class=\"btn btn-primary\" href=\"administracion.php?tipo=editarProducto&id_producto=". htmlentities($id) ."\" role=\"button\">Editar</a>&nbsp;<a class=\"btn btn-primary\" href=\"administracion.php?tipo=borrarProducto&id_producto=". htmlentities($id) ."\" role=\"button\">Borrar</a></td></tr>";
	}

	?>

		  </tbody>
		</table>

	<?php

} else {
	echo "No se encontraron productos";
}

?>

  </div>
</div>

<div class="mt-5 col-md-12 text-center">
	<a class="btn btn-primary" href="administracion.php?tipo=agregarProducto" role="button">Agregar nuevo producto</a>
</div>