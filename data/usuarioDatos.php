<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("entities/Usuario.php");
include_once("entities/TipoUsuario.php");

class UsuarioDatos {

	 public function __construct() {

	 }

   public function Listar($patron) {
      $usuarios = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM usuarios WHERE nombre LIKE :patron');
      $sql->execute(array('patron' => '%'.$patron.'%'));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $clave = $fila['clave'];
        $tipo = $fila['id_tipo'];
        $fecha_registro = $fila['fecha_registro'];
        $usuario = Usuario::CreateUsuario($id,$nombre,$clave,$tipo,$fecha_registro);
        array_push($usuarios,$usuario);
      }
      foreach ($usuarios as $usuario) {
        $sql = $conn->prepare('SELECT * FROM tipos_usuarios WHERE id = :id');
        $sql->execute(array('id' => $usuario->getId_tipo()));
        $resultado = $sql->fetch();
        $id = $resultado['id'];
        $nombre = $resultado['nombre'];
        $tipo = TipoUsuario::CreateTipoUsuario($id,$nombre); 
        $usuario->setTipo($tipo);       
      }
      $conexion->cerrar_conexion();
      return $usuarios;  
   }

   public function Cargar($id) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
      $sql->execute(array('id' => $id));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $clave = $resultado['clave'];
      $tipo = $resultado['id_tipo'];
      $fecha_registro = $resultado['fecha_registro'];
      $usuario = Usuario::CreateUsuario($id,$nombre,$clave,$tipo,$fecha_registro);
      $sql = $conn->prepare('SELECT * FROM tipos_usuarios WHERE id = :id');
      $sql->execute(array('id' => $usuario->getId_tipo()));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $tipo = TipoUsuario::CreateTipoUsuario($id,$nombre); 
      $usuario->setTipo($tipo);   
      $conexion->cerrar_conexion();
      return $usuario;  
   }

   public function Agregar($usuario) {
      $nombre = $usuario->getNombre();
      $clave = $usuario->getClave();
      $id_tipo = $usuario->getId_tipo();
      $fecha_registro = $usuario->getFecha_registro();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('INSERT INTO usuarios(nombre,clave,id_tipo,fecha_registro) VALUES(:nombre,:clave,:id_tipo,:fecha_registro)');
        $sql->execute(array('nombre' => $nombre,'clave' => $clave,'id_tipo' => $id_tipo,'fecha_registro'=>$fecha_registro)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      }     
   }

   public function Editar($usuario) {
      $id = $usuario->getId();
      $id_tipo = $usuario->getId_tipo();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE usuarios SET id_tipo = :id_tipo WHERE id = :id');
        $sql->execute(array('id_tipo' => $id_tipo,'id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function Borrar($usuario) {
      $id = $usuario->getId();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM usuarios WHERE id = :id');
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
      $sql = $conn->prepare('SELECT * FROM usuarios WHERE nombre = :nombre');
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
      $sql = $conn->prepare('SELECT * FROM usuarios WHERE nombre = :nombre AND id != :id');
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