<?php 
    /** variables donde recibo los datos del formulario */
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $CC = $_POST["cedula"];
    $direc = $_POST["direccion"];
    $tel = $_POST["telefono"];
    $correo = $_POST["correo"];
    $clave = md5($_POST["clave"]);
    
    /** declaracion llamada a constructor */
    $clientes = new Cliente();
    
    /** validar que no exista correo */
    if ($clientes -> validar($correo)) {
        header("Location: index.php?error=2");//error de correo ya existente
    } else {
        /** envio daros por parametro a la funcion crear cliente */
        $clientes -> crearCliente($nombre, $apellido, $CC, $direc, $correo, $clave);
        
        $IdCli = $clientes -> consultarID();/** traigo el id del ultimo cliente registrado */        
        $ttel = new TelCliente($IdCli, "", intval($tel));/** declaro el constructor y envio datos por parametro */
        $ttel -> crearTel(); /** creo el telefono */
        
        header("Location: index.php?error=3");//lo manejo como error pero es validacion - cuenta creada con exito
        
    }
?>