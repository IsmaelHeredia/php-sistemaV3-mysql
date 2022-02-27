<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/usuarioDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

global $directorio_principal;
global $session_mensaje;

if(!isset($_SESSION)) { session_start(); }

$usuarioDatos = new UsuarioDatos();
$helper = new Helper();

if(isset($_POST["agregarUsuario"])) {
  $id = $_POST["txtID"];
  $nombre = $_POST["txtNombre"];
  $clave = md5($_POST["txtClave"]);
  $id_tipo = $_POST["cmbTipo"];
  $fecha_registro = $helper->enviar_fecha_actual();
  $usuario = Usuario::CreateUsuario($id,$nombre,$clave,$id_tipo,$fecha_registro);
  if($usuarioDatos->comprobarExistenciaCrear($nombre)) {
    $_SESSION[$session_mensaje] = "El usuario $nombre ya existe";
    header("Location: $directorio_principal/administracion.php?tipo=agregarUsuario");
  } else {
    $usuarioDatos->Agregar($usuario);
    $_SESSION[$session_mensaje] = "El usuario fue creado exitosamente";
    header("Location: $directorio_principal/administracion.php?tipo=listarUsuarios");
  }
}

if(isset($_POST["editarUsuario"])) {
  $id = $_POST["txtID"];
  $nombre = $_POST["txtNombre"];
  $id_tipo = $_POST["cmbTipo"];
  $fecha_registro = $helper->enviar_fecha_actual();
  $usuario = new Usuario();
  $usuario->setId($id);
  $usuario->setId_tipo($id_tipo);
  if($usuarioDatos->comprobarExistenciaEditar($id,$nombre)) {
    $_SESSION[$session_mensaje] = "El usuario $nombre ya existe";
    header("Location: $directorio_principal/administracion.php?tipo=editarUsuario&id_usuario=$id");
  } else {
    $usuarioDatos->Editar($usuario);
    $_SESSION[$session_mensaje] = "El usuario fue editado exitosamente";
    header("Location: $directorio_principal/administracion.php?tipo=listarUsuarios");
  }
}

if(isset($_POST["borrarUsuario"])) {
    $id_usuario = $_POST["id_usuario"];
    $usuario = new Usuario();
    $usuario->setId($id_usuario);
    $usuarioDatos->Borrar($usuario);
    $_SESSION[$session_mensaje] = "El usuario fue borrado exitosamente";
    header("Location: $directorio_principal/administracion.php?tipo=listarUsuarios");
}

?>