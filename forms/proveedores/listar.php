<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/proveedorDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$proveedorDatos = new ProveedorDatos();

$proveedores = $proveedorDatos->Listar("");

?>

<div class="card contenedor">
  <div class="card-header">
    Lista de proveedores
  </div>
  <div class="card-body">

<?php

if(count($proveedores) > 0) {

	?>

	<table id="tabla_proveedores" name="tabla_proveedores" class="table table-striped nowrap" style="width:100%">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Dirección</th>
	      <th scope="col">Teléfono</th>
	      <th scope="col">Fecha</th>
	      <th scope="col">Opción</th>
	    </tr>
	  </thead>
	  <tbody>

	<?php

	foreach($proveedores as $proveedor) {
		$id = $proveedor->getId();
		$nombre = $proveedor->getNombre();
		$direccion = $proveedor->getDireccion();
		$telefono = $proveedor->getTelefono();
		$fecha = $helper->convertir_fecha_usuario($proveedor->getFecha_registro());
		echo "<tr><td>". htmlentities($id) ."</td><td>". htmlentities($nombre) ."</td><td>". htmlentities($direccion) ."</td><td>". htmlentities($telefono) ."</td><td>". htmlentities($fecha) ."</td><td><a class=\"btn btn-primary\" href=\"administracion.php?tipo=editarProveedor&id_proveedor=". htmlentities($id) ."\" role=\"button\">Editar</a>&nbsp;<a class=\"btn btn-primary\" href=\"administracion.php?tipo=borrarProveedor&id_proveedor=". htmlentities($id) ."\" role=\"button\">Borrar</a></td></tr>";
	}

	?>

		  </tbody>
		</table>

	<?php

} else {
	echo "No se encontraron proveedores";
}

?>

  </div>
</div>

<div class="mt-5 col-md-12 text-center">
	<a class="btn btn-primary" href="administracion.php?tipo=agregarProveedor" role="button">Agregar nuevo proveedor</a>
</div>