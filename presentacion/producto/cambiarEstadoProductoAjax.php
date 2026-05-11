<?php 
    $idproducto = $_GET["idProducto"];
    $producto = new Producto($idproducto);
    $producto -> consultar();
    if($producto -> getEstado() == 1){
        $producto -> cambiarEstado(0);
        echo "<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>";
    }else{
        $producto -> cambiarEstado(1);
        echo "<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>";
    }
?>