<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");

class TipoUsuarioDatos {

	 public function __construct() {

	 }

   public function Listar($patron) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $tipos = array();
      $sql = $conn->prepare('SELECT * FROM tipos_usuarios WHERE nombre LIKE :patron');
      $sql->execute(array('patron' => '%'.$patron.'%'));
      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $tipo = TipoUsuario::CreateTipoUsuario($id,$nombre);
        array_push($tipos,$tipo);
      }
      $conexion->cerrar_conexion();
      return $tipos;  
   }
            	   
   public function __destruct(){
   }  

}

?>