<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/usuarioDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$usuarioDatos = new UsuarioDatos();

$usuarios = $usuarioDatos->Listar("");

?>

<div class="card contenedor">
  <div class="card-header">
    Lista de usuarios
  </div>
  <div class="card-body">

<?php

if(count($usuarios) > 0) {

	?>

	<table id="tabla_usuarios" name="tabla_usuarios" class="table table-striped nowrap" style="width:100%">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Tipo</th>
	      <th scope="col">Fecha</th>
	      <th scope="col">Opción</th>
	    </tr>
	  </thead>
	  <tbody>

	<?php

	foreach($usuarios as $usuario) {
		$id = $usuario->getId();
		$nombre = $usuario->getNombre();
		$tipo = $usuario->getTipo()->getNombre();
		$fecha = $helper->convertir_fecha_usuario($usuario->getFecha_registro());
		echo "<tr><td>". htmlentities($id) ."</td><td>". htmlentities($nombre) ."</td><td>". htmlentities($tipo) ."</td><td>". htmlentities($fecha) ."</td><td><a class=\"btn btn-primary\" href=\"administracion.php?tipo=editarUsuario&id_usuario=". htmlentities($id) ."\" role=\"button\">Editar</a>&nbsp;<a class=\"btn btn-primary\" href=\"administracion.php?tipo=borrarUsuario&id_usuario=". htmlentities($id) ."\" role=\"button\">Borrar</a></td></tr>";
	}

	?>

		  </tbody>
		</table>

	<?php

} else {
	echo "No se encontraron usuarios";
}

?>

  </div>
</div>

<div class="mt-5 col-md-12 text-center">
	<a class="btn btn-primary" href="administracion.php?tipo=agregarUsuario" role="button">Agregar nuevo usuario</a>
</div>