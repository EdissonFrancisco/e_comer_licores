<?php
$vendedores = new Vendedor($_SESSION["id"]);
$vendedores -> consultar();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- boton con icono de inicio -->
  <div class="container-fluid" style="padding-left: 1;">
    <a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("presentacion/sessionVendedor.php")?>"><img src="img/logoli.png" width="30px"/></a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- opciones de filtro para el usuario -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="index.php?pid=<?php echo base64_encode("presentacion/vendedor/RegistroProducto.php")?>"> Registro Productos </a> </li>        
        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="index.php?pid=<?php echo base64_encode("presentacion/vendedor/generarFactura.php")?>"> Generar Factura </a> </li>       
      </ul>
     <!-- opciones de cierre de secion y usuario -->
      <ul class="navbar-nav">    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           	<?php echo $vendedores -> getNombre() . " " . $vendedores -> getApellido(); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
           <li><a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/vendedor/editarPerfilVendedor.php")?>">Editar Perfil</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="index.php?sesion=0"> SALIR </a></li>
      </ul>
      	
    </div>
  </div>
</nav>

