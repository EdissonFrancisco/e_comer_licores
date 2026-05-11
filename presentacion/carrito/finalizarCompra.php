<?php
    date_default_timezone_set('America/Bogota');
    setlocale(LC_ALL, 'es_ES');
    $fecha = date('y/m/d');
    $hora = date("H:i");

    $carrito = new carrito();
    $proCarro = $carrito->listaCarrito($_SESSION["id"]);

    $errorCheckout = '';
    if (!is_array($proCarro) || count($proCarro) === 0) {
        $errorCheckout = 'Tu carrito está vacío. Agrega productos antes de finalizar la compra.';
    } else {
        $orden = new Orden();
        $ultimaNum = $orden->ultimaOrden($_SESSION["id"]);
        $siguienteNumOrden = ($ultimaNum !== null && $ultimaNum > 0) ? $ultimaNum + 1 : 1;

        $entrega = isset($_REQUEST["domicilio"]) ? "Domicilio" : "Tienda";

        foreach ($proCarro as $proActual) {
            $datoProducto = new Producto($proActual->getIdProducto());
            $datoProducto->consultar();
            $suma = $proActual->getCantidad() * $datoProducto->getValorUnidad();
            $ordenes = new Orden("", $proActual->getIdProducto(), $_SESSION["id"], $proActual->getCantidad(), $datoProducto->getValorUnidad(), $suma, $siguienteNumOrden);
            $ordenes->ingresarOrden();
            $carritoItem = new carrito("", $proActual->getIdProducto(), $_SESSION["id"], "");
            $carritoItem->eliminar();
        }

        $facturar = new Factura("", $_SESSION["id"], $fecha, $hora, $entrega, $siguienteNumOrden, "0");
        $facturar->crearFactura();
    }

    $datosCli = new Cliente($_SESSION["id"]);
    $datosCli->consultar();
?>

<?php if ($errorCheckout !== '') { ?>
<div class="container text-center">
    <div class="row mt-3">
        <div class="col">
            <div class="alert alert-warning"><?php echo htmlspecialchars($errorCheckout); ?></div>
            <a href="index.php?pid=<?php echo base64_encode("presentacion/carrito/carritoCompra.php"); ?>" class="btn btn-primary">Volver al carrito</a>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="container text-center">
	<div class="row mt-3">
		<div class="col">
			<div class="card border-primary mb-3">
				<div class="card-header">
					<h1>GRACIAS POR SU COMPRA</h1>
				</div>
				<div class="card-body">					
					<div class="row justify-content-center">						
						<div class="align-self-center" >		
							<h2><?php echo htmlspecialchars($datosCli->getNombre() . " " . $datosCli->getApellido()); ?></h2>					
						    <a href="facturaPDF.php" class="btn btn-success" target="_blank">GENERAR FACTURA PDF</a>			
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
