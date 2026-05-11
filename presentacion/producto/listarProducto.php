<?php
    $productitos = new Producto();
    //$productos = $productitos -> consultarTodo();
    
    $regPag = 5;
    $pag = 1;
    if(isset($_GET["pag"])){
        $pag = $_GET["pag"];
    }
    if(isset($_GET["regPag"])){
        $regPag = $_GET["regPag"];
    }
    
    $productos = $productitos -> consultarTodosPag($pag, $regPag);
    $numReg = $productitos -> consultarNumReg();
    
?>

<body class="fondo-loging" >
    <div class="container">
    	<div class="row mt-3">
    		<div class="col">
    			<div class="card">
    				<h4 class="card-header">PRODUCTOS</h4>
    				<div class="card-body">
    					<table class="table table-striped table-hover">
    						<thead>
    							<tr>	
    								<th scope="col">#</th>							
    								<th scope="col">Marca</th>
    								<th scope="col">Clase</th>
    								<th scope="col">descripcion</th>
    								<th scope="col">Foto</th>
    								<th scope="col">Valor Unidad</th>
    								<th scope="col">Cantidad</th>
    								<th scope="col">Estado</th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php 
    							$i = 1;
    							foreach ($productos as $productoActual){
    							    echo "<tr>";
    							    echo "<td>" . $i++ . "</td>";
    							    echo "<td>" . $productoActual -> getIdMarca() -> getNombre() . "</td>";		
    							    echo "<td>" . $productoActual -> getIdClaseLicor() -> getNombre() . "</td>";
    							    echo "<td>" . $productoActual -> getTipo() . "</td>";
    							    echo "<td>" . (($productoActual -> getFoto()!="")?"<img src='" . $productoActual -> getFoto() . "' height='40px' />":"") . "</td>";
    							    echo "<td>" . $productoActual -> getValorUnidad() . "</td>";
    							    echo "<td>" . $productoActual -> getInventario() . "</td>";
    							    
    							    echo "<td><div id='estado" . $productoActual -> getIdProducto() . "'>" . (($productoActual -> getEstado()==1)?"<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>":"<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>") . "<div></td>";
    							    echo "<td><div id='cambiarEstado" . $productoActual -> getIdProducto() . "'><a href='#'><i class='fas fa-pen-fancy' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a><div></td>";
    							    
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/editarImagenProducto.php") . "&id=" . $productoActual -> getIdProducto() . "' data-toggle='tooltip' data-placement='bottom' title='Editar imagen'><i class='far fa-image'></i></a></td>";
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/editarProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "'data-toggle='tooltip' data-placement='bottom' title='Editar producto'><i class='fas fa-edit'></i></a></td>";
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/inventarioProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "'data-toggle='tooltip' data-placement='bottom' title='inventario'><i class='fas fa-boxes'></i></a></td>";
    							    //echo "<td nowrap><a href='indexModal.php?pid=" . base64_encode("presentacion/producto/modalProducto.php") . "&idCliente=" . $productoActual -> getIdProducto() . "' data-toggle='modal' data-target='#modalInventario'><i class='fas fa-boxes' data-toggle='tooltip' data-placement='bottom' title='Ver detalles'></i></a></td>";
    							    //echo "<td nowrap><a href='indexModal.php?pid=" . base64_encode("presentacion/producto/modalProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "' data-toggle='modal' data-target='#modalProducto'><i class='fas fa-boxes' data-toggle='tooltip' data-placement='bottom' title='Actualizar Inventario'></i></a>";
    							    echo "</tr>";
    							}
    							?>
    						</tbody>
    					</table>

						<div class="text-center">
							<nav aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item <?php echo ($pag == 1)?"disabled":"" ?> ">
										<a
    										class="page-link"
    										href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/listarProducto.php") . "&pag=" . ($pag-1) ?>"
    										aria-label="Previous"> <span aria-hidden="true">&laquo;</span>
										</a>
									</li>
                                    <?php
                                    $botones = $numReg / $regPag;
                                    if ($numReg % $regPag != 0) {
                                        $botones ++;
                                    }
                                    for ($i = 1; $i <= $botones; $i ++) {
                                        echo "<li class='page-item " . (($i == $pag) ? "active" : "") . "'>";
                                        if ($pag == $i) {
                                            echo "<span class='page-link'>" . $i . "</span>";
                                        } else {
                                            echo "<a class='page-link' href='index.php?pid=" . base64_encode("presentacion/producto/listarProducto.php") . "&pag=" . $i . "'>" . $i . "</a>";
                                        }
                                        echo "</li>";
                                    }
                                    ?>
									<li
										class="page-item <?php echo ($pag == $botones)?"disabled":"" ?> ">
										<a
    										class="page-link"
    										href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/listarProducto.php") . "&pag=" . ($pag+1) ?>"
    										aria-label="Next"> <span aria-hidden="true">&raquo;</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
        $(document).ready(function(){
            <?php 
                foreach ($productos as $productoActual){
                    echo "\t$(\"#cambiarEstado" . $productoActual -> getIdProducto() . "\").click(function(){\n";
                    echo "\t\turl = \"indexAjax.php?pid=" . base64_encode("presentacion/producto/cambiarEstadoProductoAjax.php") . "&idProducto=" . $productoActual -> getIdProducto() . "&estado=" . (($productoActual -> getEstado()==1)?"0":"1") . "\"\n";
                    echo "\t\t$(\"#estado" . $productoActual -> getIdProducto() . "\").load(url);\n";
                    echo "\t});\n\n";
                }	
            ?>
        });
    </script>
</body>