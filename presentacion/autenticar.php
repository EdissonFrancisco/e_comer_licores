<?php 
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    
    $clientes = new Administrador("", "", "", "", "", $correo, $clave);
    
    if($clientes -> autentica()){
        $_SESSION["id"] = $clientes -> getIdAdministrador();
        $_SESSION["rol"] = "ADMINISTRADOR";
        header("Location: index.php?pid=" . base64_encode("presentacion/sessionAdmi.php"));
    } else {
        $clientes = new Cliente("","","","","", $correo, $clave,"");
        
        if ($clientes -> autentica()) {
            $_SESSION["id"] = $clientes -> getIdCliente();
            $_SESSION["rol"] = "CLIENTE";
            header("Location: index.php?pid=" . base64_encode("presentacion/sessionCliente.php"));
        } else{
            $domi = new Domiciliario("", "", "", "", "", $correo, $clave, "");
            
            if ($domi -> autentica()) {
                $_SESSION["id"] = $domi -> getIdDomiciliario();
                $_SESSION["rol"] = "DOMICILIARIO";
                header("Location: index.php?pid=" . base64_encode("presentacion/sessionDomiciliario.php"));
            } else {
                $vendedor = new Vendedor("","","","","", $correo, $clave,"");
                
                if ($vendedor -> autentica()) {
                    $_SESSION["id"] = $vendedor -> getIdVendedor();
                    $_SESSION["rol"] = "VENDEDOR";
                    header("Location: index.php?pid=" . base64_encode("presentacion/sessionVendedor.php"));
                } else {
                    header("Location: index.php?error=1");//error de correo o clave
                }
            }
        }
    }
    
?>