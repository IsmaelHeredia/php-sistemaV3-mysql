<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/imagenDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$imagenDatos = new ImagenDatos();
$imagen = new Imagen();

global $directorio_imagenes_subidas;
global $session_borrar_fotos_productos;

if(!isset($_SESSION)) { session_start(); }

$tipo = "";

if(isset($_POST["tipo"])) {
	$tipo = $_POST["tipo"];
}

if($tipo == "borrarTemporal") {
	$nombre = $_POST["nombre"];
	$ruta = $directorio_imagenes_subidas . "/" . $nombre;
	$imagenDatos->BorrarPorNombre($nombre);
	unlink($ruta);
}
else if($tipo == "borrarServidor") {
	$id = $_POST["id"];
	if(isset($_SESSION[$session_borrar_fotos_productos])) {
		$ids = $_SESSION[$session_borrar_fotos_productos];
		if(!is_array($ids)) {
			$ids = array($ids);
		}
		$ids[] = $id;
		$_SESSION[$session_borrar_fotos_productos] = $ids;
	} else {
		$ids = array();
		$ids[] = $id;
		$_SESSION[$session_borrar_fotos_productos] = $ids;
	}
}

//header("Content-Type: application/json");

//echo json_encode(array("estado"=>200));

?>