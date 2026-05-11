<?php
    date_default_timezone_set('America/Bogota');
    setlocale(LC_ALL, 'es_ES');
    $fecha = date('y/m/d');
    
    $facturasDia = new Factura();
    $factur = $facturasDia -> busquedaHistorialVentas($fecha);


?>

<div class="card">
	<div class="card-header">Featured</div>
	<div class="card-body">
		<h5 class="card-title">Special title treatment</h5>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Fecha</th>
					<th scope="col">Entrega</th>
					<th scope="col">Descripcion</th>
					<th scope="col">Unidades</th>
					<th scope="col">SubTotal</th>
				</tr>
			</thead>
			<tbody>
				<?php
				    
                    if ($factur != NULL) {//valido que si hay productos
                        $i = 1;                                    
                            foreach ($factur as $proActual) { //recorro con un foreach                                
                                echo "<tr>";//inicio tabla                                
                                echo "<td>" . $i ++ . "</td>";
                                echo "<td>" . $proActual -> getFecha() . " " . $datoProducto -> getIdClaseLicor() -> getNombre() . "<br>" . $datoProducto -> getTipo() . "</td>"; 
                                echo "<td><img src='". $datoProducto -> getFoto() ."' width='30%' ></td>";
                                echo "<td>" . $datoProducto -> getValorUnidad() . "</td>";
                                echo "<td>" . $proActual -> getCantidad() . "</td>";
                                echo "<td><a href ='index.php?pid=" . base64_encode("presentacion/carrito/carritoCompra.php") . "&idEliminar=" . $proActual -> getIdProducto() . "' class='btn btn-danger btn-sm'><span class='fas fa-trash'></span></a></td>";
                                echo "</form>";
                                echo "</tr>";//fin tabla
                            }
                    } else {//si no hay productos
                        echo "<tr class='text-center'>";
                        echo "<td colspan='7'> :( no has agregado productos al carrito :( </td>";
                        echo "</tr>";
                    }
                ?>            	            				
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3" class="text-end">Total</th>
					<th>
						<?php //suma de los productos para total
						    $suma = 0;//declaro una variabla para almacenar la suma
						    foreach ($proCarro as $proActual) {
						        $datoProducto = new Producto($proActual -> getIdProducto());
						        $datoProducto -> consultar();//vuelvo a consultar 
						        $suma += $proActual -> getCantidad() * $datoProducto -> getValorUnidad();//multiplico la cantidad por el valor y sumo el resultado en cada iteracion
						    }
						    echo $suma;//muestro la suma o total
                         ?>
                     </th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
		</table>
	</div>
</div>