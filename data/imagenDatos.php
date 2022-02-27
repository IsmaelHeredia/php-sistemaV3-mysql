<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("entities/Imagen.php");

class ImagenDatos {

	 public function __construct() {

	 }

   public function ListarPorProducto($cargar_id_producto) {
      $imagenes = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM imagenes WHERE id_producto = :id_producto');
      $sql->execute(array('id_producto' => $cargar_id_producto));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $tamaño = $fila['tamaño'];
        $id_producto = $fila['id_producto'];
        $fecha_registro = $fila['fecha_registro'];
        $identificador = $fila['identificador'];
        $id_usuario = $fila['id_usuario'];
        $imagen = Imagen::CreateImagen($id,$nombre,$tamaño,$id_producto,$fecha_registro,$identificador,$id_usuario);
        array_push($imagenes,$imagen);
      }
      $conexion->cerrar_conexion();
      return $imagenes; 
   }

   public function ListarPorIdentificacion($cargar_identificador) {
      $imagenes = array();
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM imagenes WHERE identificador = :identificador');
      $sql->execute(array('identificador' => $cargar_identificador));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $tamaño = $fila['tamaño'];
        $id_producto = $fila['id_producto'];
        $fecha_registro = $fila['fecha_registro'];
        $identificador = $fila['identificador'];
        $id_usuario = $fila['id_usuario'];
        $imagen = Imagen::CreateImagen($id,$nombre,$tamaño,$id_producto,$fecha_registro,$identificador,$id_usuario);
        array_push($imagenes,$imagen);
      }
      $conexion->cerrar_conexion();
      return $imagenes; 
   }

   public function ListarImagenesSinAsignar($id_usuario) {
      $imagenes = array();
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM imagenes WHERE id_producto IS NULL AND id_usuario = :id_usuario');
      $sql->execute(array('id_usuario' => $id_usuario));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $tamaño = $fila['tamaño'];
        $id_producto = $fila['id_producto'];
        $fecha_registro = $fila['fecha_registro'];
        $identificador = $fila['identificador'];
        $id_usuario = $fila['id_usuario'];
        $imagen = Imagen::CreateImagen($id,$nombre,$tamaño,$id_producto,$fecha_registro,$identificador,$id_usuario);
        array_push($imagenes,$imagen);
      }
      $conexion->cerrar_conexion();
      return $imagenes; 
   }

   public function CargarPorId($id) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM imagenes WHERE id = :id');
      $sql->execute(array('id' => $id));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $tamaño = $resultado['tamaño'];
      $id_producto = $resultado['id_producto'];
      $fecha_registro = $resultado['fecha_registro'];
      $identificador = $resultado['identificador'];
      $id_usuario = $resultado['id_usuario'];
      $imagen = Imagen::CreateImagen($id,$nombre,$tamaño,$id_producto,$fecha_registro,$identificador,$id_usuario);
      $conexion->cerrar_conexion();
      return $imagen; 
   }

   public function Agregar($imagen) {
      $nombre = $imagen->getNombre();
      $tamaño = $imagen->getTamaño();
      $fecha_registro = $imagen->getFecha_registro();
      $identificador = $imagen->getIdentificador();
      $id_usuario = $imagen->getId_usuario();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();

        //$sql = $conn->prepare("INSERT INTO imagenes(nombre,tamaño,fecha_registro,identificador) VALUES(:nombre,:tamaño,:fecha_registro,:identificador)");
        //$sql->execute(array('nombre' => $nombre,'tamaño' => $tamaño,'fecha_registro'=>$fecha_registro,'identificador'=>$identificador)); 

        $sql = $conn->prepare('INSERT INTO imagenes(nombre,tamaño,fecha_registro,identificador,id_usuario) VALUES(?,?,?,?,?)');
        $sql->execute(array($nombre,$tamaño,$fecha_registro,$identificador,$id_usuario)); 

        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        //print_r($e);exit;
        return false;
      }     
   }

   public function Editar($imagen) {
      $nombre = $imagen->getNombre();
      $tamaño = $imagen->getTamaño();
      $id_producto = $imagen->getId_producto();
      $fecha_registro = $imagen->getFecha_registro();
      $identificador = $imagen->getIdentificador();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE imagenes SET nombre = :nombre, tamaño = :tamaño, id_producto = :id_producto, fecha_registro = :fecha_registro, identificador = :identificador WHERE id = :id');
        $sql->execute(array('nombre' => $nombre,'tamaño' => $tamaño,'id_producto' => $id_producto,'fecha_registro' => $fecha_registro, 'identificador' => $identificador ,'id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function AsignarProducto($id_producto,$identificador) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE imagenes SET id_producto = :id_producto WHERE identificador = :identificador');
        $sql->execute(array('id_producto' => $id_producto,'identificador' => $identificador)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function BorrarPorID($id) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM imagenes WHERE id = :id');
        $sql->execute(array('id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function BorrarPorIden($iden) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM imagenes WHERE identificador = :identificador');
        $sql->execute(array('identificador'=>$iden)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function BorrarPorNombre($nombre) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM imagenes WHERE nombre = :nombre');
        $sql->execute(array('nombre'=>$nombre)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }
  
   public function BorrarPorProducto($id_producto) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM imagenes WHERE id_producto = :id_producto');
        $sql->execute(array('id_producto'=>$id_producto)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function __destruct(){
   }  

}

?>