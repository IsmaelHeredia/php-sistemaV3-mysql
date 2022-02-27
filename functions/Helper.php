<?php

while (! file_exists("functions")) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/accesoDatos.php");
include_once("data/imagenDatos.php");

class Helper {

	public function __construct() {
	}

	function enviar_fecha_actual() {
		date_default_timezone_set("America/Argentina/Cordoba");
		$fecha = date("Y-m-d", time());
		return $fecha;
	}

	function convertir_fecha_usuario($fecha) {
		return date("d/m/Y", strtotime($fecha));
	}

	public function verificar_usuario_logeado() 
	{
		global $directorio_principal, $cookie_recordarme, $nombre_session;

		$response = false;

		$accesoDatos = new AccesoDatos();

		if(!isset($_SESSION)) { session_start(); }
		
		if(isset($_COOKIE[$cookie_recordarme])) 
		{
			$info = $accesoDatos->validar($_COOKIE[$cookie_recordarme]);
			if($info != null) {
				$response = true;
			}
		} else 
		{
			if(isset($_SESSION[$nombre_session])) {
				$info = $accesoDatos->validar($_SESSION[$nombre_session]);
				if($info != null) {
					$response = true;
				}
			}
		}

		return $response;
	}

	public function verificar_ingreso_datos() 
	{
		global $directorio_principal, $cookie_recordarme, $nombre_session;

		$accesoDatos = new AccesoDatos();
		
		if(!isset($_SESSION)) { session_start(); }

		$usuario = "";
		
		if(isset($_COOKIE[$cookie_recordarme])) 
		{
			$respuesta = $accesoDatos->validar($_COOKIE[$cookie_recordarme]);
			if($respuesta == true) {
				$datos = json_decode($accesoDatos->leerToken($_COOKIE[$cookie_recordarme]));
				$usuario = $datos->{"usuario"};
				if(!isset($_SESSION[$nombre_session])) {
					$_SESSION[$nombre_session] = $_COOKIE[$cookie_recordarme];
				}
			} else {
				header("Location: $directorio_principal/index.php");die();
			}
		} else 
		{
			if(isset($_SESSION[$nombre_session])) {
				$respuesta = $accesoDatos->validar($_SESSION[$nombre_session]);
				if($respuesta == true) {
					$datos = json_decode($accesoDatos->leerToken($_SESSION[$nombre_session]));
					$usuario = $datos->{"usuario"};
				} else {
					header("Location: $directorio_principal/index.php");die();
				}
			} else {
				header("Location: $directorio_principal/index.php");die();
			}
		}

		return $usuario;
	}

	public function verificar_ingreso_datos_completo() 
	{
		global $directorio_principal, $cookie_recordarme, $nombre_session;
		
		$accesoDatos = new AccesoDatos();

		if(!isset($_SESSION)) { session_start(); }

		$info = "";
		
		if(isset($_COOKIE[$cookie_recordarme])) 
		{
			$respuesta = $accesoDatos->validar($_COOKIE[$cookie_recordarme]);
			if($respuesta == true) {
				$info = json_decode($accesoDatos->leerToken($_COOKIE[$cookie_recordarme]));
				if(!isset($_SESSION[$nombre_session])) {
					$_SESSION[$nombre_session] = $_COOKIE[$cookie_recordarme];
				}
			} else {
				header("Location: $directorio_principal/index.php");die();
			}
		} else 
		{
			if(isset($_SESSION[$nombre_session])) {
				$respuesta = $accesoDatos->validar($_SESSION[$nombre_session]);
				if($respuesta == true) {
					$info = json_decode($accesoDatos->leerToken($_SESSION[$nombre_session]));
				} else {
					header("Location: $directorio_principal/index.php");die();
				}
			} else {
				header("Location: $directorio_principal/index.php");die();
			}
		}

		return $info;
	}

   public function borrarImagenesSinAsignar($id_usuario) {

   	   global $directorio_imagenes_subidas;

	   $imagenDatos = new ImagenDatos();

	   $imagenes = $imagenDatos->ListarImagenesSinAsignar($id_usuario);

	   foreach($imagenes as $imagen) {
	   	   $id = $imagen->getId();
	   	   $nombre = $imagen->getNombre();
	       $ruta = $directorio_imagenes_subidas . "/" . $nombre;
	       unlink($ruta);
	       $imagenDatos->BorrarPorId($id);
	   }

   }

}

?>