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

global $directorio_imagenes;

if(!isset($_SESSION)) { session_start(); }

$id_producto = 0;

if(isset($_POST["id_producto"])) {
	$id_producto = $_POST["id_producto"];
}

$imagenes = $imagenDatos->ListarPorProducto($id_producto);

$resultado = array();

foreach($imagenes as $imagen) {
	$id = $imagen->getId();
	$nombre = $imagen->getNombre();
	$ruta = $directorio_imagenes . "/" . $nombre;
	$tamaño = $imagen->getTamaño();
	$obj["id"] = $id;
	$obj["nombre"] = $nombre;
	$obj["ruta"] = $ruta;
	$obj["tamaño"] = $tamaño;
	$resultado[] = $obj;
}

header("Content-Type: application/json");

echo json_encode($resultado);

?>