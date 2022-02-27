<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/imagenDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$datos_token = $helper->verificar_ingreso_datos_completo();
$id_usuario = $datos_token->{"id"};

$imagenDatos = new ImagenDatos();
$imagen = new Imagen();

global $directorio_imagenes_subidas;
global $session_iden_fotos_nuevos_productos;

if(!isset($_SESSION)) { session_start(); }

$iden = "";

if(isset($_SESSION[$session_iden_fotos_nuevos_productos])) {
	$iden = $_SESSION[$session_iden_fotos_nuevos_productos];
	if($iden == "") {
		$iden = md5(time());
		$_SESSION[$session_iden_fotos_nuevos_productos] = $iden;
	}
} else {
	$iden = md5(time());
	$_SESSION[$session_iden_fotos_nuevos_productos] = $iden;
}

if (!is_dir($directorio_imagenes_subidas)) {
   mkdir($directorio_imagenes_subidas, 0777, true);
}

$nombre = $_FILES["file"]["name"];
$archivo_temporal  = $_FILES["file"]["tmp_name"];
$subir_archivo = $directorio_imagenes_subidas ."/". basename($nombre);
$archivo_subido = move_uploaded_file($archivo_temporal, $subir_archivo);

if ($archivo_subido) {
	$tamaño = filesize($subir_archivo);
	$imagen->setNombre($nombre);
	$imagen->setTamaño($tamaño);
	$imagen->setFecha_registro($helper->enviar_fecha_actual());
	$imagen->setIdentificador($iden);
	$imagen->setId_usuario($id_usuario);
	$imagenDatos->Agregar($imagen);
	echo json_encode([
		"code" => 200,
		"iden" => $iden
	]);
} else {
	echo json_encode([
		"code" => 400	
	]);
}

?>
