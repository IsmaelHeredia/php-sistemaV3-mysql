<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/proveedorDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

global $directorio_principal;
global $session_mensaje;

if(!isset($_SESSION)) { session_start(); }

$proveedorDatos = new ProveedorDatos();
$helper = new Helper();

if(isset($_POST["guardarProveedor"])) {
  $id = $_POST["txtID"];
  $nombre = $_POST["txtNombre"];
  $direccion = $_POST["txtDireccion"];
  $telefono = $_POST["txtTelefono"];
  $fecha_registro = $helper->enviar_fecha_actual();
  $proveedor = Proveedor::CreateProveedor($id,$nombre,$direccion,$telefono,$fecha_registro);
  if($id == 0) {
    if($proveedorDatos->comprobarExistenciaCrear($nombre)) {
      $_SESSION[$session_mensaje] = "El proveedor $nombre ya existe";
      header("Location: $directorio_principal/administracion.php?tipo=agregarProveedor");
    } else {
      $proveedorDatos->Agregar($proveedor);
      $_SESSION[$session_mensaje] = "El proveedor fue creado exitosamente";
      header("Location: $directorio_principal/administracion.php?tipo=listarProveedores");
    }
  } else {
    if($proveedorDatos->comprobarExistenciaEditar($id,$nombre)) {
      $_SESSION[$session_mensaje] = "El proveedor $nombre ya existe";
      header("Location: $directorio_principal/administracion.php?tipo=editarProveedor&id_proveedor=$id");
    } else {
      $proveedorDatos->Editar($proveedor);
      $_SESSION[$session_mensaje] = "El proveedor fue editado exitosamente";
      header("Location: $directorio_principal/administracion.php?tipo=listarProveedores");
    }
  }
}

if(isset($_POST["borrarProveedor"])) {
    $id_proveedor = $_POST["id_proveedor"];
    $proveedor = new Proveedor();
    $proveedor->setId($id_proveedor);
    $proveedorDatos->Borrar($proveedor);
    $_SESSION[$session_mensaje] = "El proveedor fue borrado exitosamente";
    header("Location: $directorio_principal/administracion.php?tipo=listarProveedores");
}

?>