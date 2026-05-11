<?php 

require_once 'persistencia/Conexion.php';
require_once 'persistencia/DomicilioDAO.php';

class Domicilio {
    private $idDomicilio;
    private $idDomiciliario;
    private $idCliente;
    private $idFactura;
    private $estadoEntrega;
    private $obserbaciones;
    private $conecxion;
    private $domicilioDAO;

    public function getIdDomicilio()
    {
        return $this->idDomicilio;
    }

    public function getIdDomiciliario()
    {
        return $this->idDomiciliario;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getIdFactura()
    {
        return $this->idFactura;
    }

    public function getEstadoEntrega()
    {
        return $this->estadoEntrega;
    }

    public function getObserbaciones()
    {
        return $this->obserbaciones;
    }

    function __construct ($pIdDomicilio = "", $pIdDomiciliario = "", $pIdCliente = "", $pIdFactura = "", $pEstadoEntrega = "", $pObserbaciones = "") {
        $this -> idDomicilio = $pIdDomicilio;
        $this -> idDomiciliario = $pIdDomiciliario;
        $this -> idCliente = $pIdCliente;
        $this -> idFactura = $pIdFactura;
        $this -> estadoEntrega = $pEstadoEntrega;
        $this -> obserbaciones = $pObserbaciones;
        $this -> conecxion = new Conexion();
        $this -> domicilioDAO = new DomicilioDAO($this -> idDomicilio, $this -> idDomiciliario, $this -> idCliente, $this -> idFactura, $this -> estadoEntrega, $this -> obserbaciones);
    }
    
    function ingresarDomicilio() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domicilioDAO -> ingresarDomicilio());
        $this -> conecxion -> cerrar();
    }
    
    function consultarAceptados() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domicilioDAO -> consultarAceptados());
        $domicilios = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $cliente = new Cliente($registro[1]);//llamo a marca
            $cliente -> consultar();//consulto datos
            $factura = new Factura($registro[2]);//
            $factura -> consultaTodoID();
            $envio = new Domicilio($registro[0],"",$cliente, $factura, $registro[2], $registro[3]);
            array_push($domicilios, $envio);
        }
        $this -> conecxion -> cerrar();
        return  $domicilios;	
    }
    
    function actualizar($estado) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domicilioDAO -> actualizar($estado));
        $this -> conecxion -> cerrar();
    }
    
    function entregadosDia($fechaHoy, $idDom) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domicilioDAO -> entregadosDia($fechaHoy, $idDom));
        $domicilios = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $cliente = new Cliente($registro[1]);//llamo a marca
            $cliente -> consultar();//consulto datos
            $factura = new Factura($registro[2]);//
            $factura -> consultaTodoID();
            $envio = new Domicilio($registro[0],"",$cliente, $factura, $registro[2], $registro[3]);
            array_push($domicilios, $envio);
        }
        $this -> conecxion -> cerrar();
        return  $domicilios;
    }
        
}

?>