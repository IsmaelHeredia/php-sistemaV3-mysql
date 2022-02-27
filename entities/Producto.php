<?php

class Producto
{
    
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $id_proveedor;
    private $fecha_registro;

    private $proveedor;
    
    public function __construct()
    {
        $this->id     = "";
        $this->nombre = "";
        $this->descripcion     = "";
        $this->precio          = "";
        $this->fecha_registro  = "";
        $this->id_proveedor    = "";

        $this->proveedor = "";
    }
    
    public static function CreateProducto($id, $nombre, $descripcion, $precio, $id_proveedor, $fecha_registro)
    {
        $instance                  = new self();
        $instance->id     = $id;
        $instance->nombre = $nombre;
        $instance->descripcion     = $descripcion;
        $instance->precio          = $precio;
        $instance->id_proveedor    = $id_proveedor;
        $instance->fecha_registro  = $fecha_registro;
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
    
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    
    public function getPrecio()
    {
        return $this->precio;
    }
    
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    
    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }
    
    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }
    
    public function getId_proveedor()
    {
        return $this->id_proveedor;
    }
    
    public function setId_proveedor($id_proveedor)
    {
        $this->id_proveedor = $id_proveedor;
    }
    
    public function getProveedor()
    {
        return $this->proveedor;
    }
    
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function __destruct()
    {
        $this->id     = "";
        $this->nombre = "";
        $this->descripcion     = "";
        $this->precio          = "";
        $this->fecha_registro  = "";
        $this->id_proveedor    = "";

        $this->proveedor = "";
    }
    
    public function toString()
    {
        return "Producto{" . "id=" . $this->id . ", nombre=" . $this->nombre . ", descripcion=" . $this->descripcion . ", precio=" . $this->precio . ", fecha_registro=" . $this->fecha_registro . ", id_proveedor=" . $this->id_proveedor . '}';
    }
    
}

?>