<!--=====================================
VENDEDORES
======================================-->

<div class="box box-warning">

	<div class="box-header with-border">

    	<h3 class="box-title">EFECTIVO</h3>
      <?php

			error_reporting(0);

			if(isset($_GET["fechaInicial"])){

			    $fechaInicial = $_GET["fechaInicial"];
			    $fechaFinal = $_GET["fechaFinal"];

			}else{

			$fechaInicial = null;
			$fechaFinal = null;

			}


      $graficoEfectivo = ReporteControlador::ctrEfectivo($fechaInicial,$fechaFinal);

      ?>

  	</div>

  	<div class="box-body">

		<div class="chart-responsive">

			<div class="chart" id="bar-chartGraficoEfectivo" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chartGraficoEfectivo',
  resize: true,
  data: [

  <?php

    foreach ($graficoEfectivo as $key => $value) {

      echo "{y: '".$value["nombre"]."', a: '".$value["totalEfectivo"]."'},";

    }

  ?>
  ],
  barColors: ['#efc177'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['EFECTIVO'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
