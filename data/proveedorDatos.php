<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("entities/Proveedor.php");

class ProveedorDatos {

	 public function __construct() {

	 }

   public function Listar($patron) {
      $proveedores = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM proveedores WHERE nombre LIKE :patron');
      $sql->execute(array('patron' => '%'.$patron.'%'));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $direccion = $fila['direccion'];
        $telefono = $fila['telefono'];
        $fecha_registro = $fila['fecha_registro'];
        $proveedor = Proveedor::CreateProveedor($id,$nombre,$direccion,$telefono,$fecha_registro);
        array_push($proveedores,$proveedor);
      }
      $conexion->cerrar_conexion();
      return $proveedores; 
   }

   public function Cargar($id) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM proveedores WHERE id = :id');
      $sql->execute(array('id' => $id));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $direccion = $resultado['direccion'];
      $telefono = $resultado['telefono'];
      $fecha_registro = $resultado['fecha_registro'];
      $proveedor = Proveedor::CreateProveedor($id,$nombre,$direccion,$telefono,$fecha_registro);
      $conexion->cerrar_conexion();
      return $proveedor; 
   }

   public function Agregar($proveedor) {
      $nombre = $proveedor->getNombre();
      $direccion = $proveedor->getDireccion();
      $telefono = $proveedor->getTelefono();
      $fecha_registro = $proveedor->getFecha_registro();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('INSERT INTO proveedores(nombre,direccion,telefono,fecha_registro) VALUES(:nombre,:direccion,:telefono,:fecha_registro)');
        $sql->execute(array('nombre' => $nombre,'direccion' => $direccion,'telefono' => $telefono,'fecha_registro'=>$fecha_registro)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      }     
   }

   public function Editar($proveedor) {
      $id = $proveedor->getId();
      $nombre = $proveedor->getNombre();
      $direccion = $proveedor->getDireccion();
      $telefono = $proveedor->getTelefono();
      $fecha_registro = $proveedor->getFecha_registro();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE proveedores SET nombre = :nombre, direccion = :direccion, telefono = :telefono WHERE id = :id');
        $sql->execute(array('nombre' => $nombre,'direccion' => $direccion,'telefono' => $telefono,'id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function Borrar($proveedor) {
      $id = $proveedor->getId();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM proveedores WHERE id = :id');
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
      $sql = $conn->prepare('SELECT * FROM proveedores WHERE nombre = :nombre');
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
      $sql = $conn->prepare('SELECT * FROM proveedores WHERE nombre = :nombre AND id != :id');
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