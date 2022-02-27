<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/productoDatos.php");
include_once("data/imagenDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

global $directorio_principal;
global $session_mensaje;
global $session_iden_fotos_nuevos_productos;
global $directorio_imagenes_subidas;
global $session_borrar_fotos_productos;

if(!isset($_SESSION)) { session_start(); }

$productoDatos = new ProductoDatos();
$imagenDatos = new ImagenDatos();
$helper = new Helper();

if(isset($_POST["guardarProducto"])) {

  $id = $_POST["txtID_producto"];
  $nombre = $_POST["txtNombre"];
  $descripcion = $_POST["txtDescripcion"];
  $precio = $_POST["txtPrecio"];
  $id_proveedor = $_POST["cmbProveedor"];
  $fecha_registro = $helper->enviar_fecha_actual();
  $producto = Producto::CreateProducto($id,$nombre,$descripcion,$precio,$id_proveedor,$fecha_registro);
  if($id == 0) {
    if($productoDatos->comprobarExistenciaCrear($nombre)) {
      $_SESSION[$session_mensaje] = "El producto $nombre ya existe";
      header("Location: $directorio_principal/administracion.php?tipo=agregarProducto");
    } else {
      $id_producto = $productoDatos->Agregar($producto);

      $identificador = "";
      if(isset($_SESSION[$session_iden_fotos_nuevos_productos])) {
        $identificador = $_SESSION[$session_iden_fotos_nuevos_productos];
        $imagenDatos->AsignarProducto($id_producto,$identificador);
        $_SESSION[$session_iden_fotos_nuevos_productos] = "";
      }

      $_SESSION[$session_mensaje] = "El producto fue creado exitosamente";
      header("Location: $directorio_principal/administracion.php?tipo=listarProductos");
    }
  } else {
    if($productoDatos->comprobarExistenciaEditar($id,$nombre)) {
      $_SESSION[$session_mensaje] = "El producto $nombre ya existe";
      header("Location: $directorio_principal/administracion.php?tipo=editarProducto&id_producto=$id");
    } else {
      $productoDatos->Editar($producto);

      $identificador = "";
      if(isset($_SESSION[$session_iden_fotos_nuevos_productos])) {
        $identificador = $_SESSION[$session_iden_fotos_nuevos_productos];
        $imagenDatos->AsignarProducto($id,$identificador);
        $_SESSION[$session_iden_fotos_nuevos_productos] = "";
      }

      if(isset($_SESSION[$session_borrar_fotos_productos])) {
        $ids = $_SESSION[$session_borrar_fotos_productos];
        //print_r($ids);
        if(!empty($ids)) {
          foreach($ids as $id) {
            $imagen = $imagenDatos->CargarPorId($id);
            $ruta = $directorio_imagenes_subidas . "/" . $imagen->getNombre();
            unlink($ruta);
            $imagenDatos->BorrarPorID($id);
          }
          $_SESSION[$session_borrar_fotos_productos] = "";
        }
      }

      $_SESSION[$session_mensaje] = "El producto fue editado exitosamente";
      header("Location: $directorio_principal/administracion.php?tipo=listarProductos");
    }
  }
}

if(isset($_POST["borrarProducto"])) {
    $id_producto = $_POST["id_producto"];

    $imagenes = $imagenDatos->ListarPorProducto($id_producto);
    foreach($imagenes as $imagen) {
      $nombre = $imagen->getNombre();
      $ruta = $directorio_imagenes_subidas . "/" . $nombre;
      unlink($ruta);
    }

    $imagenDatos->BorrarPorProducto($id_producto);

    $producto = new Producto();
    $producto->setId($id_producto);
    $productoDatos->Borrar($producto);

    $_SESSION[$session_mensaje] = "El producto fue borrado exitosamente";
    header("Location: $directorio_principal/administracion.php?tipo=listarProductos");
}

?>