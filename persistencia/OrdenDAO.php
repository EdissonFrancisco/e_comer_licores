<?php

class OrdenDAO
{

    private $idOrden;

    private $idProducto;

    private $idCliente;

    private $unidades;

    private $precioUnidad;

    private $subTotal;

    private $numOrden;

    private $estadoOrden;

    public function __construct($pIdOrden, $pIdProducto, $pIdCliente, $pUnidades, $pPrecioUnidad, $pSubTotal, $pNumOrden, $pEestadoOrden)
    {
        $this->idOrden = $pIdOrden;
        $this->idProducto = $pIdProducto;
        $this->idCliente = $pIdCliente;
        $this->unidades = $pUnidades;
        $this->precioUnidad = $pPrecioUnidad;
        $this->subTotal = $pSubTotal;
        $this->numOrden = $pNumOrden;
        $this->estadoOrden = $pEestadoOrden;
    }

    function ingresarOrden()
    {
        return "INSERT INTO orden(idProducto, idCliente, unidades, precioUnidad, subTotal, numOrden) 
                VALUES ('" . $this->idProducto . "','" . $this->idCliente . "','" . $this->unidades . "',
                        '" . $this->precioUnidad . "','" . $this->subTotal . "','" . $this->numOrden . "')";
    }

    function ultimaOrden($idCliente)
    {
        return "SELECT MAX(numOrden) FROM orden WHERE idCliente = '" . $idCliente . "'";
    }

    function productosFacturaOrden()
    {
        return "SELECT idProducto, unidades, precioUnidad, subTotal
                FROM orden 
                WHERE idCliente = '" . $this->idCliente . "' and numOrden = '" . $this->numOrden . "' ";
    }

    function consultarOrdenesDia($numorden, $idcliente)
    {
        return "SELECT idProducto, unidades, subTotal
                FROM orden 
                WHERE idCliente = '" . $idcliente . "' and numOrden = '" . $numorden . "' ";
    }

    function consultarProductosVendidos()
    {
        return "SELECT
                    orden.unidades,
                    tipoLicor.nombre
                FROM
                    orden
                INNER JOIN producto ON orden.idProducto = producto.idProducto
                INNER JOIN tipoLicor ON producto.idTipoLicor = tipoLicor.idTipoLicor";
    }
}

?>