<?php 
    require_once 'persistencia/Conexion.php';
    require_once 'persistencia/ClienteDAO.php';
    
    class Cliente {
                                        
        private $idCliente;
        private $nombre;
        private $apellido;
        private $nit_cc;
        private $direccion;
        private $correo;
        private $clave;
        private $estado;
        private $conecxion;
        private $clienteDAO;

        public function getIdCliente()
        {
            return $this->idCliente;
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

        public function __construct($pIdCliente="", $pNombre="", $pApellido="", $pNit_cc="", $pDireccion="", $pCorreo="", $pClave="", $pEstado="") {
            $this -> idCliente = $pIdCliente;
            $this -> nombre = $pNombre;
            $this -> apellido = $pApellido;
            $this -> nit_cc = $pNit_cc;
            $this -> direccion = $pDireccion;
            $this -> correo = $pCorreo;
            $this -> clave = $pClave;
            $this -> estado = $pEstado;
            $this -> conecxion = new Conexion();
            $this -> clienteDAO = new ClienteDAO($this->idCliente, $this->nombre, $this->apellido, $this->nit_cc, $this->direccion, $this->correo, $this->clave, $this->estado);
        }
        
        public function validar($pCorreo) {/** consulta que el correo no se encuentre registrado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> validar($pCorreo));
            if($this -> conecxion -> numFilas() == 1){
                $this -> idTelCli = $this -> conecxion -> extraer()[0];
                $this -> conecxion -> cerrar();
                return true;
            }
            $this -> conecxion -> cerrar();
            return false;
        }

        function crearCliente($nombre, $apellido, $CC, $direc, $correo, $clave){/** inserta datos de cliente en la BD */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> crearCliente($nombre, $apellido, $CC, $direc, $correo, $clave));
            $this -> conecxion -> cerrar();
        }
        
        function consultarID() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarID());
            $resultado = $this -> conecxion -> extraer()[0];
            $this -> conecxion -> cerrar();
            return $resultado;
        }
        
        function autentica() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> autenticar());
            if($this -> conecxion -> numFilas() == 1){
                $this -> idCliente = $this -> conecxion -> extraer()[0];
                $this -> conecxion -> cerrar();
                return true;
            }
            $this -> conecxion -> cerrar();
            return false;
        }
        
        function consultar() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultar());
            $resultado = $this -> conecxion -> extraer();
            $this -> nombre = $resultado[0];
            $this -> apellido = $resultado[1];
            $this -> nit_cc = $resultado[2];
            $this -> direccion = $resultado[3];
            $this -> correo = $resultado[4];
            $this -> estado = $resultado[5];
            $this -> conecxion -> cerrar();
        }
        
        function consultarTodos() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarTodos());
            $clientes = array();
            while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
                $cliente = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
                array_push($clientes, $cliente);
            }
            $this -> conecxion -> cerrar();
            return  $clientes;
        }
        
        public function consultarTodosPag($pag, $regPag){
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarTodosPag($pag, $regPag));
            $clientes = array();
            while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
                $cliente = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
                array_push($clientes, $cliente);
            }
            $this -> conecxion -> cerrar();
            return  $clientes;
        }
        
        public function consultarNumReg(){
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarNumReg());
            $n = $this -> conecxion -> extraer()[0];
            $this -> conecxion -> cerrar();
            return $n;
        }
        
        function consultarFiltro($filtro) {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarFiltro($filtro)); 
            
            $clientes = array();
            while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
                $cliente = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
                array_push($clientes, $cliente);
            }
            
            $this -> conecxion -> cerrar();
            
            return  $clientes;
        }
        
        function consultarFiltroVenta($filtro) {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarFiltroVenta($filtro));
            $clientes = array();
            while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
                //$cliente = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
                array_push($clientes, new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]));
            }      
            $this -> conecxion -> cerrar();
            return  $clientes;
        }
        
        function cambiarEstado($estado) {/** inserta datos de cliente en la BD */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> cambiarEstado($estado)); 
            $this -> conecxion -> cerrar();
        }
        
        function actualizar() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> actualizar());
            $this -> conecxion -> cerrar();
        }
    }

?>