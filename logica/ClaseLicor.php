<?php 
require_once 'persistencia/Conexion.php';
require_once 'persistencia/ClaseLicorDAO.php';

class ClaseLicor {
    private $idClaseLicor;
    private $nombre;
    private $descripcion;
    private $conecxion;
    private $claselicorDAO;
    
    public function getIdClaseLicor()
    {
        return $this->idClaseLicor;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    function __construct($pIdClaseLicor = "", $pNombre = "", $pDescripcion = "") {
        $this -> idClaseLicor = $pIdClaseLicor;
        $this -> nombre = $pNombre;
        $this -> descripcion = $pDescripcion;
        $this -> conecxion = new Conexion();
        $this -> claselicorDAO = new ClaseLicorDAO($pIdClaseLicor, $pNombre, $pDescripcion);
    }
    
    function crearTipoLicor() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> claselicorDAO -> crearTipoLicor());
        $this -> conecxion -> cerrar();
    }
    
    function consultarClases(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> claselicorDAO -> consultarClases());
        $ClasesL = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){
            array_push($ClasesL, new ClaseLicor($resultado[0], $resultado[1], $resultado[2]));
        }
        $this -> conecxion -> cerrar();
        return $ClasesL;
    }
    
    function consultarClaseId(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> claselicorDAO -> consultarClaseId());
        $registro = $this -> conecxion -> extraer();
        $this -> nombre = $registro[0];
        $this -> descripcion = $registro[1];
        $this -> conecxion -> cerrar();
    }
}

?>