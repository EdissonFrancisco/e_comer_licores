<?php

class Conexion {
    private $mysqli;
    private $resultado;    

    function abrir() {
        //$this->mysqli = new mysqli("localhost", "root", "Admin123", "e_comerce", 3307);
        $this->mysqli = new mysqli("127.0.0.1", "root", "", "e_comerce", 3307);
        $this -> mysqli -> set_charset("utf8");
    }

    function cerrar() {
        $this -> mysqli -> close();
    }

    function ejecutar($sentencia) {
        $this -> resultado = $this -> mysqli -> query($sentencia);
    }

    function extraer() {
        if ($this -> resultado instanceof mysqli_result) {
            return $this -> resultado -> fetch_row();
        }
        return null;
    }

    function numFilas() {
        if ($this -> resultado instanceof mysqli_result) {
            return $this -> resultado -> num_rows;
        }
        return 0;
    }

}
