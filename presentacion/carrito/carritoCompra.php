<?php    
	
    $carrito = new carrito();
    if (isset($_GET["idproducto"]) && isset($_POST["cantidad"])) {
        $carrito = new carrito("", $_GET["idproducto"], $_SESSION["id"], "");
        $existe = $carrito -> productoExiste();//validamos que el cliente no ingrese dos veces el mismo producto
        if ($existe != NULL) {
            $nuevaCantidad = $existe + $_POST["cantidad"];
            $carrito = new carrito("", $_GET["idproducto"], $_SESSION["id"], $nuevaCantidad);
            $carrito->updateProducto();
			//ob_start();
            header("Location: index.php?pid=" . base64_encode("presentacion/sessionCliente.php"));
			//ob_end_flush();
        } else {
            $carrito = new carrito("", $_GET["idproducto"], $_SESSION["id"], $_POST["cantidad"]);
            $carrito->guardaProductos();  
            //ob_start();
            header("Location: index.php?pid=" . base64_encode("presentacion/sessionCliente.php"));
            //ob_end_flush();
        }
    }
    

    if (isset($_GET["idEliminar"])) {
        $carrito = new carrito("", $_GET["idEliminar"], $_SESSION["id"], "");
        $carrito->eliminar();
    }
    
    date_default_timezone_set('America/Bogota');
    setlocale(LC_ALL, 'es_ES');
    $DiaLetra = date("l");
    $fecha = date('d/m/y');
        
?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card border-primary mb-3">
				<div class="card-header">
					<h1>CARRITO DE COMPRAS <small class="tittles-pages-logo"></small></h1>
					<?php echo "fecha ", $DiaLetra, " ", $fecha?>
				</div>
				<div class="card-body">					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="8%">#</th>
								<th width="15%">Descripcion</th>
								<th width="15%">Foto</th>
								<th width="15%">Precio</th>
								<th width="15%">cantidad</th>
								<th width="15%">Acciones</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    						    $proCarro = $carrito -> listaCarrito($_SESSION["id"]);//traigo todos los datos del carro por id de cliente
                                if (is_array($proCarro) && count($proCarro) > 0) {//valido que si hay productos
                                    $i = 1;                                    
                                        foreach ($proCarro as $proActual) { //recorro con un foreach
                                            $datoProducto = new Producto($proActual -> getIdProducto());//traigo todos los datos del producto por el id
                                            $datoProducto -> consultar();//consulta
                                            echo "<tr>";//inicio tabla
                                            echo "<form action='index.php?pid=" . base64_encode("presentacion/carro/actualizarCarrito.php") . "' method='post'>";
                                            echo "<td>" . $i ++ . "</td>";
                                            echo "<td>" . $datoProducto -> getIdMarca() -> getNombre() . " " . $datoProducto -> getIdClaseLicor() -> getNombre() . "<br>" . $datoProducto -> getTipo() . "</td>"; 
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
    								    $proCarro = isset($proCarro) && is_array($proCarro) ? $proCarro : array();
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
					<?php 
					if (is_array($proCarro) && count($proCarro) > 0) {
					    echo "<form action='index.php?pid=" . base64_encode("presentacion/carrito/finalizarCompra.php") . "' method='post'>";
					    echo "<div class='mb-3 form-check'>";
					    echo "<input checked type='checkbox' class='form-check-input' id='domicilio' name='domicilio' value='1'>";
					    echo "<label class='form-check-label' for='domicilio'>Envío a domicilio</label>";
					    echo "</div>";
					    echo "<button class='btn btn-success btn-block' type='submit'>COMPRAR</button>";
					    echo "</form>";
					} 
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>

