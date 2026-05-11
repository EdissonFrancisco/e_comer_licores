<?php
    $filtro = $_GET["filtro"];
    
    if (isset($filtro)) {
        $productitos = new Producto();
        $productos = $productitos -> consultarFiltro($filtro);
    }
    
?>

<body class="fondo-loging" >
    <div class="container">
    	<div class="row mt-3">
    		<div class="col">
    			<div class="card">
    				<h4 class="card-header">Productos</h4>
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
    							    echo "<td><div id='cambiarEstado" . $productoActual -> getIdProducto() . "'><a href='#'><i class='fas fa-user-edit' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a><div></td>";
    							    
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/editarImagenProducto.php") . "&id=" . $productoActual -> getIdProducto() . "' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar imagen'><i class='far fa-image'></i></a></td>";
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/editarProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "'data-bs-toggle='tooltip' data-bs-placement='top' title='Editar producto'><i class='fas fa-edit'></i></a></td>";
    							    echo "<td><a href='index.php?pid=" . base64_encode("presentacion/producto/inventarioProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "'data-bs-toggle='tooltip' data-bs-placement='top' title='inventario'><i class='fas fa-boxes'></i></a></td>";
    							    //echo "<td nowrap><a href='indexModal.php?pid=" . base64_encode("presentacion/producto/modalProducto.php") . "&idCliente=" . $productoActual -> getIdProducto() . "' data-toggle='modal' data-target='#modalInventario'><i class='fas fa-boxes' data-toggle='tooltip' data-placement='bottom' title='Ver detalles'></i></a></td>";
    							    //echo "<td nowrap><a href='indexModal.php?pid=" . base64_encode("presentacion/producto/modalProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() . "' data-toggle='modal' data-target='#modalProducto'><i class='fas fa-boxes' data-toggle='tooltip' data-placement='bottom' title='Actualizar Inventario'></i></a>";
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
    <script>
        $(document).ready(function(){
            <?php 
                $i = 1;
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