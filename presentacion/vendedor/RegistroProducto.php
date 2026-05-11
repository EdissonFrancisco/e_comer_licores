<?php 
    $marcas = new Marca();
    $licorM = $marcas->consultarMarcas();
    
    $clases = new ClaseLicor();
    $licorC = $clases->consultarClases();
    
   /* url = "indexAjax.php?pid=<?php echo  base64_encode("presentacion/mostrarDatosAjax.php") ?>&idclaseLicor=" + $("#claseLicor").val() + "&idMarca=" + $("#marca").val();
    $("#result").load(url);*/
?>

<div class="container">
	<div class="row mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3>Registro Productos</h3>
				</div>
				<div class="card-body">					
					<div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupSelect01">Clase Licor</label>
						<select class="form-select" id="claseLicor">
							<?php
								echo"<option disabled selected>--Seleccione Tipo--</option>";
                                foreach ($licorC as $claseActual) {
                                    echo "<option value='" . $claseActual->getIdClaseLicor() . "'>" . $claseActual->getNombre() . "</option>";
                                }
                            ?>
						</select>
						<label class="input-group-text" for="inputGroupSelect01">Marca</label>
						<select class="form-select" id="marca">
							<?php
								echo "<option disabled selected>--Seleccione Marca--</option>";
                                foreach ($licorM as $marcaActual) {
                                    echo "<option value='" . $marcaActual->getIdMarca() . "'>" . $marcaActual->getNombre() . "</option>";
                                }
                            ?>
						</select>
						<button class="btn btn-outline-secondary" type="button" id="botonBuscar">Buscar</button>
					</div>
					
					<div class="row mt-3">
						<div class="col">
							<div id="result"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#botonBuscar").click(function(){
		url = "indexAjax.php?pid=<?php echo  base64_encode("presentacion/vendedor/mostrarDatosAjax.php") ?>&idclaseLicor=" + $("#claseLicor").val() + "&idMarca=" + $("#marca").val();
		$("#result").load(url);
	});
});
</script>
