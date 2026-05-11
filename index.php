<?php 
	session_start();

	require 'logica/Administrador.php';	
	require 'logica/Cliente.php';
	require 'logica/TelCliente.php';
	require 'logica/Marca.php';
	require 'logica/ClaseLicor.php';
	require 'logica/Producto.php';
	require 'logica/carrito.php';
	require 'logica/Orden.php';
	require 'logica/Factura.php';
	require 'logica/Domiciliario.php';
	require 'logica/Domicilio.php';
	require 'logica/Vendedor.php';
	
	if (isset($_GET["sesion"]) && $_GET["sesion"] == 0) {
	    $_SESSION["id"] = "";
	    $_SESSION["rol"] = "";
	}
	
	$pid = NULL;
	if(isset($_GET["pid"])){
	    $pid = base64_decode($_GET["pid"]);
	}
	
	$pagSinSesion = array(
	    "presentacion/recuperarClave.php",
	    "presentacion/IniciarSession.php",
	);

	/** Login POST: debe correr antes de cualquier HTML para que header(Location) funcione */
	if (
	    isset($pid)
	    && $pid === 'presentacion/autenticar.php'
	    && $_SERVER['REQUEST_METHOD'] === 'POST'
	) {
	    include __DIR__ . '/presentacion/autenticar.php';
	    exit;
	}

	$sesionActiva = !empty($_SESSION["id"]);
?>
<!doctype html>
<html lang="es">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Separate Popper and Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
		<!-- libreria de jquery y JavaScript -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<!-- estilos de iconos -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
		<!-- titulo e imagen pesta�a web -->
		<title>Elixir Celestial</title>    
		<link rel="icon" type="image/png" href="img/logoli.png">
	
		<script type="text/javascript">
            $(function () {
            	  $('[data-toggle="tooltip"]').tooltip()
            	})
        </script>
	</head> 
	<body>
		<?php
        if (isset($pid)) {
            if ($sesionActiva) {
                if($_SESSION["rol"] == "ADMINISTRADOR"){
                    include "presentacion/navBar/menuAdmin.php";
                } else if ($_SESSION["rol"] == "CLIENTE") {
                    include "presentacion/navBar/menuCliente.php";
                } else if ($_SESSION["rol"] == "DOMICILIARIO") {
                    include "presentacion/navBar/menuDomiciliario.php";
                } else if ($_SESSION["rol"] == "VENDEDOR") {
                    include "presentacion/navBar/menuVendedor.php";
                }
                include $pid;
            } else if (in_array($pid, $pagSinSesion)) {
                include $pid;
            } else {
                include $pid;
            }
        } else {
            include "presentacion/IniciarSession.php";
        }
    ?>
	</body>
</html>
