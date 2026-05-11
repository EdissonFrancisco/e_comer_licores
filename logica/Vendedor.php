<?php 
    require_once 'persistencia/Conexion.php';
    require_once 'persistencia/VendedorDAO.php';
    
    class Vendedor {
                                        
        private $idVendedor;
        private $nombre;
        private $apellido;
        private $nit_cc;
        private $direccion;
        private $correo;
        private $clave;
        private $estado;
        private $conecxion;
        private $vendedorDAO;

        public function getIdVendedor()
        {
            return $this->idVendedor;
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

        public function __construct($pIdVendedor="", $pNombre="", $pApellido="", $pNit_cc="", $pDireccion="", $pCorreo="", $pClave="", $pEstado="") {
            $this -> idVendedor = $pIdVendedor;
            $this -> nombre = $pNombre;
            $this -> apellido = $pApellido;
            $this -> nit_cc = $pNit_cc;
            $this -> direccion = $pDireccion;
            $this -> correo = $pCorreo;
            $this -> clave = $pClave;
            $this -> estado = $pEstado;
            $this -> conecxion = new Conexion();
            $this -> vendedorDAO = new VendedorDAO($this->idVendedor, $this->nombre, $this->apellido, $this->nit_cc, $this->direccion, $this->correo, $this->clave, $this->estado);
        }
        
        /*public function validar($pCorreo) {/** consulta que el correo no se encuentre registrado 
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> validar($pCorreo));
            $this -> conecxion -> cerrar();
            if($this -> conecxion -> numFilas() == 1){
                $this -> idTelCli = $this -> conecxion -> extraer()[0];
                return true;
            }else{
                return false;
            }
        }*/

        function crearVendedores(){/** inserta datos de cliente en la BD */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> vendedorDAO ->crearVendedores());
            $this -> conecxion -> cerrar();
        }
        
        /*function consultarID() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarID());
            $this -> conecxion -> cerrar();
            $resultado = $this -> conecxion -> extraer()[0];
            return $resultado;
        }*/
        
        function autentica() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> vendedorDAO -> autenticar());
            if($this -> conecxion -> numFilas() == 1){
                $this -> idVendedor = $this -> conecxion -> extraer()[0];
                $this -> conecxion -> cerrar();
                return true;
            }
            $this -> conecxion -> cerrar();
            return false;
        }
        
        function consultar() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado */
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> vendedorDAO -> consultar());
            $resultado = $this -> conecxion -> extraer();
            $this -> nombre = $resultado[0];
            $this -> apellido = $resultado[1];
            $this -> nit_cc = $resultado[2];
            $this -> direccion = $resultado[3];
            $this -> correo = $resultado[4];
            $this -> estado = $resultado[5];
            $this -> conecxion -> cerrar();
        }
        
        /* function consultarTodos() {/* consulto los datos prinsipales del cliente: nombre apellido correo estado 
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> consultarTodos());
            $this -> conecxion -> cerrar();
            $clientes = array();
            while(($resultado = $this -> conecxion -> extraer()) != null){//valido que datos no sea nulos
                $cliente = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4], $resultado[5], "", $resultado[6]);
                array_push($clientes, $cliente);
            }
            return  $clientes;
        }
        
        function consultarFiltro($filtro) {/* consulto los datos prinsipales del cliente: nombre apellido correo estado 
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
        
        function cambiarEstado($estado) {/** inserta datos de cliente en la BD 
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> clienteDAO -> cambiarEstado($estado)); 
            $this -> conecxion -> cerrar();
        } */
        
        function actualizar() {
            $this -> conecxion -> abrir();
            $this -> conecxion -> ejecutar($this -> vendedorDAO -> actualizar());
            $this -> conecxion -> cerrar();
        }
    }

?>