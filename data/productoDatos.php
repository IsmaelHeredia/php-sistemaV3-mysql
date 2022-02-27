<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("entities/Producto.php");
include_once("entities/Proveedor.php");

class ProductoDatos {

	 public function __construct() {

	 }

   public function Listar($patron) {
      $productos = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM productos WHERE nombre LIKE :patron');
      $sql->execute(array('patron' => '%'.$patron.'%'));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $precio = $fila['precio'];
        $id_proveedor = $fila['id_proveedor'];
        $fecha_registro = $fila['fecha_registro'];
        $producto = Producto::CreateProducto($id,$nombre,$descripcion,$precio,$id_proveedor,$fecha_registro);
        array_push($productos,$producto);
      }
      foreach ($productos as $producto) {
        $sql = $conn->prepare('SELECT * FROM proveedores WHERE id = :id');
        $sql->execute(array('id' => $producto->getId_proveedor()));
        $resultado = $sql->fetch();  
        $id = $resultado['id'];
        $nombre = $resultado['nombre'];
        $direccion = $resultado['direccion'];
        $telefono = $resultado['telefono'];
        $fecha_registro = $resultado['fecha_registro']; 
        $proveedor = Proveedor::CreateProveedor($id,$nombre,$direccion,$telefono,$fecha_registro);
        $producto->setProveedor($proveedor);     
      }
      $conexion->cerrar_conexion();
      return $productos;   
   }

   public function Cargar($id) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM productos WHERE id = :id');
      $sql->execute(array('id' => $id));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $descripcion = $resultado['descripcion'];
      $precio = $resultado['precio'];
      $id_proveedor = $resultado['id_proveedor'];
      $fecha_registro = $resultado['fecha_registro'];
      $producto = Producto::CreateProducto($id,$nombre,$descripcion,$precio,$id_proveedor,$fecha_registro);
      $sql = $conn->prepare('SELECT * FROM proveedores WHERE id = :id');
      $sql->execute(array('id' => $producto->getId_proveedor()));
      $resultado = $sql->fetch();  
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $direccion = $resultado['direccion'];
      $telefono = $resultado['telefono'];
      $fecha_registro = $resultado['fecha_registro']; 
      $proveedor = Proveedor::CreateProveedor($id,$nombre,$direccion,$telefono,$fecha_registro);
      $producto->setProveedor($proveedor);  
      $conexion->cerrar_conexion();
      return $producto;   
   }  

   public function Agregar($producto) {
      $nombre = $producto->getNombre();
      $descripcion = $producto->getDescripcion();
      $precio = $producto->getPrecio();
      $id_proveedor = $producto->getId_proveedor();
      $fecha_registro = $producto->getFecha_registro();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('INSERT INTO productos(nombre,descripcion,precio,id_proveedor,fecha_registro) VALUES(:nombre,:descripcion,:precio,:id_proveedor,:fecha_registro)');
        $sql->execute(array('nombre' => $nombre,'descripcion' => $descripcion,'precio' => $precio,'id_proveedor' => $id_proveedor,'fecha_registro'=>$fecha_registro)); 
        $conexion->cerrar_conexion();
        return $conn->lastInsertId();
      } catch (PDOException $e) {
        return false;
      }     
   }

   public function Editar($producto) {
      $id = $producto->getId();
      $nombre = $producto->getNombre();
      $descripcion = $producto->getDescripcion();
      $precio = $producto->getPrecio();
      $id_proveedor = $producto->getId_proveedor();
      $fecha_registro = $producto->getFecha_registro();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, id_proveedor = :id_proveedor WHERE id = :id');
        $sql->execute(array('nombre' => $nombre,'descripcion' => $descripcion,'precio' => $precio,'id_proveedor' => $id_proveedor,'id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function Borrar($producto) {
      $id = $producto->getId();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM productos WHERE id = :id');
        $sql->execute(array('id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function comprobarExistenciaCrear($nombre) {
      $response = false;
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM productos WHERE nombre = :nombre');
      $sql->execute(array('nombre' => $nombre));
      $resultado = $sql->fetchAll();
      $cantidad = count($resultado);
      if($cantidad >= 1) {
        $response = true;
      } else {
        $response = false;
      }
      $conexion->cerrar_conexion();
      return $response;
   }

   public function comprobarExistenciaEditar($id,$nombre) {
      $response = false;
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM productos WHERE nombre = :nombre AND id != :id');
      $sql->execute(array('nombre' => $nombre,'id' => $id));
      $resultado = $sql->fetchAll();
      $cantidad = count($resultado);
      if($cantidad >= 1) {
        $response = true;
      } else {
        $response = false;
      }
      $conexion->cerrar_conexion();
      return $response;
   }
            	   
   public function __destruct(){
   }  

}

?>