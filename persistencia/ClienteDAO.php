<?php 
    class ClienteDAO {
        private $idCliente;
        private $nombre;
        private $apellido;
        private $nit_cc;
        private $direccion;
        private $correo;
        private $clave;
        private $estado;

        public function __construct($pIdCliente, $pNombre, $pApellido, $pNit_cc, $pDireccion, $pCorreo, $pClave, $pEstado) {
            $this -> idCliente = $pIdCliente;
            $this -> nombre = $pNombre;
            $this -> apellido = $pApellido;
            $this -> nit_cc = $pNit_cc;
            $this -> direccion = $pDireccion;
            $this -> correo = $pCorreo;
            $this -> clave = $pClave;
            $this -> estado = $pEstado;
        }

        function validar($pCorreo) {
            return "SELECT correo 
                    FROM cliente
                    WHERE correo = '" . $pCorreo . "'";
        }

        function crearCliente($nombre, $apellido, $CC, $direc, $correo, $clave) {
            return "INSERT INTO cliente (nombre, apellido, nit_cc, direccion, correo, clave)
                    VALUES ('" . $nombre ."',
                            '" . $apellido ."',
                            '" . $CC ."',
                            '" . $direc ."',
                            '" . $correo ."',
                            '" . $clave ."')";
        }
        
        function consultarID() {
            return "SELECT MAX(idCliente) AS id FROM cliente";
        }
        
        function autenticar() {
            return "SELECT idCliente 
                    FROM cliente
                    WHERE correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')";
        }
        
        function consultar() {
            return "select nombre, apellido, nit_cc, direccion, correo, estado 	
                from cliente
                where idCliente = '" . $this -> idCliente . "'";
        }
        
        function consultarTodos() {
            return "SELECT idCliente, nombre, apellido, nit_cc, direccion, correo, estado 
                    FROM cliente";
        }
        
        public function consultarTodosPag($pag, $regPag){
            return "SELECT idCliente, nombre, apellido, nit_cc, direccion, correo, estado 
                    FROM cliente
                    limit " . (($pag - 1) * $regPag) . ", " . $regPag;
        }
        
        public function consultarNumReg(){
            return "select count(idCliente)
                FROM cliente";
        }
        
        function consultarFiltro($filtro) {
            return "SELECT idCliente, nombre, apellido, nit_cc, direccion, correo, estado
                    FROM cliente
                    WHERE nombre LIKE '" . $filtro . "%' 
                     OR apellido LIKE '" . $filtro . "%' 
                     OR nit_cc LIKE '" . $filtro . "%' 
                     OR direccion LIKE '" . $filtro . "%' 
                     OR correo LIKE '" . $filtro . "%'";
        }
        
        function consultarFiltroVenta($filtro) {
            return "SELECT idCliente, nombre, apellido, nit_cc, direccion, correo, estado
                    FROM cliente
                    WHERE nit_cc LIKE '" . $filtro . "'";
        }
        
        function cambiarEstado($estado) {
            return "update cliente set estado = '" . $estado . "'
                where idCliente = '" . $this -> idCliente . "'";
        }
        
        public function actualizar() {
            return "UPDATE  cliente
                SET nombre = '" . $this->nombre . "',
                    apellido = '" . $this->apellido . "',
                    nit_cc = '" . $this->nit_cc . "',
                    direccion = '" . $this->direccion . "',
                    correo = '" . $this->correo . "'
                WHERE idCliente = '" . $this->idCliente . "'";
        }
        
    }
?>