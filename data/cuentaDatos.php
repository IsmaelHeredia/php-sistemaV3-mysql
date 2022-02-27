<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");

class CuentaDatos {

	 public function __construct() {

	 }

   public function cambiarUsuario($usuario,$nuevo_usuario) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE usuarios SET nombre = :nuevo_usuario WHERE nombre = :usuario');
        $sql->execute(array('usuario'=>$usuario,'nuevo_usuario'=>$nuevo_usuario)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function cambiarClave($usuario,$nueva_clave) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE usuarios SET clave = :nueva_clave WHERE nombre = :usuario');
        $sql->execute(array('usuario'=>$usuario,'nueva_clave'=>$nueva_clave)); 
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