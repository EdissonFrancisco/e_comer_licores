<?php 
    require_once 'persistencia/Conexion.php';
    require_once 'persistencia/TelClienteDAO.php';
    
    class TelCliente {
        private $idTelCli;
        private $idCliente;
        private $telefono;
        private $conecxion;
        private $telclienteDAO;

        public function getIdTelCli()
        {
            return $this->idTelCli;
        }
        
        public function getIdCliente()
        {
            return $this->idCliente;
        }

        public function getTelefono()
        {
            return $this->telefono;
        }
        
        public function __construct($pIdCliente, $pIdTelCli="", $pTelefono=""){
            $this -> idTelCli = $pIdTelCli;
            $this -> idCliente = $pIdCliente;
            $this -> telefono = $pTelefono;
            $this -> conecxion = new Conexion();
            $this -> telclienteDAO = new TelClienteDAO($this->idTelCli, $this->idCliente, $this->telefono);
        }

        function crearTel() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> telclienteDAO -> crearTel());
            $this -> conecxion -> cerrar();     
        }
        
        function consultar() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> telclienteDAO -> consultar());
            $resultado = $this -> conecxion -> extraer();
            $this -> telefono = $resultado[0];
            $this -> conecxion -> cerrar();
        }
        
    }
?>