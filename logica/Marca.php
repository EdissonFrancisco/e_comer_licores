<?php 
require_once 'persistencia/Conexion.php';
require_once 'persistencia/MarcaDAO.php';


class Marca {
    private $idMarca;
    private $nombre;
    private $descripcion;
    private $conecxion;
    private $marcaDAO;
    
    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    function __construct($pIdMarca = "", $pNombre = "", $pDescripcion = "") {
        $this -> idMarca = $pIdMarca;
        $this -> nombre = $pNombre;
        $this -> descripcion = $pDescripcion;
        $this -> conecxion = new Conexion();
        $this->marcaDAO = new MarcaDAO($pIdMarca, $pNombre, $pDescripcion);
    }
    
    function crearMarca() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> marcaDAO -> crearMarca());
        $this -> conecxion -> cerrar();
    }
    
    function consultarMarcas(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> marcaDAO -> consultarMarcas());
        $MarcasL = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){
            array_push($MarcasL, new Marca($resultado[0], $resultado[1], $resultado[2]));
        }
        $this -> conecxion -> cerrar();
        return $MarcasL;
    }
    
    function consultarMarcasId(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> marcaDAO -> consultarMarcasId());
        $registro = $this -> conecxion -> extraer();
        $this -> nombre = $registro[0];
        $this -> descripcion = $registro[1];
        $this -> conecxion -> cerrar();
    }
}
?>