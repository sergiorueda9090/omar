<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

//$respuesta = ReporteControlador::ctrEstadisticaUtilidadUno($fechaInicial, $fechaFinal);

$respuesta = ReporteControlador::ctrDescargarReporteExcelUtilidad($fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

$arrayVentas = array();

foreach ($respuesta as $key => $value) {
array_push($arrayVentas,$value["valorTotalInteresCliente"]);
};

foreach ($respuestaInteres as $key => $value) {
      array_push($arrayVentas,$value["interes"]);
};

?>
  <center><h1><?php echo '$ '.number_format(array_sum($arrayVentas)); ?></h1></center>
<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="box box-solid bg-teal-gradient">

	<div class="box-header">

 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Utilidad Uno</h3>


	</div>

	<div class="box-body border-radius-none nuevoGraficoUtilidadUno">

		<div class="chart" id="line-chart-utilidad-uno" style="height: 250px;"></div>

  </div>

</div>

<script>

 var line = new Morris.Line({
    element          : 'line-chart-utilidad-uno',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$fechaInicial.' A '.$fechaFinal."', utilidadUno: ".array_sum($arrayVentas)." }";


	    }

	    echo "{ y: '".$fechaInicial.' A '.$fechaFinal."', utilidadUno: ".array_sum($arrayVentas)." }";

    }else{

       echo "{ y: '', utilidadUno: ".array_sum($arrayVentas)." }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['utilidadUno'],
    labels           : ['utilidadUno'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });

</script>
