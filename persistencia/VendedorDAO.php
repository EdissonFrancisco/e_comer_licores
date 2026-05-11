<?php 
    class VendedorDAO {
        private $idVendedor;
        private $nombre;
        private $apellido;
        private $nit_cc;
        private $direccion;
        private $correo;
        private $clave;
        private $estado;

        public function __construct($pIdVendedor, $pNombre, $pApellido, $pNit_cc, $pDireccion, $pCorreo, $pClave, $pEstado) {
            $this -> idVendedor = $pIdVendedor;
            $this -> nombre = $pNombre;
            $this -> apellido = $pApellido;
            $this -> nit_cc = $pNit_cc;
            $this -> direccion = $pDireccion;
            $this -> correo = $pCorreo;
            $this -> clave = $pClave;
            $this -> estado = $pEstado;
        }

//         function validar($pCorreo) {
//             return "SELECT correo 
//                     FROM cliente
//                     WHERE correo = '" . $pCorreo . "'";
//         }

        function crearVendedores() {
             return "INSERT INTO vendedor (nombre, apellido, nit_cc, direccion, correo, clave, estado)
                     VALUES ('" . $this->nombre ."',
                             '" . $this->apellido ."',
                             '" . $this->nit_cc ."',
                             '" . $this->direccion ."',
                             '" . $this->correo ."',
                             '" . $this->clave ."',
                             '" . $this->estado . "')";
         }
        
        function autenticar() {
            return "SELECT idVendedor
                    FROM vendedor
                    WHERE correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')";
        }
        
        function consultar() {
            return "select nombre, apellido, nit_cc, direccion, correo, estado 	
                from vendedor
                where idVendedor = '" . $this -> idVendedor . "'";
        }
        
        /* function consultarTodos() {
            return "SELECT idCliente, nombre, apellido, nit_cc, direccion, correo, estado 
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
        
        function cambiarEstado($estado) {
            return "update cliente set estado = '" . $estado . "'
                where idCliente = '" . $this -> idCliente . "'";
        } */
        
        public function actualizar() {
            return "UPDATE  vendedor
                SET nombre = '" . $this->nombre . "',
                    apellido = '" . $this->apellido . "',
                    nit_cc = '" . $this->nit_cc . "',
                    direccion = '" . $this->direccion . "',
                    correo = '" . $this->correo . "'
                WHERE idVendedor = '" . $this->idVendedor . "'";
        }
        
    }
?>