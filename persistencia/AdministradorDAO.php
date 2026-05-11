<?php 
class AdministradorDAO {
    private $idAdmin; 	 	
    private $nombre;	
    private $apellido;
    private $nit_cc;
    private $direccion;
    private $correo;
    private $clave;

    public function __construct($idAdmin, $nombre, $apellido, $nit_cc, $direccion, $correo, $clave) {
        $this -> idAdmin = $idAdmin; 	 	
        $this -> nombre = $nombre;	
        $this -> apellido = $apellido;
        $this -> nit_cc = $nit_cc;
        $this -> direccion = $direccion;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }

    public function autenticar() {        
        return "SELECT idAdministrador
                FROM administrador
                WHERE correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')"; 
    }
    
    public function consultaTodo() {
        return "SELECT nombre, apellido, nit_cc, direccion, correo
                FROM  administrador
                WHERE idAdministrador = '" . $this -> idAdmin . "'";
    }
    
    public function actualizar() {
        return "UPDATE
                    administrador
                SET
                    nombre = '" . $this->nombre . "',
                    apellido = '" . $this->apellido . "',
                    nit_cc = '" . $this->nit_cc . "',
                    direccion = '" . $this->direccion . "',
                    correo = '" . $this->correo . "'
                WHERE idAdministrador = '" . $this->idAdmin . "'";
    }

}

?>