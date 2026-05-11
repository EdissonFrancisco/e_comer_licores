
<?php 
//if($_SESSION["rol"] == "ADMINISTRADOR"){
    if ($_GET["idProducto"] ) {
        $producto = new Producto($_GET["idProducto"]);
        $producto -> consultar();
    }
    
    if (isset($_POST["actualizar"])) {
        $producto = new Producto($_GET["idProducto"]);
        
        $cantidadSumar = $_POST["inventario"];
        $cantidadActual = $_GET["canInventario"];
        $nuevoInventario = $cantidadActual + $cantidadSumar;
        
        $producto -> actualizaInventario(intval($nuevoInventario));
        
        $producto -> consultar();
        
    }
?>
<div class="container-fluid fondo-loging">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
                <div class="p-3 mb-2 bg-dark bg-gradient fw-bold text-white text-center">Actualizar Cantidad Inventario</div>
                <div class="card-group border-none">
                    <div class="card">
                        <img src="<?php echo $producto -> getFoto()?>" class="card-img rounded-circle" alt="imagen de vaso" width="304" height="236">
                    </div>
                    <div class="card justify-content-center align-items-center">
                    	<span>Nombre: </span> <?php echo $producto ->getIdMarca() -> getNombre() . " " . $producto ->getIdClaseLicor() -> getNombre() ?>
                        <span>Inventario actual: </span> <?php echo $producto -> getInventario()  ?>
						
						<form method="POST" action="<?php echo "index.php?pid=" . base64_encode('presentacion/producto/inventarioProducto.php') ?>&idProducto=<?php echo $_GET["idProducto"] ?>&canInventario=<?php echo $producto -> getInventario() ?>">
							<!-- contenido formulario inventario -->
							<?php if(isset($_POST["actualizar"])) { ?>
							<div class="alert alert-success alert-dismissible fade show"
								role="alert">
								Inventario Actualizado Correctamente
								<button type="button" class="btn-close" data-bs-dismiss="alert"
									aria-label="Close"></button>
							</div>
							<?php } ?>	
							<div class="mb-4 ">
								<input type="number" name="inventario" class="form-control"
									placeholder="cantidad" required="required">
							</div>
							<div class="d-grid ">
								<button type="submit" class="btn btn-primary" name="actualizar">actualizar</button>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*} else {
    echo "Lo siento. Usted no tiene permisos";
}*/
?>