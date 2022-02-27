<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/accesoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

global $session_mensaje;
global $directorio_principal;
global $cookie_recordarme;
global $nombre_session;

if(!isset($_SESSION)) { session_start(); }

$accesoDatos = new AccesoDatos();

if(isset($_SESSION[$nombre_session])) {
    $info = $accesoDatos->validar($_SESSION[$nombre_session]);
    if($info != null) {
        unset($_COOKIE[$cookie_recordarme]);
        setcookie($cookie_recordarme, "", 1);
    	unset($_SESSION[$nombre_session]);
    }
    $_SESSION[$session_mensaje] = "La sesion fue cerrada";
}

header("Location: $directorio_principal/index.php");

?>