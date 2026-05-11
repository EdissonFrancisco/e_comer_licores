<?php 
require_once 'persistencia/Conexion.php';
require_once 'persistencia/OrdenDAO.php';
class Orden {
    private $idOrden;
    private $idProducto;
    private $idCliente;
    private $unidades;
    private $precioUnidad;
    private $subTotal;
    private $numOrden;
    private $estadoOrden;
    private $conecxion;
    private $ordenDAO;
    
    public function getIdOrden()
    {
        return $this->idOrden;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function getPrecioUnidad()
    {
        return $this->precioUnidad;
    }

    public function getSubTotal()
    {
        return $this->subTotal;
    }

    public function getNumOrden()
    {
        return $this->numOrden;
    }
    
    public function getEstadoOrden ()
    {
        return $this->estadoOrden;
    }

    public function __construct($pIdOrden = "", $pIdProducto = "", $pIdCliente = "", $pUnidades = "", $pPrecioUnidad = "", $pSubTotal = "", $pNumOrden = "", $pEestadoOrden ="" ) {
        $this -> idOrden = $pIdOrden;
        $this -> idProducto = $pIdProducto;
        $this -> idCliente = $pIdCliente;
        $this -> unidades = $pUnidades;
        $this -> precioUnidad = $pPrecioUnidad;
        $this -> subTotal = $pSubTotal;
        $this -> numOrden = $pNumOrden;
        $this -> estadoOrden = $pEestadoOrden;
        $this -> conecxion = new Conexion();
        $this -> ordenDAO = new OrdenDAO($pIdOrden, $pIdProducto, $pIdCliente, $pUnidades, $pPrecioUnidad, $pSubTotal, $pNumOrden, $pEestadoOrden);
    }

    function ingresarOrden() {//ingreso los datos de la tabla orden
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> ordenDAO -> ingresarOrden());
        $this -> conecxion -> cerrar();
    }
    
    function ultimaOrden($idCliente) {// MAX(numOrden) del cliente; null si aún no tiene compras
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> ordenDAO -> ultimaOrden($idCliente));
        $fila = $this -> conecxion -> extraer();
        $this -> conecxion -> cerrar();
        if ($fila !== null && isset($fila[0]) && $fila[0] !== null && $fila[0] !== '') {
            return (int) $fila[0];
        }
        return null;
    }
    
    function productosFacturaOrden() {
        $this -> conecxion -> abrir();//abro conexion
        //echo $this -> ordenDAO -> productosFacturaOrden();
        $this -> conecxion -> ejecutar($this -> ordenDAO -> productosFacturaOrden());//ejecuto consulta
        $productoFactura = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $producto = new Producto($resultado[0]);
            //$productirijillo = $producto -> consultarPorFactura();
            $producto -> consultarPorFactura();
            $orden = new Orden("", $producto, "", $resultado[1], $resultado[2], $resultado[3], "", "");
            array_push($productoFactura, $orden);
        }
        $this -> conecxion -> cerrar();
        return  $productoFactura;
    }
    
    function consultarOrdenesDia($numorden, $idcliente) {
        $this -> conecxion -> abrir();//abro conexion
        //echo $this -> ordenDAO -> consultarOrdenesDia($numorden, $idcliente);
        $this -> conecxion -> ejecutar($this -> ordenDAO -> consultarOrdenesDia($numorden, $idcliente));//ejecuto consulta
        $productoFactura = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $producto = new Producto($resultado[0]);
            $producto -> consultarPorFactura();//consulto los productos de una factura
            $orden = new Orden("", $producto, "", $resultado[1], "", $resultado[2], "", "");
            array_push($productoFactura, $orden);
        }
        $this -> conecxion -> cerrar();
        return  $productoFactura;
    }
    
    function consultarProductosVendidos() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> ordenDAO -> consultarProductosVendidos());
        $ventas = array();
        while(($registro = $this -> conecxion -> extraer()) != null){
            array_push($ventas, $registro);
        }
        $this -> conecxion -> cerrar();
        return  $ventas;
    }
}
?>