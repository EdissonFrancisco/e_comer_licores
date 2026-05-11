<?php 
    $clientes = new Administrador($_SESSION["id"]);
    $clientes -> consultaTodo();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid " style="padding-left: 3;">
    <!-- boton con icono de inicio pagina principal -->
    <a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("presentacion/sessionAdmi.php") ?>"><i class="fas fa-home"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- fin --
     -- opciones para el Admin -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- opciones CRUD -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- lista de opciones de CRUD para licores -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           	Licor
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/producto/crearProducto.php")?>'>Insertar</a></li>
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/producto/listarProducto.php")?>'>Listar</a></li>
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/producto/crearMarcaTipo.php")?>'>Marca Tipo</a></li>
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/producto/consultarProducto.php")?>'>Buscar</a></li>
          </ul>
        </li> 
        <!-- lista de opciones de CRUD para Cliente -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           	Cliente
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          	<li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/cliente/listarCliente.php")?>'>Listar</a></li>
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/cliente/consultarCliente.php")?>'>Buscar</a></li>
            
          </ul>
        </li>       
          <!-- lista de opciones de CRUD para Domiciliario -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           	Domiciliario
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          	<li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/domiciliario/cerearDomiciliario.php")?>'>Crear</a></li>
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/domiciliario/listarDomiciliario.php")?>'>Listar</a></li>
          </ul>
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           	Vendedor
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          	<li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/vendedor/crearVendedor.php")?>'>Crear</a></li>
            
          </ul>
        </li>  
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="reporteVentasDia.php">Reporte ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href='index.php?pid="<?php echo base64_encode("presentacion/admin/estadisticasVenta.php")?>'>estadistica ventas</a>
        </li>
      </ul>
        <!--  fin OP CRUD --
        -- opciones de cierre de sesion y usuario -->
      <ul class="navbar-nav">      	
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $clientes -> getNombre() . " " . $clientes -> getApellido(); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href='index.php?pid="<?php echo base64_encode("presentacion/admin/editarPerfil.php")?>'>Editar Perfil</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="index.php?sesion=0"> SALIR </a></li>
      </ul>
      	<!-- fin cierre session -->
    </div>
    <!-- fin -->
  </div>
</nav>