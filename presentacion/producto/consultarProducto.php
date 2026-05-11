<body class="fondo-loging" >
    <div class="container">
    	<div class="row mt-3">
    		<div class="col-3"></div>
    		<div class="col-6">
    			<div class="card">
    				<div class="card-header">
    					<h3>Buscar Producto</h3>
    				</div>
    				<div class="card-body">
    					<div class="form-group">
    						<input type="text" id="filtro" class="form-control" placeholder="Filtro">
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="row mt-3">
    		<div class="col">
    			<div id="resultados"></div>
    		</div>
    	</div>
    </div>
    <script>
    $(document).ready(function(){
    	$("#filtro").keyup(function(){
    		if($("#filtro").val().length > 0){
    			url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/consultarProductoAjax.php") ?>&filtro=" + $("#filtro").val();
    			$("#resultados").load(url);
    		}
    	});
    });
    </script>
</body>