<?php
$idDom = $_GET["idDomi"];
$domiliario = new Domiciliario($idDom);
$domiliario -> consultar();
if($domiliario -> getEstado() == 1){
    $domiliario -> cambiarEstado(0);
    echo "<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>";
}else{
    $domiliario -> cambiarEstado(1);
    echo "<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>";
}
?>