<?php 
    date_default_timezone_set('America/Bogota');
    setlocale(LC_ALL, 'es_ES');
    $fecha = date('y/m/d');
    $hora = date("H:i");
    
    $session = 5;
    $vendedores = new Vendedor($_SESSION["id"]);
    $vendedores -> consultar();
    
    //traigo datos del carro
    $carrito = new carrito();
    $proCarro = $carrito -> listaCarrito($session);//lista del carro
    //busco las ordenes anteriores
    $orden = new Orden();
    $ordenExiste = $orden -> ultimaOrden($session);//busco si hay  o no hay compras anteriores
    
    if ($ordenExiste != NULL) {
        //ingreso datos de factura con entrega domicilio
        $entrega = $vendedores -> getNombre() . " " . $vendedores -> getApellido();
        $facturar = new Factura("", $session, $fecha, $hora, $entrega, $ordenExiste+1, 2);
        $facturar -> crearFactura();
    } else {
        //ingreso datos de factura con entrega tienda
        $entrega = $vendedores -> getNombre() . " " . $vendedores -> getApellido();
        $facturar = new Factura("", $session, $fecha, $hora, $entrega, 1, 2);
        $facturar -> crearFactura();
    }
    
    //valido que existan productos en el carro y que tenga ordenes anteriores
    if ($proCarro != NULL && $ordenExiste != NULL) {//valido que si hay productos
        $suma = 0;
        foreach ($proCarro as $proActual) { //recorro con un foreach
            $datoProducto = new Producto($proActual -> getIdProducto());//traigo todos los datos del producto por el id
            $datoProducto -> consultar();//consulta el producto
            
            $suma = $proActual -> getCantidad() * $datoProducto -> getValorUnidad();//suma para subtotal
            
            //envio los valores de los productos a la Base de Datos
            $ordenes = new Orden("", $proActual -> getIdProducto(), $session, $proActual -> getCantidad(), $datoProducto -> getValorUnidad(), $suma, $ordenExiste+1);
            $ordenes -> ingresarOrden();
            
            //elimino los datos del carrito Y lo vacio en la Base de Datos
            $carrito = new carrito("", $proActual -> getIdProducto(), $session, "");
            $carrito->eliminar();
        }
    }else {//si no existen ordenes anteriores entonces se crea la primera orden o compra del cliente
        $suma = 0;
        foreach ($proCarro as $proActual) { //recorro con un foreach
            $datoProducto = new Producto($proActual -> getIdProducto());//traigo todos los datos del producto por el id
            $datoProducto -> consultar();//consulta el producto
            
            $suma = $proActual -> getCantidad() * $datoProducto -> getValorUnidad();//suma para subtotal
            
            $ordenes = new Orden("", $proActual -> getIdProducto(), $session, $proActual -> getCantidad(), $datoProducto -> getValorUnidad(), $suma, 1);
            $ordenes -> ingresarOrden();
            
            $carrito = new carrito("", $proActual -> getIdProducto(), $session, "");
            $carrito->eliminar();
        }
    }

?>
<div class="container text-center">
	<div class="row mt-3">
		<div class="col">
			<div class="card border-primary mb-3">
				<div class="card-header">
					<h1>Venta realizada por: </h1>
				</div>
				<div class="card-body">					
					<div class="row justify-content-center">						
						<div class="align-self-center" >		
							<h2><?php echo $vendedores -> getNombre() . " " . $vendedores -> getApellido();?></h2>					
						    <a href="facturaVendedorPDF.php" class="btn btn-success" target="_blank">FACTURA PDF</a>			
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
