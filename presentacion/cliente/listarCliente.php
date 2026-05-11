<?php
    $clientes = new Cliente();
    //$clientes = $clientes -> consultarTodos(); 
    
    $regPag = 5;
    $pag = 1;
    if(isset($_GET["pag"])){
        $pag = $_GET["pag"];
    }
    if(isset($_GET["regPag"])){
        $regPag = $_GET["regPag"];
    }
    
    $clientessitos = $clientes -> consultarTodosPag($pag, $regPag);
    $numReg = $clientes -> consultarNumReg();
?>

<body class="fondo-loging" >
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">CLIENTES</h5>
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
							foreach ($clientessitos as $clienteActual){
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

						<div class="text-center">
							<nav aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item <?php echo ($pag == 1)?"disabled":"" ?> ">
										<a class="page-link"
    										href="<?php echo "index.php?pid=" . base64_encode("presentacion/cliente/listarCliente.php") . "&pag=" . ($pag-1) ?>"
    										aria-label="Previous"> <span aria-hidden="true">&laquo;</span>
    									</a>
									</li>
									<?php
                                    $botones = $numReg / $regPag;
                                    if ($numReg % $regPag != 0) {
                                        $botones ++;
                                    }
                                    for ($i = 1; $i <= $botones; $i ++) {
                                        echo "<li class='page-item " . (($i == $pag) ? "active" : "") . "'>";
                                        if ($pag == $i) {
                                            echo "<span class='page-link'>" . $i . "</span>";
                                        } else {
                                            echo "<a class='page-link' href='index.php?pid=" . base64_encode("presentacion/cliente/listarCliente.php") . "&pag=" . $i . "'>" . $i . "</a>";
                                        }
                                        echo "</li>";
                                    }
                                    ?>
									<li
										class="page-item <?php echo ($pag == $botones)?"disabled":"" ?> ">
										<a class="page-link"
										href="<?php echo "index.php?pid=" . base64_encode("presentacion/cliente/listarCliente.php") . "&pag=" . ($pag+1) ?>"
										aria-label="Next"> <span aria-hidden="true">&raquo;</span>
									</a>
									</li>
								</ul>
							</nav>
						</div>

					</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        <?php 
            $i = 1;
            foreach ($clientessitos as $clienteActual){
                echo "\t$(\"#cambiarEstado" . $clienteActual -> getIdCliente() . "\").click(function(){\n";
                echo "\t\turl = \"indexAjax.php?pid=" . base64_encode("presentacion/cliente/cambiarEstadoClienteAjax.php") . "&idCliente=" . $clienteActual -> getIdCliente() . "&estado=" . (($clienteActual -> getEstado()==1)?"0":"1") . "\"\n";
                echo "\t\t$(\"#estado" . $clienteActual -> getIdCliente() . "\").load(url);\n";
                echo "\t});\n\n";
            }	
        ?>
    });
</script>
</body>

