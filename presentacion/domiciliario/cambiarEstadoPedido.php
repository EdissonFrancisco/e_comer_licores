<?php
    if (isset($_GET["idFacturar"]) && isset($_GET["idCliente"])) {
        $facturaPedido = new Factura($_GET["idFacturar"]);
        $facturaPedido -> consultaTodoID();
        
        if($facturaPedido -> getEstadoEntrega() == 0){
            //ingreso el domicilio y le asigmno estado 1 (proceso entrega - aceptado por el domiciliario)
            $domicilio = new Domicilio("", $_SESSION["id"], $_GET["idCliente"], $_GET["idFacturar"], 1, "");
            $domicilio -> ingresarDomicilio();//ejecuto el ingreso de datos
            //cambio el estado del pedido en la factura con 1 (proceso entrega - aceptado por el domiciliario)
            $facturaPedido -> cambiarEstado(1);
            //recargo la pagina
            header("Location: index.php?pid=" . base64_encode("presentacion/domiciliario/domiciliosDisponibles.php"));
        } else if($facturaPedido -> getEstadoEntrega() == 1) {
            $domicilio = new Domicilio("", "", "", $_GET["idFacturar"], "", "");
            $domicilio -> actualizar(2);
            $facturaPedido -> cambiarEstado(2);
            header("Location: index.php?pid=" . base64_encode("presentacion/domiciliario/pedidosAceptados.php"));
        }
    }

?>  