<?php

class DomicilioDAO {
    private $idDomicilio;
    private $idDomiciliario;
    private $idCliente;
    private $idFactura;
    private $estadoEntrega;
    private $obserbaciones;
    
    function __construct ($pIdDomicilio, $pIdDomiciliario, $pIdCliente, $pIdFactura, $pEstadoEntrega, $pObserbaciones) {
        $this -> idDomicilio = $pIdDomicilio;
        $this -> idDomiciliario = $pIdDomiciliario;
        $this -> idCliente = $pIdCliente;
        $this -> idFactura = $pIdFactura;
        $this -> estadoEntrega = $pEstadoEntrega;
        $this -> obserbaciones = $pObserbaciones;
    }
    
    function ingresarDomicilio() {
        return "INSERT INTO domicilio (idDomiciliario, idCliente, idFactura, estadoEntrega, obserbaciones) 
                VALUES ('" . $this->idDomiciliario . "','" . $this->idCliente . "','" . $this->idFactura . "','" . $this->estadoEntrega . "','" . $this->obserbaciones . "')";
    }
    
    function consultarAceptados() {
        return "SELECT idDomicilio, idCliente, idFactura, estadoEntrega, obserbaciones 	
                FROM domicilio
                WHERE idDomiciliario = '" . $this -> idDomiciliario . "' AND estadoEntrega = 1";
    }
    
    function actualizar($estado) {
        return "UPDATE domicilio 
                SET estadoEntrega = '" . $estado . "' 
                WHERE idFactura = '" . $this -> idFactura ."'";
    }
    
    function entregadosDia($fechaHoy, $idDom) {
        return "SELECT DISTINCT domicilio.idDomicilio, domicilio.idCliente, domicilio.idFactura, domicilio.estadoEntrega, domicilio.obserbaciones 
                FROM domicilio, factura
                WHERE domicilio.estadoEntrega = 2 and factura.fecha = '" . $fechaHoy . "' AND idDomiciliario = '" . $idDom . "'";
    }
    
}
?>
