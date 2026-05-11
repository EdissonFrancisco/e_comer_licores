<?php 
class MarcaDAO {
    private $idMarca;
    private $nombre;
    private $descripcion;    
    
    function __construct($pIdMarca, $pNombre, $pDescripcion) {
        $this -> idMarca = $pIdMarca;
        $this -> nombre = $pNombre;
        $this -> descripcion = $pDescripcion;
    }
    
    function crearMarca() {
        return "INSERT INTO marca(nombre, descripcion) 
                VALUES ('" . $this -> nombre . "', '" . $this -> descripcion . "')";
    }
    
    function consultarMarcas() {
        return "SELECT idMarca, nombre, descripcion 
                FROM marca";
    }
    
    function consultarMarcasId() {
        return "SELECT nombre, descripcion
                FROM marca
                WHERE idMarca = '" . $this->idMarca . "'";
    }
    
}

?>