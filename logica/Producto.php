<?php
require_once 'persistencia/Conexion.php';
require_once 'persistencia/ProductoDAO.php';

class Producto {
    private $idProducto;
    private $idMarca;
    private $idClaseLicor;
    private $tipo;
    private $foto;
    private $valorUnidad;
    private $inventario;
    private $estado;
    private $conecxion;
    private $productoDAO;
    
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function getIdClaseLicor()
    {
        return $this->idClaseLicor;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getValorUnidad()
    {
        return $this->valorUnidad;
    }

    public function getInventario()
    {
        return $this->inventario;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    
    function __construct($pIdProducto = "", $pIdMarca = "", $pIdClaseLicor = "", $pTipo = "", $pFoto = "", $pValorUnidad = "", $pInventario = "", $pEstado = "") {
        $this -> idProducto = $pIdProducto;
        $this -> idMarca = $pIdMarca;
        $this -> idClaseLicor = $pIdClaseLicor;
        $this -> tipo = $pTipo;
        $this -> foto= $pFoto;
        $this -> valorUnidad = $pValorUnidad;
        $this -> inventario = $pInventario; 
        $this -> estado = $pEstado;
        $this -> conecxion = new Conexion();
        $this -> productoDAO = new ProductoDAO($this -> idProducto, $this -> idMarca, $this -> idClaseLicor, $this -> tipo, $this -> foto, $this -> valorUnidad, $this -> inventario, $this -> estado);
    }
    
    function crearProducto() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> crearProducto());
        $this -> conecxion -> cerrar();
    }
    
    public function consultarTodo(){
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarTodos());//ejecuto consulta
        $productos = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $marca = new Marca($registro[1]);//llamo a marca
            $marca -> consultarMarcasId();//consulto datos    
            $clase = new ClaseLicor($registro[2]);//
            $clase -> consultarClaseId();
            $producto = new Producto($registro[0], $marca, $clase, $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($productos, $producto);
        }
        $this -> conecxion -> cerrar();
        return  $productos;
    }
    
    public function consultarTodosPag($pag, $regPag){
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarTodosPag($pag, $regPag));//ejecuto consulta
        $productos = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $marca = new Marca($registro[1]);//llamo a marca
            $marca -> consultarMarcasId();//consulto datos
            $clase = new ClaseLicor($registro[2]);//
            $clase -> consultarClaseId();
            $producto = new Producto($registro[0], $marca, $clase, $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($productos, $producto);
        }
        $this -> conecxion -> cerrar();
        return  $productos;
    }
    
    public function consultarNumReg(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarNumReg());
        $this -> conecxion -> cerrar();
        return $this -> conecxion -> extraer()[0];
    }
    
    public function consultarPorFactura(){
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarPorFactura());//ejecuto consulta
        $registro = $this -> conecxion -> extraer();
        $marca = new Marca($registro[0]);//llamo a marca
        $marca -> consultarMarcasId();//consulto datos
        $this -> idMarca = $marca;
        $clase = new ClaseLicor($registro[1]);//
        $clase -> consultarClaseId();
        $this -> idClaseLicor = $clase;
        $this -> tipo = $registro[2];
        $this -> conecxion -> cerrar();
    }
    
    public function consultar() {
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultar());
        $registro = $this -> conecxion -> extraer();
        $marca = new Marca($registro[0]);//llamo a marca
        $marca -> consultarMarcasId();//consulto datos
        $this -> idMarca = $marca;
        $clase = new ClaseLicor($registro[1]);//
        $clase -> consultarClaseId();
        $this -> idClaseLicor = $clase;
        $this -> tipo = $registro[2];
        $this -> foto= $registro[3];
        $this -> valorUnidad = $registro[4];
        $this -> inventario = $registro[5];
        $this -> estado = $registro[6];
        $this -> conecxion -> cerrar();        
    }
    
    function actualizar() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> actualizar());
        $marca = new Marca($this->idMarca);//llamo a marca
        $marca -> consultarMarcasId();//consulto datos
        $this -> idMarca = $marca;
        $clase = new ClaseLicor($this->idClaseLicor);//
        $clase -> consultarClaseId();
        $this -> idClaseLicor = $clase;
        $this -> conecxion -> cerrar();
    }
    /*FILTRO*/
    function consultarFiltro($filtro) {
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarFiltro($filtro));//ejecuto consulta
        $productos = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $marca = new Marca($registro[1]);//llamo a marca
            $marca -> consultarMarcasId();//consulto datos
            $clase = new ClaseLicor($registro[2]);//
            $clase -> consultarClaseId();
            $producto = new Producto($registro[0], $marca, $clase, $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($productos, $producto);
        }
        $this -> conecxion -> cerrar();
        return  $productos;
    }
    
    function consultarFiltroVendedor($marcaP, $claseP) {
        $this -> conecxion -> abrir();//abro conexion
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarFiltroVendedor($marcaP, $claseP));//ejecuto consulta
        $productos = array();//creo arreglo para contener productos
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $marca = new Marca($registro[1]);//llamo a marca
            $marca -> consultarMarcasId();//consulto datos
            $clase = new ClaseLicor($registro[2]);//
            $clase -> consultarClaseId();
            $producto = new Producto($registro[0], $marca, $clase, $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($productos, $producto);
        }
        $this -> conecxion -> cerrar();
        return  $productos;
    }
    
    function cambiarEstado($estado) {/** inserta datos de cliente en la BD */
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> cambiarEstado($estado));
        $this -> conecxion -> cerrar();
    }
    
    function consultarID() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultarID());
        $resultado = $this -> conecxion -> extraer()[0];
        $this -> conecxion -> cerrar();
        return $resultado;
    }
    
    function insertarfoto(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> insertarFoto());
        $this -> conecxion -> cerrar();
    }
    
    function editarImagen(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> editarImagen());
        $this -> conecxion -> cerrar();
    }
    
    function buscarTipo($op) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO  -> buscarTipo($op));
        $productos = array();
        while(($registro = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $clase = new ClaseLicor($registro[2]);//
            $clase -> consultarClaseId();
            $producto = new Producto($registro[0], $registro[1], $clase, $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($productos, $producto);
        }
        $this -> conecxion -> cerrar();
        return  $productos;
    }
    
    function totalRegistroFiltro($op) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> totalRegistroFiltro($op));
        $resultado = $this -> conecxion -> extraer()[0];
        $this -> conecxion -> cerrar();
        return $resultado;
    }
    
    function totalRegistros() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> totalRegistros());
        $resultado = $this -> conecxion -> extraer()[0];
        $this -> conecxion -> cerrar();
        return $resultado;
    }
    
    function consultaPrecio($id) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> consultaPrecio($id));
        $resultado = $this -> conecxion -> extraer()[0];
        $this -> conecxion -> cerrar();
        return $resultado;
    }
    
    function actualizaInventario($param) {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> productoDAO -> actualizaInventario($param));
        $this -> conecxion -> cerrar();
    }
}
?>