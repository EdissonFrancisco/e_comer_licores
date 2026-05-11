<?php
//buscamos cliente
if ($_POST["action"] == "bucarCliente") {
    
    if (!empty($_POST["cliente"])) {
        $filtro = $_POST["cliente"];
        
        $clientes = new Cliente();
        $resultado = $clientes -> consultarFiltroVenta($filtro);
        $data = '';
        if ($resultado != NULL) {
            $data = array(
                'idcliente'=>$resultado[0]->getIdCliente(),
                'nombre'=>$resultado[0]->getNombre(),
                'apellido'=>$resultado[0]->getApellido(),
                'nit_cc'=>$resultado[0]->getNit_cc(),
                'direccion'=>$resultado[0]->getDireccion(),
                'correo'=>$resultado[0]->getCorreo(),
                'estado'=>$resultado[0]->getEstado()
            );
        } else {
            $data = 0;
        }
        $array = json_encode($data,JSON_FORCE_OBJECT);
        //echo $array;
    } 
    
    exit;
}

?>