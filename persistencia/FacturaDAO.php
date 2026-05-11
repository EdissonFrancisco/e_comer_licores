<?php 
class FacturaDAO {
    private $idFactura;
    private $idCliente;
    private $fecha; 
    private $hora; 
    private $tipoEntrega;
    private $numOrden;
    private $estadoEntrega;	 
    
                               
    public function __construct($pIdFactura, $pIdCliente, $pFecha, $pHora, $pTipoEntrega, $pNumOrden, $pEstadoEntrega){
        $this -> idFactura = $pIdFactura;
        $this -> idCliente = $pIdCliente;        
        $this -> fecha = $pFecha; 
        $this -> hora = $pHora; 
        $this -> tipoEntrega = $pTipoEntrega;
        $this -> numOrden = $pNumOrden;
        $this -> estadoEntrega = $pEstadoEntrega;
    }
    
    function crearFactura() {
        $estado = ($this -> estadoEntrega === '' || $this -> estadoEntrega === null) ? '0' : $this -> estadoEntrega;
        return "INSERT INTO factura(idCliente, fecha, hora, tipoEntrega, numOrden, estadoEntrega) 
                VALUES ('" . $this -> idCliente ."','" . $this -> fecha . "','" . $this -> hora . "',
                        '" . $this -> tipoEntrega . "','" . $this -> numOrden . "','" . $estado . "')";
    }
    
    function consultarDisponibles() {
        return "SELECT idFactura, idCliente, fecha, hora, tipoEntrega, numOrden, estadoEntrega
                FROM factura
                WHERE estadoEntrega = 0";
    }
    
    function consultaTodoID() {
        return "SELECT idCliente, fecha, hora, tipoEntrega, numOrden, estadoEntrega
                FROM factura
                WHERE idFactura = '" . $this->idFactura . "'";
    }
    
    function cambiarEstado($estado) {
        return "UPDATE factura
                SET estadoEntrega = '" . $estado . "'
                WHERE idFactura = '" . $this -> idFactura ."'";
    }
    
    function ultimaFactura() {
        return "SELECT idFactura, fecha, hora, tipoEntrega, numOrden, estadoEntrega 
                FROM factura 
                WHERE idCliente = '" . $this -> idCliente . "' 
                ORDER BY numOrden DESC, idFactura DESC 
                LIMIT 1";
    }
    
    function busquedaHistorialVentas($fechaDia) {
        return "SELECT idCliente, fecha, tipoEntrega, numOrden, estadoEntrega 
                FROM factura 
                WHERE fecha = '" . $fechaDia . "'";
    }
}

