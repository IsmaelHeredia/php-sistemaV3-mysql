<?php

class Proveedor
{
    
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $fecha_registro;
    
    public function __construct()
    {
        $this->id   = "";
        $this->nombre = "";
        $this->direccion      = "";
        $this->telefono       = "";
        $this->fecha_registro = "";
    }
    
    public static function CreateProveedor($id, $nombre, $direccion, $telefono, $fecha_registro)
    {
        $instance                 = new self();
        $instance->id   = $id;
        $instance->nombre = $nombre;
        $instance->direccion      = $direccion;
        $instance->telefono       = $telefono;
        $instance->fecha_registro = $fecha_registro;
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
    
    public function getDireccion()
    {
        return $this->direccion;
    }
    
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    
    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }
    
    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }
    
    public function __destruct()
    {
        $this->id   = "";
        $this->nombre = "";
        $this->direccion      = "";
        $this->telefono       = "";
        $this->fecha_registro = "";
    }
    
    public function toString()
    {
        return "Proveedor{" . "id=" . $this->id . ", nombre=" . $this->nombre . ", direccion=" . $this->direccion . ", telefono=" . $this->telefono . ", fecha_registro=" . $this->fecha_registro . '}';
    }
    
}

?>