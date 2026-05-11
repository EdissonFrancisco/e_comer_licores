<?php
require_once 'persistencia/Conexion.php';
require_once 'persistencia/DomiciliarioDAO.php';

class Domiciliario {
    
    private $idDomiciliario;
    private $nombre;
    private $apellido;
    private $nit_cc;
    private $direccion;
    private $correo;
    private $clave;
    private $estado;
    private $conecxion;
    private $domiciliarioDAO;
    
    public function getIdDomiciliario()
    {
        return $this->idDomiciliario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getNit_cc()
    {
        return $this->nit_cc;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function __construct($pIdDomiciliario = "", $pNombre = "", $pApellido = "", $pNit_cc = "", $pDireccion = "", $pCorreo = "", $pClave = "", $pEstado = "") {
        $this -> idDomiciliario = $pIdDomiciliario;
        $this -> nombre = $pNombre;
        $this -> apellido = $pApellido;
        $this -> nit_cc = $pNit_cc;
        $this -> direccion = $pDireccion;
        $this -> correo = $pCorreo;
        $this -> clave = $pClave;
        $this -> estado = $pEstado;
        $this -> conecxion = new Conexion();
        $this -> domiciliarioDAO = new DomiciliarioDAO($this->idDomiciliario, $this->nombre, $this->apellido, $this->nit_cc, $this->direccion, $this->correo, $this->clave, $this->estado); 
    }
    
    function crearDomiciliario() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> crearDomiciliario());
        $this -> conecxion -> cerrar();
    }
    
    function consultarTodo() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> consultarTodo());
        
        $domi = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $domiciliario = new Domiciliario($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
            array_push($domi, $domiciliario);
        }
        
        $this -> conecxion -> cerrar();
        
        return  $domi;
    }
    
    public function consultarTodosPag($pag, $regPag){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> consultarTodosPag($pag, $regPag));
        
        $domi = array();
        while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
            $domiciliario = new Domiciliario($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
            array_push($domi, $domiciliario);
        }
        
        $this -> conecxion -> cerrar();
        
        return  $domi;
    }
    
    public function consultarNumReg(){
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> consultarNumReg());
        $n = $this -> conecxion -> extraer()[0];
        $this -> conecxion -> cerrar();
        return $n;
    }
    
    function consultar() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> consultar());
        $resultado = $this -> conecxion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> nit_cc = $resultado[2];
        $this -> direccion = $resultado[3];
        $this -> correo = $resultado[4];
        $this -> estado = $resultado[5];
        $this -> conecxion -> cerrar();
    }
    
    function cambiarEstado($estado) {/** actualiza datos de estado para el domiciliario en la BD */
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> cambiarEstado($estado));
        $this -> conecxion -> cerrar();
    }
    
    function autentica() {
        $this -> conecxion -> abrir();        
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> autentica());
        if($this -> conecxion -> numFilas() == 1){
            $this -> idDomiciliario = $this -> conecxion -> extraer()[0];
            $this -> conecxion -> cerrar();
            return true;
        }
        $this -> conecxion -> cerrar();
        return false;
    }
    
    function actualizar() {
        $this -> conecxion -> abrir();
        $this -> conecxion -> ejecutar($this -> domiciliarioDAO -> actualizar());
        $this -> conecxion -> cerrar();
    }
}

 	 	 	 	 	 	 	 	
?>