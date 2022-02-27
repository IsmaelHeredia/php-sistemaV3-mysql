<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/accesoDatos.php");
include_once("data/cuentaDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

global $session_mensaje;
global $directorio_principal;
global $cookie_recordarme;
global $nombre_session;

if(!isset($_SESSION)) { session_start(); }

$accesoDatos = new AccesoDatos();
$cuentaDatos = new CuentaDatos();

if(isset($_POST["cambiarUsuario"])) {
	$nombre = $_POST["txtNombre"];
	$nuevoNombre = $_POST["txtNuevoUsuario"];
	$claveActual = $_POST["txtClave"];
	if($accesoDatos->solo_verificar_ingreso($nombre,$claveActual)) {
		if($cuentaDatos->cambiarUsuario($nombre,$nuevoNombre)) {
	    	$_SESSION[$session_mensaje] = "El usuario fue cambiado";

			if(isset($_SESSION[$nombre_session])) {
			    $info = $accesoDatos->validar($_SESSION[$nombre_session]);
			    if($info != null) {
			        unset($_COOKIE[$cookie_recordarme]);
			        setcookie($cookie_recordarme, "", 1);
			    	unset($_SESSION[$nombre_session]);
			    }
			}

	      header("Location: $directorio_principal/index.php");
		} else {
	      $_SESSION[$session_mensaje] = "Ocurrio un error cambiando el usuario";
	      header("Location: $directorio_principal/administracion.php?tipo=cambiarUsuario");
		}
	} else {
	    $_SESSION[$session_mensaje] = "Clave actual incorrecta";
	    header("Location: $directorio_principal/administracion.php?tipo=cambiarUsuario");
	}
}

if(isset($_POST["cambiarClave"])) {
	$nombre = $_POST["txtNombre"];
	$nuevaClave = password_hash($_POST["txtNuevaClave"], PASSWORD_BCRYPT);
	$claveActual = $_POST["txtClave"];
	if($accesoDatos->solo_verificar_ingreso($nombre,$claveActual)) {
		if($cuentaDatos->cambiarClave($nombre,$nuevaClave)) {
		    $_SESSION[$session_mensaje] = "La clave fue cambiada";

			if(isset($_SESSION[$nombre_session])) {
			    $info = $accesoDatos->validar($_SESSION[$nombre_session]);
			    if($info != null) {
			        unset($_COOKIE[$cookie_recordarme]);
			        setcookie($cookie_recordarme, "", 1);
			    	unset($_SESSION[$nombre_session]);
			    }
			}

		    header("Location: $directorio_principal/index.php");
		} else {
		    $_SESSION[$session_mensaje] = "Ocurrio un error cambiando la clave";
		    header("Location: $directorio_principal/administracion.php?tipo=cambiarClave");
		}
	} else {
		$_SESSION[$session_mensaje] = "Clave actual incorrecta";
		header("Location: $directorio_principal/administracion.php?tipo=cambiarClave");
	}
}

?>