<!--=====================================
VENDEDORES
======================================-->

<div class="box box-danger">

	<div class="box-header with-border">

    	<h3 class="box-title">BILLETERA</h3>
      <?php

			error_reporting(0);

			if(isset($_GET["fechaInicial"])){

			    $fechaInicial = $_GET["fechaInicial"];
			    $fechaFinal = $_GET["fechaFinal"];

			}else{

			$fechaInicial = null;
			$fechaFinal = null;

			}

      $graficoBilletera = ReporteControlador::ctrBilletera($fechaInicial,$fechaFinal);

		  ?>

  	</div>

  	<div class="box-body">

		<div class="chart-responsive">

			<div class="chart" id="bar-chartGraficoBilletera" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chartGraficoBilletera',
  resize: true,
  data: [

  <?php

    foreach ($graficoBilletera as $key => $value) {

      echo "{y: '".$value["nombre"]."', a: '".$value["totalBilletera"]."'},";

    }

  ?>
  ],
  barColors: ['#f7796a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['BILLETERA'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
