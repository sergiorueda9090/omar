<!--=====================================
VENDEDORES
======================================-->

<div class="box box-primary">

	<div class="box-header with-border">

    	<h3 class="box-title">GASTO</h3>
      <?php

			error_reporting(0);

			if(isset($_GET["fechaInicial"])){

			    $fechaInicial = $_GET["fechaInicial"];
			    $fechaFinal = $_GET["fechaFinal"];

			}else{

			$fechaInicial = null;
			$fechaFinal = null;

			}

      $graficoGastos = ReporteControlador::ctrGasto($fechaInicial,$fechaFinal);
      ?>

  	</div>

  	<div class="box-body">

		<div class="chart-responsive">

			<div class="chart" id="bar-chartGraficoGasto" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chartGraficoGasto',
  resize: true,
  data: [

  <?php

    foreach ($graficoGastos as $key => $value) {

      echo "{y: '".$value["nombre"]."', a: '".$value["totalGasto"]."'},";

    }

  ?>
  ],
  barColors: ['#3C8DBC'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['GASTO'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
