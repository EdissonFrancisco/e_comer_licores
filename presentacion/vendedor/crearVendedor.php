<?php
    if (isset($_POST["crearVendedor"])) {
                            //$pIdVendedor="", $pNombre="", $pApellido="", $pNit_cc="", $pDireccion="", $pCorreo="", $pClave="", $pEstado=""
        $vendedores = new Vendedor("", $_POST["nombre"], $_POST["apellido"], $_POST["cc"], $_POST["direccion"], $_POST["correo"], md5($_POST["clave"]), $_POST["estado"]);
        $vendedores -> crearVendedores();
        
    }
?>
<body class="fondo-loging">
	<div class="container-sm">
		<div class="row mt-3">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card">
					<h5 class="card-header text-center">Crear Vendedor</h5>
					<div class="card-body">
    					<?php if(isset($_POST["crearDomi"])) { ?>
    					<div class="alert alert-success alert-dismissible fade show"
							role="alert">
							Datos registrados correctamente
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
    					<?php } ?>				
    					<form method="post"
							action="index.php?pid=<?php echo base64_encode("presentacion/vendedor/crearVendedor.php")?>">
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Nombre</label>
								<input type="text" class="form-control" name="nombre" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Apellido</label>
								<input type="text" class="form-control" name="apellido" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Cedula</label> 
								<input type="number" class="form-control"name="cc" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Direccion</label>
								<input type="text" class="form-control" name="direccion" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Correo</label>
								<input type="email" class="form-control" name="correo" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Clave</label>
								<input type="password" class="form-control" name="clave" required="required">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Estado</label>
								<select class="form-select" aria-label="Default select example"
									name="estado">
									<option disabled selected>--Estado Domiciliario--</option>
									<option value="1">1 - Activo</option>
									<option value="2">2 - Suspendido</option>
								</select>
							</div>

							<div class="d-grid">
								<button type="submit" name="crearVendedor" class="btn btn-primary">Crear</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>