<!--=====================================
VENDEDORES
======================================-->

<div class="box box-success">

	<div class="box-header with-border">

    	<h3 class="box-title">BANCO</h3>
      <?php

			error_reporting(0);

			if(isset($_GET["fechaInicial"])){

			    $fechaInicial = $_GET["fechaInicial"];
			    $fechaFinal = $_GET["fechaFinal"];

			}else{

			$fechaInicial = null;
			$fechaFinal = null;

			}

      $graficoBanco = ReporteControlador::ctrBanco($fechaInicial,$fechaFinal);

			?>

  	</div>

  	<div class="box-body">

		<div class="chart-responsive">

			<div class="chart" id="bar-chartGraficoBanco" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chartGraficoBanco',
  resize: true,
  data: [

  <?php

    foreach ($graficoBanco as $key => $value) {

      echo "{y: '".$value["nombre"]."', a: '".$value["totalBanco"]."'},";

    }

  ?>
  ],
  barColors: ['#63ebad'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['BANCO'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
