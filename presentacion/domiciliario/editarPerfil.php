<?php
    $idPerfil = $_SESSION["id"];
    
    $clientes = new Domiciliario($idPerfil);
    $clientes -> consultar();
        
    if (isset($_POST["editar"])) {      
        $clientes = new Domiciliario($idPerfil,  $_POST["nombre"], $_POST["apellido"], $_POST["cedula"], $_POST["direccion"], $_POST["correo"], "","");
        $clientes -> actualizar();
    }
?>
<body class="fondo-loging">
	<div class="container-sm">
		<div class="row mt-4">
			<div class="col-2"></div>
			<div class="col-9">
				<div class="card">
					<h5 class="card-header text-center">Editar Perfil</h5>
					<div class="card-body">
    					<?php if(isset($_POST["editar"])) { ?>
    					<div class="alert alert-success alert-dismissible fade show"
							role="alert">
							Datos actualizados correctamente
							<button type="button" class="btn-close" data-bs-dismiss="alert"
								aria-label="Close"></button>
						</div>
    					<?php } ?>				
    					<form method="post" action="index.php?pid=<?php echo base64_encode("presentacion/domiciliario/editarPerfil.php")?>&idPerfil=<?php echo $idPerfil ?>">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Nombre</label>
								<input type="text" class="form-control" name="nombre" value="<?php echo $clientes -> getNombre(); ?>"
									required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Apellido</label>
								<input type="text" class="form-control" name="apellido" value="<?php echo $clientes -> getApellido(); ?>"
									required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Cedula</label>
								<input type="text" class="form-control" name="cedula" value="<?php echo $clientes -> getNit_cc(); ?>"
									required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Direccion</label>
								<input type="text" class="form-control" name="direccion" value="<?php echo $clientes -> getDireccion(); ?>"
									required="required">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Correo</label>
								<input type="text" class="form-control" name="correo" value="<?php echo $clientes -> getCorreo(); ?>"
									required="required">
							</div>

							<div class="d-grid">
								<button type="submit" name="editar"
									class="btn btn-primary">Guardar Cambios</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>