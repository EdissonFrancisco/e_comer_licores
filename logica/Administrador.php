<?php 
require_once 'persistencia/Conexion.php';
require_once 'persistencia/AdministradorDAO.php';

class Administrador {
    private $idAdministrador; 	 	
    private $nombre;	
    private $apellido;
    private $nit_cc;
    private $direccion;
    private $correo;
    private $clave;
    private $conecxion;
    private $administradorDAO;

    public function getIdAdministrador(){
        return $this->idAdministrador;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getNit_cc(){
        return $this->nit_cc;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function __construct($idAdministrador="",  $nombre="", $apellido="", $nit_cc="", $direccion="", $correo="",$clave="") {
        $this -> idAdministrador = $idAdministrador; 	 	
        $this -> nombre = $nombre;	
        $this -> apellido = $apellido;
        $this -> nit_cc = $nit_cc;
        $this -> direccion = $direccion;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> conecxion = new Conexion();        
        $this -> administradorDAO = new AdministradorDAO($this -> idAdministrador, $this -> nombre, $this -> apellido, $this -> nit_cc, $this -> direccion, $this -> correo, $this -> clave);
    } 
    
    function autentica() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> administradorDAO -> autenticar());
        if($this -> conecxion -> numFilas() == 1){
            $this -> idAdministrador = $this -> conecxion -> extraer()[0];
            $this -> conecxion -> cerrar();
            return true;
        }
        $this -> conecxion -> cerrar();
        return false;
    }
    
    function consultaTodo() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> administradorDAO -> consultaTodo());   
        $resultado = $this -> conecxion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> nit_cc = $resultado[2];
        $this -> direccion = $resultado[3];
        $this -> correo = $resultado[4];        
        $this -> conecxion -> cerrar();
    }
    
    function actualizar() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> administradorDAO -> actualizar());
        $this -> conecxion -> cerrar();
    }

}

?>