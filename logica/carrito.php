<?php
require_once 'persistencia/Conexion.php';
require_once 'persistencia/CarritoDAO.php';

class carrito {
    
    private $idCarrito; 
    private $idProducto; 
    private $idCliente;
    private $cantidad;
    private $conecxion;
    private $carritoDAO;
    
    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    function __construct($pIdCarrito = "", $pIdProducto="", $pIdCliente = "", $pCantidad = "" ) {
        $this -> idCarrito = $pIdCarrito;
        $this -> idProducto = $pIdProducto;
        $this -> idCliente = $pIdCliente;
        $this -> cantidad = $pCantidad;
        
        $this -> conecxion = new Conexion();
        $this -> carritoDAO = new CarritoDAO($this -> idCarrito, $this -> idProducto, $this -> idCliente, $this -> cantidad);
    }
    
    function guardaProductos() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> carritoDAO -> guardaProductos());
        $this -> conecxion -> cerrar();
    }
    
    function productoExiste() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> carritoDAO -> productoExiste());
        if ($this -> conecxion -> numFilas() == 1) {
            $resultado = $this -> conecxion -> extraer()[0];
            $this -> conecxion -> cerrar();
            return $resultado;
        }
        $this -> conecxion -> cerrar();
        return FALSE;
    }
    
    function updateProducto() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> carritoDAO -> updateProducto());
        $this -> conecxion -> cerrar();
    }
    
    function eliminar() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> carritoDAO -> eliminar());
        $this -> conecxion -> cerrar();
    }
    
    function listaCarrito($param) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> carritoDAO -> listaCarrito($param));
        $listaCarrito = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){
            array_push($listaCarrito, new carrito($resultado[0], $resultado[1], "", $resultado[2]));
        }
        $this -> conecxion -> cerrar();
        return $listaCarrito;
     }
    
}
    
?>

