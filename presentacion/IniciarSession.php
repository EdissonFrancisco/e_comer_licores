<?php
    $error = 0;
    if (isset($_GET["error"])) {
    	$error = $_GET["error"];
    }
?>

<body class="fondo-loging">
	<div class="container w-100 bg-primary mt-5 bg-light rounded shadow">

		<div class="row align-items-stretch">

			<div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded"></div> <!-- coloco imagen con css -->

			<section class="col bg-white rounded-end form-box justify-content-center align-items-center ">

				<!-- nombre y encavezado -->
				<div class="text-center">
					<img src="img/logoli.png" width="100px">
					<h1>Tu Trago</h1>
				</div>
				<!-- botones login y registro -->
				<div class="butonbox">
					<div id="btn"></div>
					<button type="button" class="toggle-btn" id="btnLog">LOG IN</button>
					<button type="button" class="toggle-btn" id="btnReg">REGISTRO</button>
				</div>

				<div id="login" style="left: auto;">
					<!-- formulario login -->
					<form method="POST" class="input-group" action="<?php echo "index.php?pid=" . base64_encode('presentacion/autenticar.php') ?>">
						<!-- contenido formulario login -->
						<div class="mb-4 input-group">
							<input type="email" name="correo" class="form-control" placeholder="Correo" required="required">
						</div>
						<div class="mb-4 input-group">
							<input type="password" name="clave" class="form-control" placeholder="Clave" required="required">
						</div>
						<div class="d-grid input-group">
							<button type="submit" class="btn btn-primary">Autenticar</button>
						</div>
						<div class="row my-2 input-group">
							<div class="col text-center">
								<a href="<?php echo "index.php?pid=" . base64_encode("presentacion/recuperarClave.php") ?>">Recuperar clave</a>
							</div>
						</div>
					</form> <!-- fin contenido formulario -->
					<br><br><br>
					<!-- errores de ingreso -->
					<?php if ($error == 1) { ?>
						<script> var errores = '<?= $_GET["error"] ?>'; </script><!-- asigno variable de error a a variable java script -->
						<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
							<strong>Usuario o clave incorrectas</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<br>
					<?php } ?>
					<!-- fin errores ingreso -->
				</div>

				<div id="registro">
					<!-- formulario registro -->
					<form method="POST" class="input-group" action="<?php echo "index.php?pid=" . base64_encode('presentacion/registro.php') ?>">
						<!-- contenido formulario registro -->
						<div class="mb-4 input-group">
							<input type="text" name="nombre" class="form-control" placeholder="Nombre" required="required">
							<input type="text" name="apellido" class="form-control" placeholder="Apellido" required="required">
						</div>
						<div class="mb-4 input-group">
							<input type="number" name="cedula" class="form-control" placeholder="cedula" required="required">
							<input type="text" name="direccion" class="form-control" placeholder="direccion" required="required">
							<input type="text" name="telefono" class="form-control" placeholder="TEL - CEL" required="required">
						</div>
						<div class="mb-4 input-group">
							<input type="email" name="correo" class="form-control" placeholder="Correo" required="required">
							<input type="password" name="clave" class="form-control" placeholder="Clave" required="required">
						</div>
						<div class="d-grid input-group">
							<button type="submit" class="btn btn-primary">REGISTRARSE</button>
						</div>
					</form> <!-- fin contenido formulario -->
					<br><br><br>
					<!-- errores de registro -->
					<?php if ($error == 2) { /*error de correo ya existente*/ ?>
						<script>
							errores = '<?= $_GET["error"] ?>';
						</script><!-- asigno variable de error a a variable java script -->
						<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
							<strong>Correo ya se encuentra registrado</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div><br>
					<?php } elseif ($error == 3) { //cuenta registrada con exito ?>
						<script>
							errores = '<?= $_GET["error"] ?>';
						</script><!-- asigno variable de error a a variable java script -->
						<div class="alert alert-primary alert-dismissible fade show text-center" role="alert" name="error6">
							<strong>cuenta creada con exito</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div><br>
					<?php } ?>
					<!-- fin errores de registro -->
				</div>
			</section>
		</div>
	</div>

	<script>
		//acciones de botones
		let btnlog = document.getElementById("btnLog"); //variable almacenar referencia a id del div
		let btnreg = document.getElementById("btnReg");

		//funcion auto click
		$(document).ready(function() {

			setTimeout(clickbutton, 2); // indicamos que se ejecuta la función a los 2 segundos de haberse cargado la pagina
			function clickbutton() {
				btnlog.click(); // simulamos el click del mouse en el boton del formulario login
			}
			//carga los mensajes de alerta por errores de ingreso o registro
			if (!errores) {
				setTimeout(clickbutton, 2); // indicamos que se ejecuta la función a los 2 segundos de haberse cargado la pagina
				function clickbutton() {
					btnlog.click(); // simulamos el click del mouse en el boton del formulario login
				}
			} else if (errores == 1) { //error de correo o clave que no existen
				setTimeout(clickbutton, 2); // indicamos que se ejecuta la función a los 2 segundos de haberse cargado la pagina
				function clickbutton() {
					btnlog.click(); // simulamos el click del mouse en el boton del formulario registro
				}
			}else if (errores == 2) { //error de correo existente en registro
				setTimeout(clickbutton, 2); // indicamos que se ejecuta la función a los 2 segundos de haberse cargado la pagina
				function clickbutton() {
					btnreg.click(); // simulamos el click del mouse en el boton del formulario registro
				}
			}else if (errores == 3) { //cuenta ingresada con exito
				setTimeout(clickbutton, 2); // indicamos que se ejecuta la función a los 2 segundos de haberse cargado la pagina
				function clickbutton() {
					btnreg.click(); // simulamos el click del mouse en el boton del formulario registro
				}
			}
		});

		//eventos para validar que se haga click
		btnlog.addEventListener("click", login);
		btnreg.addEventListener("click", registro);
		
		//aciones de formularios (variables)
		var x = document.getElementById("login");
		var y = document.getElementById("registro");
		var z = document.getElementById("btn");
		//funciones formulariio
		function login() {
			x.style.left = "20px";
			y.style.left = "1000px";
			z.style.left = "0";
		}

		function registro() {
			x.style.left = "-1000px";
			y.style.left = "20px";
			z.style.left = "100px";
		}
		
	</script>

</body>