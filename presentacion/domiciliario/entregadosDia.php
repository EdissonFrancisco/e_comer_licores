<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
$fecha = date('y/m/d');

$domicilio = new Domicilio("",);
$aceptados = $domicilio -> entregadosDia($fecha, $_SESSION["id"]);
$cantidadEntregas = sizeof($aceptados);

?>

<body class="fondo-loging" >
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">PEDIDOS PARA ENTREGAR</h5>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>					
								<th scope="col">#</th>			
								<th scope="col">No. Factura</th>
								<th scope="col">Nombre Cliente</th>
								<th scope="col">Direccion</th>
								<th scope="col">Fecha</th>
								<!-- <th scope="col">Finalizar Entregar</th> -->
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							if (isset($cantidadEntregas)) {
							    foreach ($aceptados as $entregaActual){
							        echo "<tr>";
							        echo "<td>" . $i++ . "</td>";
							        echo "<td>" . $entregaActual -> getIdFactura() -> getIdFactura() . "</td>";
							        echo "<td>" . $entregaActual -> getIdCliente() -> getNombre() . " " . $entregaActual -> getIdCliente() -> getApellido() . "</td>";
							        echo "<td>" . $entregaActual -> getIdCliente() -> getDireccion() . "</td>";
							        echo "<td>" . $entregaActual -> getIdFactura() -> getFecha() . "</td>";
							        //echo "<td><a href ='index.php?pid=" . base64_encode("presentacion/domiciliario/cambiarEstadoPedido.php") . "&idFacturar=" . $entregaActual -> getIdFactura() -> getIdFactura() . "&idCliente=" . $entregaActual -> getIdCliente() -> getIdCliente() . "' class='btn btn-outline-success btn-sm'><span class='fas fa-clipboard-check'></span></a></td>";
							        echo "</tr>";
							    }
							} else {//si no hay productos
							    echo "<tr class='text-center'>";
							    echo "<td colspan='7'> :( NO HAY ENTREGAS REALIZADAS :( </td>";
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
