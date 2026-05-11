<?php
    $producto = new Producto();
    if (isset($_GET["tipoLicor"])) {
        $op=$_GET["tipoLicor"];
        $datosLicores = $producto -> buscarTipo($op);
        $totalRegistros = $producto -> totalRegistroFiltro($op);
    }else {
        $totalRegistros = $producto -> totalRegistros();
        $datosLicores = $producto -> consultarTodo();
    }
?>
<div class="container">
	<div class="col-md-6 offset-md-3">
		<div class="card-body">
			<div class="form-group">
				<input type="text" id="filtro" class="form-control" placeholder="Filtro">
			</div>
		</div>
	</div>

	<div class="row mt-5" id="resultados">
		<?php
			$i = 0;
			if ($totalRegistros > 0) {
				foreach ($datosLicores as $datoActual) {      
		?>
					<div class="col-sm-6 col-md-4 col-lg-3 ">
						<br>
						<?php if ($datoActual -> getInventario() > 0 && $datoActual -> getEstado() == 1) { //validacion para la existencia de productos en la BD y mostrar o no mostrar?> 
						<div class="card shadow cardCliente " >	
							<?php echo "<img src='". $datoActual -> getFoto() ."' style=' padding:auto; margin:auto;' class='card-img-top' width='50px' height='300px'>";?>
							<div class="card-body text-center " style="height: 10rem;">					
								<h5><?php echo $datoActual -> getIdClaseLicor() -> getNombre() . " " . $datoActual -> getTipo() . "</b>"?></h5>
								<h5><?php echo "<strong><b>" . $datoActual -> getValorUnidad() . "</b></strong>"?></h5>
								<form class="row justify-content-center" method="POST" action="<?php echo "index.php?pid=" . base64_encode('presentacion/carrito/carritoCompra.php') . "&idproducto="  . $datoActual -> getIdProducto() ?>">
									<div class="col-5">
										<input class="col-12" type="number" name="cantidad" min="1" max="50" value="1" required="required">
									</div>
									<div class="col-5" >
										<button type="submit" class="btn btn-primary btn-sm"><span class="fas fa-shopping-cart"></span></button>
									</div>
								</form>
								
							</div>
						</div>
						<?php }?>
					</div>
				<?php } 
				$i++; 
			} else {
				echo "<h1>NO HAY REGISTROS</h1>";
			}?>  			
	</div>
</div>
<script>
    $(document).ready(function(){
    	$("#filtro").keyup(function(){
    		if($("#filtro").val().length > 0){
    			url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/busquedaCliente.php") ?>&filtro=" + $("#filtro").val();
    			$("#resultados").load(url);
    		} else {
    			url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/busquedaCliente.php") ?>&filtro=" + $("#filtro").val();
    			$("#resultados").load(url);
    		}
    	});	
    });
</script>
