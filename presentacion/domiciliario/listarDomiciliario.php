<?php
    $dom = new Domiciliario();
    //$datosDom = $dom -> consultarTodo();
    
    $regPag = 5;
    $pag = 1;
    if(isset($_GET["pag"])){
        $pag = $_GET["pag"];
    }
    if(isset($_GET["regPag"])){
        $regPag = $_GET["regPag"];
    }
    
    $datosDom = $dom -> consultarTodosPag($pag, $regPag);
    $numReg = $dom -> consultarNumReg();
?>

<body class="fondo-loging" >
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">DOMICILIARIOS</h5>
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
							foreach ($datosDom as $domiActual){
							    echo "<tr>";
							    echo "<td>" . $i++ . "</td>";
							    echo "<td>" . $domiActual -> getNombre() . "</td>";		
							    echo "<td>" . $domiActual -> getApellido() . "</td>";
							    echo "<td>" . $domiActual -> getNit_cc() . "</td>";
							    echo "<td>" . $domiActual -> getDireccion() . "</td>";
							    echo "<td>" . $domiActual -> getCorreo() . "</td>";
							    
							    echo "<td><div id='estado" . $domiActual -> getIdDomiciliario() . "'>" . (($domiActual -> getEstado()==1)?"<i class='fas fa-check-circle' data-toggle='tooltip' data-placement='bottom' title='Habilitado'></i>":"<i class='fas fa-times-circle' data-toggle='tooltip' data-placement='bottom' title='Deshabilitado'></i>") . "<div></td>";
							    echo "<td><div id='cambiarEstado" . $domiActual -> getIdDomiciliario() . "'><a href='#'><i class='fas fa-user-edit' data-toggle='tooltip' data-placement='bottom' title='Cambiar Estado'></i></a><div></td>";
							    
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
										href="<?php echo "index.php?pid=" . base64_encode("presentacion/domiciliario/listarDomiciliario.php") . "&pag=" . ($pag-1) ?>"
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
                                            echo "<a class='page-link' href='index.php?pid=" . base64_encode("presentacion/domiciliario/listarDomiciliario.php") . "&pag=" . $i . "'>" . $i . "</a>";
                                        }
                                        echo "</li>";
                                    }
                                    ?>
									<li
										class="page-item <?php echo ($pag == $botones)?"disabled":"" ?> ">
										<a class="page-link"
										href="<?php echo "index.php?pid=" . base64_encode("presentacion/domiciliario/listarDomiciliario.php") . "&pag=" . ($pag+1) ?>"
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
            foreach ($datosDom as $domiActual){
                echo "\t$(\"#cambiarEstado" . $domiActual -> getIdDomiciliario() . "\").click(function(){\n";
                echo "\t\turl = \"indexAjax.php?pid=" . base64_encode("presentacion/domiciliario/cambiarEstadoDomiAjax.php") . "&idDomi=" . $domiActual -> getIdDomiciliario() . "&estado=" . (($domiActual -> getEstado()==1)?"0":"1") . "\"\n";
                echo "\t\t$(\"#estado" . $domiActual -> getIdDomiciliario() . "\").load(url);\n";
                echo "\t});\n\n";
            }	
        ?>
    });
</script>
</body>