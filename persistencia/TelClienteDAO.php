<?php 

class TelClienteDAO {
    private $idTelCli;	
    private $idCliente;
    private $telefono;
    
    public function __construct($pIdTelCli, $pIdCliente, $pTelefono){
        $this -> idTelCli = $pIdTelCli;
        $this -> idCliente = $pIdCliente;
        $this -> telefono = $pTelefono;
    }
    
    function crearTel() {
        return "INSERT INTO telcliente (idCliente, telefono)
                VALUES ('" . $this -> idCliente . "','" . $this -> telefono . "')";
    }
        
    function consultar() { 
        return "SELECT telefono FROM telcliente WHERE idCliente = '" . $this -> idCliente . "'";
    } 

}

?> 