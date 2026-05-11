<?php
    $filtro = $_GET["filtro"];
    
    if (isset($filtro)) {
        $productitos = new Producto();
        $productos = $productitos -> consultarFiltro($filtro);
        $totalRegistros = count($productos);
    } else {
        $totalRegistros = $productitos -> totalRegistros();
        $productos = $productitos -> consultarTodo();
    }
?>
<body class="" >
	<div class="container">
		<div class="row mt-5">
    		<?php
    		  $i = 0;
                if ($totalRegistros > 0) {
                    foreach ($productos as $datoActual) {      
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
    			<br>
    			<?php if ($datoActual -> getInventario() > 0 && $datoActual -> getEstado() == 1) { //validacion para la existencia de productos en la BD y mostrar o no mostrar?> 
    			<div class="card shadow">	
    				<?php echo "<img src='". $datoActual -> getFoto() ."' style=' padding:auto; margin:auto;' class='card-img-top' width='50px' height='300px'>";?>
    				<div class="card-body text-center " style="height: 10rem;">					
    					<h5><?php echo $datoActual -> getIdClaseLicor() -> getNombre() . " " . $datoActual -> getTipo() . "</b>"?></h5>
    					<h5><?php echo "<strong><b>" . $datoActual -> getValorUnidad() . "</b></strong>"?></h5>
						<form class="row justify-content-center" method="POST" action="<?php echo "index.php?pid=" . base64_encode('presentacion/carrito/carritoCompra.php') . "&idproducto="  . $datoActual -> getIdProducto() ?>">
							<div class="col-5">
								<input class="col-12" type="number" name="cantidad" min="1" max="50" value="1" required="required">
							</div>
							<div class="col-5" >
								<button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-shopping-cart"> </span> </button>
							</div>
						</form>
						
    				</div>
    			</div>
    			<?php }?>
    		</div>
    		<?php } $i++; } else {?>
    			<h1>NO HAY PRODUCTOS</h1>
    		<?php }?>  			
    	</div>
   	</div>
</body>