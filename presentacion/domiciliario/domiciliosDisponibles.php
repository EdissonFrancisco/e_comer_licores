<?php
    $facturas = new Factura();
    $FacturaDisponibles = $facturas -> consultarDisponibles();
    
    $cantidadPedidos = sizeof($FacturaDisponibles);
?>

<body class="fondo-loging" >
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">Pedidos Disponibles</h5>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>					
								<th scope="col">#</th>			
								<th scope="col">No. Factura</th>
								<th scope="col">Nombre Cliente</th>
								<th scope="col">Direccion</th>
								<th scope="col">Fecha</th>
								<th scope="col">Entregar</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							if ($cantidadPedidos > 0) {
							    foreach ($FacturaDisponibles as $facturaActual){
							        echo "<tr>";
							        echo "<td>" . $i++ . "</td>";
							        echo "<td>" . $facturaActual -> getIdFactura() . "</td>";
							        echo "<td>" . $facturaActual -> getIdCliente() -> getNombre() . " " . $facturaActual -> getIdCliente() -> getApellido() . "</td>";
							        echo "<td>" . $facturaActual -> getIdCliente() -> getDireccion() . "</td>";
							        echo "<td>" . $facturaActual -> getFecha() . "</td>";
							        echo "<td><a href ='index.php?pid=" . base64_encode("presentacion/domiciliario/cambiarEstadoPedido.php") . "&idFacturar=" . $facturaActual -> getIdFactura() . "&idCliente=" . $facturaActual -> getIdCliente() -> getIdCliente() . "' class='btn btn-outline-success btn-sm'><span class='fas fa-shipping-fast'></span></a></td>";
							        echo "</tr>";
							    }
							} else {//si no hay productos
							    echo "<tr class='text-center'>";
							    echo "<td colspan='7'> :( NO HAY PEDIDOS DISPONIBLES :( </td>";
							    echo "</tr>";
							}
							
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

</body>