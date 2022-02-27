<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/accesoDatos.php");
include_once("data/imagenDatos.php");
include_once("functions/helper.php");

$helper = new Helper();

$datos_token = $helper->verificar_ingreso_datos_completo();
$usuario = $datos_token->{"usuario"};
$id_usuario = $datos_token->{"id"};

include_once("layouts/header_admin.php");

$tipo = "";

if(isset($_GET["tipo"])) {
	$tipo = $_GET["tipo"];
	if($tipo == "listarProductos") {
		include_once("forms/productos/listar.php");
	}
	elseif($tipo == "agregarProducto") {
		$helper->borrarImagenesSinAsignar($id_usuario);
		include_once("forms/productos/formulario.php");
	}
	elseif($tipo == "editarProducto") {
		$helper->borrarImagenesSinAsignar($id_usuario);
		include_once("forms/productos/formulario.php");
	}
	elseif($tipo == "borrarProducto") {
		include_once("forms/productos/borrar.php");
	}
	elseif($tipo == "listarProveedores") {
		include_once("forms/proveedores/listar.php");
	}
	elseif($tipo == "agregarProveedor") {
		include_once("forms/proveedores/formulario.php");
	}
	elseif($tipo == "editarProveedor") {
		include_once("forms/proveedores/formulario.php");
	}
	elseif($tipo == "borrarProveedor") {
		include_once("forms/proveedores/borrar.php");
	}
	elseif($tipo == "listarUsuarios") {
		include_once("forms/usuarios/listar.php");
	}
	elseif($tipo == "agregarUsuario") {
		include_once("forms/usuarios/formulario.php");
	}
	elseif($tipo == "editarUsuario") {
		include_once("forms/usuarios/formulario.php");
	}
	elseif($tipo == "borrarUsuario") {
		include_once("forms/usuarios/borrar.php");
	}
	elseif($tipo == "estadisticas") {
		include_once("forms/estadisticas/reporte.php");
	}
	elseif($tipo == "cambiarUsuario") {
		include_once("forms/cuenta/cambiarUsuario.php");
	}
	elseif($tipo == "cambiarClave") {
		include_once("forms/cuenta/cambiarClave.php");
	} else {
		echo "nada";
	}
} else {
	echo "<h3 class=\"text-center\">Bienvenido " . htmlentities($usuario) . "</h3>";
}

include_once("layouts/footer_admin.php");

?>