<?php  

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Producto.php");
include_once("entities/Proveedor.php");
include_once("data/productoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$productoDatos = new ProductoDatos();

$productos = $productoDatos->Listar("");

$cantidad = count($productos);

?>

<div class="card card-primary contenedor">
<div class="card-header bg-primary">Productos encontrados : <?php echo htmlentities($cantidad) ?></div>
  <div class="card-body">
  	
<?php
	
if ($cantidad == "0") {
	echo "<center><b>No se encontraron productos</b></center>";
} else {
			
	?>
<div class="table-responsive">
<table class="table table-hover ">
  <thead>
	<tr>
	  <th class="fila_listado_productos">Nombre</th>
	  <th class="fila_listado_productos">Descripción</th>
	  <th class="fila_listado_productos">Precio</th>
	  <th class="fila_listado_productos">Proveedor</th>
	  <th class="fila_listado_productos">Registro</th>
	</tr>
  </thead>
  <tbody>
	<?php
				
	foreach ($productos as $producto) {
		$id      = $producto->getId();
		$nombre  = $producto->getNombre();
		$descripcion      = $producto->getDescripcion();
		$descripcion      = substr($descripcion, 0, 18);
		$precio           = $producto->getPrecio();
		$fecha_registro   = $helper->convertir_fecha_usuario($producto->getFecha_registro());
		$id_proveedor     = $producto->getId_proveedor();
		$nombre_proveedor = $producto->getProveedor()->getNombre();

		echo '
		  <tr>
			<td class="filterable-cell fila_listado_productos">'.htmlentities($nombre).'</td>
			<td class="filterable-cell fila_listado_productos">'.htmlentities($descripcion).'</td>
			<td class="filterable-cell fila_listado_productos">'.htmlentities($precio).'</td>
			<td class="filterable-cell fila_listado_productos">'.htmlentities($nombre_proveedor).'</td>
			<td class="filterable-cell fila_listado_productos">'.htmlentities($fecha_registro).'</td>
		  </tr>
		';
	}
	
	echo '
		</tbody>
	  </table> 
	  </div>
  ';
  
	echo '
	  </div>
	</div>
	';
	
}

unset($datos);

?>