<script type="text/javascript">
$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
<?php
    session_start();
    require 'logica/Marca.php';
    require 'logica/ClaseLicor.php';
    require 'logica/Producto.php';
    require 'logica/Cliente.php';
    require 'logica/Domiciliario.php';
    
    if(isset($_SESSION["id"])){
        $pid = base64_decode($_GET["pid"]);
        include $pid;
    }else{
        header("Location: index.php");
    }
?>
