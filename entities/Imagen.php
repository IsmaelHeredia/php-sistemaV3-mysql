<?php

class Imagen
{
    
    private $id;
    private $nombre;
    private $tamaño;
    private $id_producto;
    private $fecha_registro;
    private $identificador;
    private $id_usuario;

    public function __construct()
    {
        $this->id     = "";
        $this->nombre = "";
        $this->tamaño     = "";
        $this->id_producto          = "";
        $this->fecha_registro  = "";
        $this->identificador    = "";
        $this->id_usuario = "";
    }
    
    public static function CreateImagen($id, $nombre, $tamaño, $id_producto, $fecha_registro, $identificador,$id_usuario)
    {
        $instance                  = new self();
        $instance->id     = $id;
        $instance->nombre = $nombre;
        $instance->tamaño     = $tamaño;
        $instance->id_producto         = $id_producto;
        $instance->fecha_registro    = $fecha_registro;
        $instance->identificador  = $identificador;
        $instance->id_usuario  = $id_usuario;
        return $instance;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    
    public function getTamaño()
    {
        return $this->tamaño;
    }
    
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;
    }
    
    public function getId_producto()
    {
        return $this->id_producto;
    }
    
    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;
    }
    
    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }
    
    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }
    
    public function getIdentificador()
    {
        return $this->identificador;
    }
    
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    
    public function __destruct()
    {
        $this->id     = "";
        $this->nombre = "";
        $this->tamaño     = "";
        $this->id_producto          = "";
        $this->fecha_registro  = "";
        $this->identificador    = "";
        $this->id_usuario    = "";

        $this->proveedor = "";
    }
    
    public function toString()
    {
        return "Imagen{" . "id=" . $this->id . ", nombre=" . $this->nombre . ", tamaño=" . $this->tamaño . ", id_producto=" . $this->id_producto . ", fecha_registro=" . $this->fecha_registro . ", identificador=" . $this->identificador . ", id_usuario=" . $this->id_usuario . "}";
    }
    
}

?>