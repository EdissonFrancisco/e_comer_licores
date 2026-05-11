<?php

$venta = new Orden();
$estadistica = $venta -> consultarProductosVendidos();


$datos = array();
foreach ($estadistica as $estadisticaActual){
    if (!array_key_exists($estadisticaActual[1], $datos)) {
        $datos[$estadisticaActual[1]] = $estadisticaActual[0];
    } else {
        $datos[$estadisticaActual[1]] += $estadisticaActual[0];
    }
}

?>
<div class="container">
	<div class="row mt-3">
		<div class="col">
			<div class="card">
				<h5 class="card-header">Estadisticas de venta por clase de licor</h5>
				<div class="card-body">
					<div id="piechart" style="height: 500px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

   	var data = google.visualization.arrayToDataTable([
    ['Clase Licor', 'Cantidad'],
      <?php 
          foreach ($datos as $key => $value){
              echo "['" . $key . "', " . $value . "],";
          }      
      ?>
    ]);
    
    var options = {     
          pieSliceText: 'label',
          slices: { 1: {offset: 0.1},
                    2: {offset: 0.8},
                    3: {offset: 0.3},
                    4: {offset: 0.4},
          },
    };    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));    
    chart.draw(data, options);
}
</script>