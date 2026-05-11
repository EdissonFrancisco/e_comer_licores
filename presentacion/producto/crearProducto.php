<?php
$marcas = new Marca();
$licorM = $marcas->consultarMarcas();
$clases = new ClaseLicor();
$licorC = $clases->consultarClases();

if (isset($_POST["crearProducto"])) {
    $archivo = $_FILES["foto"];
    $tipo = $archivo["type"];
    //$tamano = $archivo["size"];
    if ($tipo == "image/jpeg" || $tipo == "image/png") {
        $urlServidor = "imagenes/" . time() . ".png";
        $urlLocal = $archivo["tmp_name"];
        copy($urlLocal, $urlServidor);
        $producto = new Producto("", $_POST["marca"], $_POST["clase"], $_POST["tipo"], $urlServidor, $_POST["valor"], $_POST["cantidad"], $_POST["estado"]);
        $producto->crearProducto();
    } else {
        echo "<div><b>Ocurri� alg�n error al subir la imagen, No pudo guardarse.</b></div>";
    }
}

?>
<body class="fondo-loging">
	<div class="container-sm">
		<div class="row mt-3">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card">
					<h5 class="card-header text-center">Crear Producto</h5>
					<div class="card-body">
    					<?php if(isset($_POST["crearProducto"])) { ?>
    					<div class="alert alert-success alert-dismissible fade show"
							role="alert">
							Datos registrados correctamente
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
    					<?php } ?>				
    					<form method="post"
							action="index.php?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php")?>" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Marca</label>
								<select class="form-select" name="marca">
        							<?php
    									echo "<option disabled selected>--Seleccione Marca--</option>";
                                        foreach ($licorM as $marcaActual) {
                                            echo "<option value='" . $marcaActual->getIdMarca() . "'>" . $marcaActual->getNombre() . "</option>";
                                        }
                                    ?>
    							</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Clase</label>
								<select class="form-select" name="clase">
        							<?php
    									echo"<option disabled selected>--Seleccione Tipo--</option>";
                                        foreach ($licorC as $claseActual) {
                                            echo "<option value='" . $claseActual->getIdClaseLicor() . "'>" . $claseActual->getNombre() . "</option>";
                                        }
                                    ?>
    							</select>
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Caracteristica</label>
								<input type="text" class="form-control" name="tipo"
									required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Foto</label>
								<input type="file" class="form-control" name="foto" id="foto">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Valor
									Unitario</label> <input type="number" class="form-control"
									name="valor" required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Cantidad</label>
								<input type="number" class="form-control" name="cantidad"
									required="required">
							</div>

							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Estado</label>
								<select class="form-select" aria-label="Default select example"
									name="estado">
									<option disabled selected>--Seleccione estado--</option>
									<option value="1">1 - Activo</option>
									<option value="2">2 - Suspendido</option>
								</select>
							</div>
							<div class="d-grid">
								<button type="submit" name="crearProducto"
									class="btn btn-primary">Crear</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>