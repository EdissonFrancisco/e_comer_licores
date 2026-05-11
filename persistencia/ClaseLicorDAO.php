<?php 
class ClaseLicorDAO {
    private $idClaseLicor ;
    private $nombre;
    private $descripcion;    
    
    function __construct($pIdClaseLicor , $pNombre, $pDescripcion) {
        $this -> idClaseLicor = $pIdClaseLicor ;
        $this -> nombre = $pNombre;
        $this -> descripcion = $pDescripcion;
    }
    
    function crearTipoLicor() {
        return "INSERT INTO tipoLicor(nombre, descripcion) 
                VALUES ('" . $this -> nombre . "', '" . $this -> descripcion . "')";
    }
    
    function consultarClases() {
        return "SELECT idTipoLicor, nombre, descripcion
                FROM tipoLicor";
    }
    
    function consultarClaseId() {
        return "SELECT nombre, descripcion
                FROM tipoLicor
                WHERE idTipoLicor = '" . $this->idClaseLicor . "'";
    }
}

?>
