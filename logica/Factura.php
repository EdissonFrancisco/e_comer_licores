<?php 
require_once 'persistencia/Conexion.php';
require_once 'persistencia/FacturaDAO.php';
class Factura {
    private $idFactura;
    private $idCliente;
    private $fecha;
    private $hora;
    private $tipoEntrega;
    private $numOrden;
    private $estadoEntrega;
    private $conecxion;
    private $facturaDAO;
    
    public function getIdFactura()
    {
        return $this->idFactura;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function getTipoEntrega()
    {
        return $this->tipoEntrega;
    }
    
    public function getNumOrden()
    {
        return $this->numOrden;
    }

    public function getEstadoEntrega()
    {
        return $this->estadoEntrega;
    }
    
    public function __construct($pIdFactura = "", $pIdCliente = "", $pFecha = "", $pHora = "", $pTipoEntrega = "", $pNumOrden="", $pEstadoEntrega = ""){
        $this -> idFactura = $pIdFactura;
        $this -> idCliente = $pIdCliente;
        $this -> fecha = $pFecha;
        $this -> hora = $pHora;
        $this -> tipoEntrega = $pTipoEntrega;
        $this -> numOrden = $pNumOrden;
        $this -> estadoEntrega = $pEstadoEntrega;
        $this -> conecxion = new Conexion();
        $this -> facturaDAO = new FacturaDAO($this -> idFactura, $this -> idCliente, $this -> fecha, $this -> hora, $this -> tipoEntrega, $this->numOrden, $this -> estadoEntrega);
    }
    
    function crearFactura() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> crearFactura());
        $this -> conecxion -> cerrar();
    }
    
    function consultarDisponibles() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> consultarDisponibles());
        
        $facturitas = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $cliente = new Cliente($resultado[1]);
            $cliente -> consultar();            
            $facturado = new Factura($resultado[0], $cliente, $resultado[2], $resultado[3], $resultado[4], $resultado[5], $resultado[6]);
            array_push($facturitas, $facturado);
        }
        $this -> conecxion -> cerrar();
        return  $facturitas;
    }
    
    function consultaTodoID() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> consultaTodoID());
        $resultado = $this -> conecxion -> extraer();
        $this -> idCliente = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> hora = $resultado[2];
        $this -> tipoEntrega = $resultado[3];
        $this -> numOrden = $resultado[4];
        $this -> estadoEntrega = $resultado[5];
        $this -> conecxion -> cerrar();
    }
    
    function cambiarEstado($estado) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> cambiarEstado($estado));
        $this -> conecxion -> cerrar();
    }
    
    function ultimaFactura() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> ultimaFactura());
        $resultado = $this -> conecxion -> extraer();
        $this -> conecxion -> cerrar();
        if ($resultado === null) {
            return;
        }
        $this -> idFactura = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> hora = $resultado[2];
        $this -> tipoEntrega = $resultado[3];
        $this -> numOrden = $resultado[4];
        $this -> estadoEntrega = $resultado[5];
    }
    
    function busquedaHistorialVentas($fechaDia) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> facturaDAO -> busquedaHistorialVentas($fechaDia));
        
        $facturitas = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $ordenes = new Orden();
            $ordenn = $ordenes -> consultarOrdenesDia($resultado[3], $resultado[0]);
            //var_dump($ordenn);
            $facturado = new Factura("", $resultado[0], $resultado[1], "", $resultado[2], $ordenn, $resultado[3]);
            array_push($facturitas, $facturado);
        }
        $this -> conecxion -> cerrar();
        return  $facturitas;
    }
}



