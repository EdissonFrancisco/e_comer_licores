<?php 
    $idCliente = $_GET["idCliente"];
    $clientes = new Cliente($idCliente);
    $clientes -> consultar();
    if($clientes -> getEstado() == 1){
        $clientes -> cambiarEstado(0);
        echo "<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>";
    }else{
        $clientes -> cambiarEstado(1);
        echo "<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>";
    }
?>