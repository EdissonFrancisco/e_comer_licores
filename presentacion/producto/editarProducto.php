<?php

$idProducto = $_GET["idProducto"];

$producto = new Producto($idProducto);
$producto -> consultar();

$marcas = new Marca();
$licorM = $marcas->consultarMarcas();
$clases = new ClaseLicor();
$licorC = $clases->consultarClases();

if (isset($_POST["editar"])) {    
    $producto = new Producto($idProducto, $_POST["marca"], $_POST["clase"], $_POST["tipo"], "", $_POST["valor"], $_POST["cantidad"], $_POST["estado"]);
    $producto -> actualizar();
}

?>
<body class="fondo-loging">
	<div class="container-sm">
		<div class="row mt-3">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card">
					<h5 class="card-header text-center">Editar Producto</h5>
					<div class="card-body">
    					<?php if(isset($_POST["crear"])) { ?>
    					<div class="alert alert-success alert-dismissible fade show"
							role="alert">
							Datos registrados correctamente
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
    					<?php } ?>				
    					<form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/producto/editarProducto.php")?>&idProducto=<?php echo $idProducto ?>" enctype="multipart/form-data">
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Marca</label>
								<select class="form-select" name="marca">
    							<?php
                                    foreach ($licorM as $marcaActual) {
                                        echo "<option value='" . $marcaActual->getIdMarca() . "'" . (($marcaActual->getIdMarca() == $producto->getIdMarca()->getIdMarca())?" selected":"") . ">" . $marcaActual->getNombre() . "</option>";
                                    }
                                ?>
    							</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Clase</label>
								<select class="form-select" name="clase">
    							<?php
                                    foreach ($licorC as $claseActual) {
                                        echo "<option value='" . $claseActual->getIdClaseLicor() . "'" . (($claseActual->getIdClaseLicor() == $producto->getIdClaseLicor()->getIdClaseLicor())?" selected":"") . ">" . $claseActual->getNombre() . "</option>";
                                    }
                                ?>
    							</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Caracteristica</label>
								<input type="text" class="form-control" name="tipo" value="<?php echo $producto -> getTipo(); ?>"
									required="required">
							</div>							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Valor
									Unitario</label> <input type="number" class="form-control"
									name="valor" required="required" value="<?php echo $producto -> getValorUnidad(); ?>">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Cantidad</label>
								<input type="number" class="form-control" name="cantidad"
									required="required" value="<?php echo $producto -> getInventario(); ?>">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Estado</label>
								<select class="form-select" aria-label="Default select example" name="estado">
    								<?php 
        								if ($producto -> getEstado() == 1) {
        								    echo "<option value='1' selected>1 - Activo</option>
            								      <option value='0' >0 - Suspendido</option>";
        								} else {
        								    echo "<option value='1' >1 - Activo</option>
            								      <option value='0' selected>0 - Suspendido</option>";
        								}
        							?>
								</select>
							</div>
							<div class="d-grid">
								<button type="submit" name="editar"
									class="btn btn-primary">Editar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>