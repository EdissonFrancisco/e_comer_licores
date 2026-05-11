<?php
$creado = 0;
$errorMarca = '';
$errorTipo = '';

if (isset($_POST["crearMarca"])) {
    $nombreMarca = trim($_POST["marca"] ?? '');
    $descMarca = trim($_POST["descripcionMarca"] ?? '');
    if ($nombreMarca === '' || $descMarca === '') {
        $errorMarca = 'Completa el nombre y la descripción de la marca.';
    } else {
        $marca = new Marca('', $nombreMarca, $descMarca);
        $marca->crearMarca();
        $creado = 1;
    }
} elseif (isset($_POST["crearTipo"])) {
    $nombreTipo = trim($_POST["tipo"] ?? '');
    $descTipo = trim($_POST["descripcionTipo"] ?? '');
    if ($nombreTipo === '' || $descTipo === '') {
        $errorTipo = 'Completa el nombre y la descripción de la clase de licor.';
    } else {
        $tipo = new ClaseLicor('', $nombreTipo, $descTipo);
        $tipo->crearTipoLicor();
        $creado = 2;
    }
}

$initialTab = 1;
if ($creado === 2 || ($errorTipo !== '' && $errorMarca === '')) {
    $initialTab = 2;
}
if ($errorMarca !== '') {
    $initialTab = 1;
}
?>
<body class="fondo-loging">
	<div class="container px-3 marcar-tipo-max">
		<div class="row justify-content-center py-4">
			<section class="col-12 rounded shadow bg-white form-box form-marca-tipo-shell p-3 p-md-4">

				<div class="butonbox">
					<div id="btn"></div>
					<button type="button" class="toggle-btn" id="btnMarca">Crear Marca</button>
					<button type="button" class="toggle-btn" id="btnTipo">Crear Clase</button>
				</div>

				<div id="CrearMarca">
					<h2 class="h4 text-center">Marca de licor</h2>
					<form method="post"
						action="index.php?pid=<?php echo base64_encode('presentacion/producto/crearMarcaTipo.php'); ?>">
						<div class="mb-3">
							<label class="form-label" for="marcaNombre">Nombre marca</label>
							<input type="text" class="form-control" id="marcaNombre" name="marca" required
								value="<?php echo htmlspecialchars($_POST["marca"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class="mb-3">
							<label class="form-label" for="marcaDesc">Descripción</label>
							<textarea class="form-control" id="marcaDesc" rows="3" name="descripcionMarca" required><?php
								echo htmlspecialchars($_POST["descripcionMarca"] ?? '', ENT_QUOTES, 'UTF-8');
							?></textarea>
						</div>
						<div class="d-grid">
							<button type="submit" name="crearMarca" class="btn btn-primary">Crear</button>
						</div>
					</form>
					<br>
					<?php if ($errorMarca !== '') { ?>
						<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
							<?php echo htmlspecialchars($errorMarca, ENT_QUOTES, 'UTF-8'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
						</div>
					<?php } ?>
					<?php if ($creado === 1) { ?>
						<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
							<strong>Marca guardada correctamente.</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
						</div>
					<?php } ?>
				</div>

				<div id="CrearTipo">
					<h2 class="h4 text-center">Clase de licor</h2>
					<form method="post"
						action="index.php?pid=<?php echo base64_encode('presentacion/producto/crearMarcaTipo.php'); ?>">
						<div class="mb-3">
							<label class="form-label" for="tipoNombre">Nombre clase</label>
							<input type="text" class="form-control" id="tipoNombre" name="tipo" required
								value="<?php echo htmlspecialchars($_POST["tipo"] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
						</div>
						<div class="mb-3">
							<label class="form-label" for="tipoDesc">Descripción</label>
							<textarea class="form-control" id="tipoDesc" rows="3" name="descripcionTipo" required><?php
								echo htmlspecialchars($_POST["descripcionTipo"] ?? '', ENT_QUOTES, 'UTF-8');
							?></textarea>
						</div>
						<div class="d-grid">
							<button type="submit" name="crearTipo" class="btn btn-primary">Crear</button>
						</div>
					</form>
					<br>
					<?php if ($errorTipo !== '') { ?>
						<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
							<?php echo htmlspecialchars($errorTipo, ENT_QUOTES, 'UTF-8'); ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
						</div>
					<?php } ?>
					<?php if ($creado === 2) { ?>
						<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
							<strong>Clase guardada correctamente.</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
						</div>
					<?php } ?>
				</div>

			</section>
		</div>
	</div>


<script>
		(function () {
			let btnMarca = document.getElementById('btnMarca');
			let btnTipo = document.getElementById('btnTipo');
			let x = document.getElementById('CrearMarca');
			let y = document.getElementById('CrearTipo');
			let z = document.getElementById('btn');
			let off = '118%';

			function crearMarcas() {
				x.style.transform = 'translateX(0)';
				y.style.transform = 'translateX(' + off + ')';
				if (z) z.style.left = '0';
			}

			function crearTipos() {
				x.style.transform = 'translateX(-' + off + ')';
				y.style.transform = 'translateX(0)';
				if (z) z.style.left = '100px';
			}

			btnMarca.addEventListener('click', crearMarcas);
			btnTipo.addEventListener('click', crearTipos);

			var initialTab = <?php echo (int) $initialTab; ?>;

			$(document).ready(function () {
				setTimeout(function () {
					if (initialTab === 2) {
						btnTipo.click();
					} else {
						btnMarca.click();
					}
				}, 10);
			});
		})();
	</script>
</div>
