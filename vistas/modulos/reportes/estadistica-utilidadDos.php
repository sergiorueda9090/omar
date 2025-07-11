<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$pila = array();

$respuesta = ReporteControlador::ctrUtilidadDos($fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

  foreach ($respuesta as $key => $values) {

    $respuestaDos = ReporteControlador::ctrUtilidadDosDos($fechaInicial,$fechaFinal,$values["id"]);

    foreach ($respuestaDos as $keyDos => $value) {

      if($values["tipoPrestamoCliente"] == 'diario'){
          array_push($pila,($values["interesMensualCliente"]/30));
      }else if($values["tipoPrestamoCliente"] == 'semanal'){
          array_push($pila,($values["interesMensualCliente"]/4));
      }else if($values["tipoPrestamoCliente"] == 'quincenal'){
          array_push($pila,($values["interesMensualCliente"]/2));
      }
      else{
        array_push($pila,$values["interesMensualCliente"]);
      }

    }
  };

  foreach ($respuestaInteres as $key => $value) {
      array_push($pila,$value["interes"]);
  };

  echo '<center><h1>$ '.number_format(array_sum($pila)).'</h1></center>';
?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="box box-solid bg-teal-gradient">

	<div class="box-header">

 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Utilidad Dos</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoUtilidadUno">

		<div class="chart" id="line-chart-utilidad-dos" style="height: 250px;"></div>

  </div>

</div>

<script>

 var line = new Morris.Line({
    element          : 'line-chart-utilidad-dos',
    resize           : true,
    data             : [

    <?php


       echo "{ y: '".$fechaInicial.' A '.$fechaFinal."', utilidadDos: ".array_sum($pila)." }";


    ?>

    ],
    xkey             : 'y',
    ykeys            : ['utilidadDos'],
    labels           : ['utilidadDos'],
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
