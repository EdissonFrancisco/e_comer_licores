<?php
class CarritoDAO {
    
    private $idCarrito;
    private $idProducto;
    private $idCliente;
    private $cantidad;

    function __construct($pIdCarrito, $pIdProducto, $pIdCliente, $pCantidad) {
        $this -> idCarrito = $pIdCarrito;
        $this -> idProducto = $pIdProducto;
        $this -> idCliente = $pIdCliente;
        $this -> cantidad = $pCantidad;
    }
    
    function guardaProductos() {
        return "INSERT INTO carrito (idProducto, idCliente, cantidad) 
                VALUES ('" . $this -> idProducto . "','" . $this -> idCliente . "','" . $this -> cantidad . "')";
    }
    
    function productoExiste() {
        return "SELECT cantidad 	
                FROM carrito 
                WHERE idProducto = '" . $this -> idProducto . "' and idCliente = '" . $this -> idCliente . "'";
    }
    
    function updateProducto() {
        return "UPDATE carrito
                SET cantidad = '" . $this -> cantidad . "'
                WHERE idProducto = '" . $this -> idProducto . "' and idCliente = '" . $this -> idCliente . "'";
    }
    
    function listaCarrito($param) {
        return "SELECT idCarrito, idProducto, cantidad 
                FROM carrito 
                WHERE idCliente = '" . $param . "'"; 
    }
    
    function eliminar() {
        return "DELETE FROM carrito WHERE idProducto = '" . $this->idProducto . "' and idCliente = '" . $this->idCliente . "'";
    }
}


?>