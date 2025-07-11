<!--=====================================
VENDEDORES
======================================-->

<div class="box box-warning">

	<div class="box-header with-border">

    	<h3 class="box-title">PRESTAMOS</h3>
      <?php

			error_reporting(0);

			if(isset($_GET["fechaInicial"])){

			    $fechaInicial = $_GET["fechaInicial"];
			    $fechaFinal = $_GET["fechaFinal"];

			}else{

			$fechaInicial = null;
			$fechaFinal = null;

			}


       $graficoCobros = ReporteControlador::ctrGraficaPrestamos($fechaInicial,$fechaFinal);
			 //var_dump($graficoCobros);
      ?>

  	</div>

  	<div class="box-body">

		<div class="chart-responsive">

			<div class="chart" id="bar-chartGraficoPrestamos" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chartGraficoPrestamos',
  resize: true,
  data: [

  <?php

    foreach ($graficoCobros as $key => $value) {

      echo "{y: '".$value["nombre"]."', a: '".$value["totalPrestamo"]."'},";

    }

  ?>
  ],
  barColors: ['#F39C12'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['PRESTAMOS'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
