<?php

class DomiciliarioDAO {
    
    private $idDomiciliario;
    private $nombre;
    private $apellido;
    private $nit_cc;
    private $direccion;
    private $correo;
    private $clave;
    private $estado;
    
    function __construct($pIdDomiciliario, $pNombre, $pApellido, $pNit_cc, $pDireccion, $pCorreo, $pClave, $pEstado) {
        $this -> idDomiciliario = $pIdDomiciliario;
        $this -> nombre = $pNombre;
        $this -> apellido = $pApellido;
        $this -> nit_cc = $pNit_cc;
        $this -> direccion = $pDireccion;
        $this -> correo = $pCorreo;
        $this -> clave = $pClave;
        $this -> estado = $pEstado;
    }
    
    function crearDomiciliario() {
        return "INSERT INTO domiciliario(nombre, apellido, nit_cc, direccion, correo, clave, estado) 
                VALUES ('" . $this->nombre . "',
                        '" . $this->apellido . "',
                        '" . $this->nit_cc . "',
                        '" . $this->direccion . "',
                        '" . $this->correo . "',
                        '" . $this->clave . "',
                        '" . $this->estado . "')";
    }
    
    function consultarTodo() {
        return "SELECT idDomiciliario, nombre, apellido, nit_cc, direccion, correo, estado 
                FROM domiciliario";
    }
    
    function consultar() {
        return "SELECT nombre, apellido, nit_cc, direccion, correo, estado
                FROM domiciliario
                WHERE idDomiciliario = '" . $this -> idDomiciliario . "'";
    }
    
    function cambiarEstado($estado) {/** inserta datos de cliente en la BD */
        return "UPDATE domiciliario SET estado='" . $estado . "'
                WHERE idDomiciliario = '" . $this -> idDomiciliario . "'";
    }
    
    function autentica() { 
        return "SELECT idDomiciliario
                    FROM domiciliario
                    WHERE correo = '" . $this -> correo . "'";
    }
    
    public function actualizar() {
        return "UPDATE
                    domiciliario
                SET
                    nombre = '" . $this->nombre . "',
                    apellido = '" . $this->apellido . "',
                    nit_cc = '" . $this->nit_cc . "',
                    direccion = '" . $this->direccion . "',
                    correo = '" . $this->correo . "'
                WHERE idDomiciliario = '" . $this->idDomiciliario . "'";
    }
    
    public function consultarTodosPag($pag, $regPag){
        return "SELECT idDomiciliario, nombre, apellido, nit_cc, direccion, correo, estado 
                FROM domiciliario
                limit " . (($pag - 1) * $regPag) . ", " . $regPag;
    }
    
    public function consultarNumReg(){
        return "select count(idDomiciliario)
                FROM domiciliario";
    }
    
    
}

 	 	 	 	 	 	 	 	
?>