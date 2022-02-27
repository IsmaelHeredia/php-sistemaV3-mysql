<?php

class Usuario {

  private $id;
  private $nombre;
  private $clave;
  private $id_tipo;
  private $fecha_registro;

  private $tipo;

  public function __construct(){
    $this->id = "";
		$this->nombre = "";
		$this->clave = "";
		$this->id_tipo = "";
		$this->fecha_registro = "";

    $this->tipo = "";
   }

  public static function CreateUsuario($id,$nombre,$clave,$id_tipo,$fecha_registro) {
   		$instance = new self();
    	$instance->id = $id;
  		$instance->nombre = $nombre;
  		$instance->clave = $clave;
  		$instance->id_tipo = $id_tipo;
  		$instance->fecha_registro = $fecha_registro;
    	return $instance;
  }

  public function getId() {
    	return $this->id;
  }

  public function setId($id) {
    	$this->id = $id;
  }
  
  public function getNombre() {
   	 	return $this->nombre;
  }

  public function setNombre($nombre) {
    	$this->nombre = $nombre;
  }
  
  public function getClave() {
    	return $this->clave;
  }

  public function setClave($clave) {
    	$this->clave = $clave;
  }

  public function getId_tipo() {
   	 	return $this->id_tipo;
  }

  public function setId_tipo($id_tipo) {
   	 	$this->id_tipo = $id_tipo;
  }
  
  public function getTipo() {
      return $this->tipo;
  }

  public function setTipo($tipo) {
      $this->tipo = $tipo;
  }

  public function getFecha_registro() {
    	return $this->fecha_registro;
  }

  public function setFecha_registro($fecha_registro) {
    	$this->fecha_registro = $fecha_registro;
  }
  
  public function __destruct(){
    	$this->id = "";
		$this->nombre = "";
		$this->clave = "";
		$this->id_tipo = "";
		$this->fecha_registro = "";
   }  
   
   public function toString() {
		return "Usuario{" . "id=" . $this->id . ", nombre=" . $this->nombre . ", clave=" . $this->clave . ", id_tipo=" . $this->id_tipo . ", fecha_registro=" . $this->fecha_registro . '}';
   }
  
}

?>