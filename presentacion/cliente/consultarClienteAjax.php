<?php
    $filtro = $_GET["filtro"];
    $clientes = new Cliente();
    $clientes = $clientes -> consultarFiltro($filtro); 
?>

<body class="fondo-loging" >
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">Consultar Clientes</h5>
				<div class="card-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>	
								<th scope="col">#</th>							
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Cedula</th>
								<th scope="col">Direccion</th>
								<th scope="col">Correo</th>
								<th scope="col">Estado</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							foreach ($clientes as $clienteActual){
							    echo "<tr>";
							    echo "<td>" . $i++ . "</td>";
							    echo "<td>" . $clienteActual -> getNombre() . "</td>";		
							    echo "<td>" . $clienteActual -> getApellido() . "</td>";
							    echo "<td>" . $clienteActual -> getNit_cc() . "</td>";
							    echo "<td>" . $clienteActual -> getDireccion() . "</td>";
							    echo "<td>" . $clienteActual -> getCorreo() . "</td>";
							    
							    echo "<td><div id='estado" . $clienteActual -> getIdCliente() . "'>" . (($clienteActual -> getEstado()==1)?"<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>":"<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>") . "<div></td>";
							    echo "<td><div id='cambiarEstado" . $clienteActual -> getIdCliente() . "'><a href='#'><i class='fas fa-user-edit' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a><div></td>";
							    
							    echo "</tr>";
							    
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        <?php 
            $i = 1;
            foreach ($clientes as $clienteActual){
                echo "\t$(\"#cambiarEstado" . $clienteActual -> getIdCliente() . "\").click(function(){\n";
                echo "\t\turl = \"indexAjax.php?pid=" . base64_encode("presentacion/cliente/cambiarEstadoClienteAjax.php") . "&idCliente=" . $clienteActual -> getIdCliente() . "&estado=" . (($clienteActual -> getEstado()==1)?"0":"1") . "\"\n";
                echo "\t\t$(\"#estado" . $clienteActual -> getIdCliente() . "\").load(url);\n";
                echo "\t});\n\n";
            }	
        ?>
    });
</script>
</body>