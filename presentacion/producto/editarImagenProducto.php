<?php
if(isset($_POST["editarImagen"])){
    $producto = new Producto($_GET["id"]);
    $producto -> consultar();
    
    unlink($producto -> getFoto());    
    
    $rutaServidor = "imagenes/" . time() . ".png";
    $rutaLocal = $_FILES["imagen"]["tmp_name"];
    copy($rutaLocal, $rutaServidor);
    
    $producto = new Producto($_GET["id"], "", "", "", $rutaServidor, "", "", "");
    $producto -> editarImagen();
}
?>
<body class="fondo-loging">
<div class="container">
	<div class="row mt-3">
		<div class="col-sm-0 col-md-3"></div>
		<div class="col-sm-12 col-md-6">
			<div class="card">
				<h5 class="card-header">Editar Imagen Producto</h5>
				<div class="card-body">
					<?php if (isset($_POST["editarImagen"])) { ?>
					<div class="alert alert-success alert-dismissible fade show"
						role="alert">
						Datos ingresados correctamente.
						<button type="button" class="btn-close" data-bs-dismiss="alert"
							aria-label="Close"></button>
					</div>
					
					<?php } ?>
					<form action="index.php?pid=<?php echo base64_encode("presentacion/producto/editarImagenProducto.php") ?>&id=<?php echo $_GET["id"]?>" method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="formFile" class="form-label">Seleccione el archivo</label> 
							<input class="form-control" type="file" name="imagen" required="required">
						</div>
						<div class="d-grid">
							<button type="submit" name="editarImagen" class="btn btn-primary">Editar Imagen</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>