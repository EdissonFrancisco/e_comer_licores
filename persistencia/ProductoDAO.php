<?php 
class ProductoDAO {
    private $idProducto;
    private $idMarca;
    private $idClaseLicor;
    private $tipo;
    private $foto;
    private $valorUnidad; 	
    private $inventario;
    private $estado; 	

    function __construct($pIdProducto, $pIdMarca, $pIdClaseLicor, $pTipo, $pFoto, $pValorUnidad, $pInventario, $pEstado) {
        $this -> idProducto = $pIdProducto;
        $this -> idMarca = $pIdMarca;
        $this -> idClaseLicor = $pIdClaseLicor;
        $this -> tipo = $pTipo;
        $this -> foto= $pFoto;
        $this -> valorUnidad = $pValorUnidad;
        $this -> inventario = $pInventario;
        $this -> estado = $pEstado;
    }
    
    function crearProducto() {
        return "INSERT INTO producto(idMarca, idTipoLicor, nombre, foto, valorUnidad, inventario, estado) 
                VALUES ('" . $this -> idMarca . "','" . $this -> idClaseLicor . "','" . $this -> tipo . "','" . $this->foto . "','" . $this -> valorUnidad . "','" . $this -> inventario . "','" . $this -> estado . "')";
    }
    
    function consultarTodos() {
        return "SELECT idProducto, idMarca, idTipoLicor, nombre, foto, valorUnidad, inventario, estado 
                FROM producto";
    }
    
    public function consultarTodosPag($pag, $regPag){
        return "SELECT idProducto, idMarca, idTipoLicor, nombre, foto, valorUnidad, inventario, estado 
                FROM producto
                limit " . (($pag - 1) * $regPag) . ", " . $regPag;
    }
    
    public function consultarNumReg(){
        return "select count(idProducto)
                FROM producto";
    }    
    
    function consultarPorFactura() {
        return "SELECT idMarca, idTipoLicor, nombre
                FROM producto
                WHERE idProducto = '" . $this -> idProducto . "'";
    }
    
    function consultar() {
        return "SELECT idMarca, idTipoLicor, nombre, foto, valorUnidad, inventario, estado
                FROM producto
                WHERE idProducto = '" . $this -> idProducto . "'";
    }
    
    function actualizar() {
        return "UPDATE producto set
                    idMarca = '" . $this -> idMarca . "',
                    idTipoLicor = '" . $this -> idClaseLicor . "',
                    nombre = '" . $this -> tipo . "',
                    valorUnidad = '" . $this -> valorUnidad . "', 
                    inventario = '" . $this -> inventario . "', 
                    estado = '" . $this -> estado . "'
                WHERE idProducto = '" . $this -> idProducto . "'";
    }
    
    function consultarFiltro($filtro) { 
        return "SELECT
                    pro.idProducto,
                    pro.idMarca, 
                    pro.idTipoLicor,
                    pro.nombre,
                    pro.foto,
                    pro.valorUnidad,
                    pro.inventario,
                    pro.estado
                FROM
                    producto pro
                JOIN marca mar ON (
                        pro.idMarca = mar.idMarca
                    )
                JOIN tipoLicor clas ON (
                        pro.idTipoLicor = clas.idTipoLicor
                    )
                WHERE mar.nombre LIKE '" . $filtro . "%' OR clas.nombre LIKE '" . $filtro . "%'";
    }
    
    function consultarFiltroVendedor($marca, $clase) {
        return "SELECT pro.idProducto, pro.idMarca, pro.idTipoLicor, pro.nombre, pro.foto, pro.valorUnidad, pro.inventario, pro.estado 
                FROM producto pro JOIN marca mar 
                     ON ( pro.idMarca = mar.idMarca ) 
                                  JOIN tipoLicor clas 
                     ON ( pro.idTipoLicor = clas.idTipoLicor ) 
                WHERE mar.idMarca = '" . $marca . "' AND clas.idTipoLicor = '" . $clase . "'";
    }
    
    function cambiarEstado($estado) {
        return "update producto set estado = '" . $estado . "'
                where idProducto = '" . $this -> idProducto . "'";
    }
    
    function insertarFoto() {
        return"update producto set foto = '" . $this -> foto . "'
               where idProducto = '" . $this -> idProducto . "'";
    }
    function consultarID() {
        return "SELECT MAX(idProducto) AS id FROM producto";
    }
    
    function editarImagen(){
        return "update producto
                set foto = '" . $this -> foto . "'
                where idProducto = '" . $this -> idProducto . "'";
    }
    
    function buscarTipo($op) {
        return "SELECT idProducto, idMarca, idTipoLicor, nombre, foto, valorUnidad, inventario, estado 
                FROM producto 
                WHERE idTipoLicor = '" . $op . "'";
    }
    
    function totalRegistroFiltro($op) {
        return "select count(idProducto)
                from producto
                where idTipoLicor ='" . $op . "'";
    }
    
    function totalRegistros() {
        return "select count(idProducto)
                from producto";
    }
     
    function consultaPrecio($id) {
        return "SELECT valorUnidad FROM producto WHERE idProducto = '" . $id . "'";
    }
    
    function actualizaInventario($param) {
        return "update producto
                set inventario = '" . $param  . "'
                where idProducto = '" . $this -> idProducto . "'";
    }
}
?>
