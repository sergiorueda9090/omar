<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = '1990-01-01';
$fechaFinal = '2032-12-31';

}
$item = null;
$valor = null;
$respuesta = ReporteControlador::ctrMostrarTablaUtilidadTres($item,$valor, $fechaInicial, $fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

$guardar = array();
$guardarCobros = array();

foreach ($respuesta as $key => $value) {

 $dineroPrestado = $value["dineroPrestadoCliente"];

 $pagos = ReporteControlador::ctrMostrarTablaUtilidadTresPagos($value["id"],$valor,$fechaInicial,$fechaFinal);

  $n = 0;

 foreach ($pagos as $key => $p) {

   array_push($guardar,$p["pagoClienteTarjeta"]);

   $total = array_sum($guardar);
   if($total > $dineroPrestado){
     $res = verifica_rangoDos($fechaInicial, $fechaFinal, $p["fechaPagoClienteTarjeta"]);
     if($n == 0){
       if($res == "ok"){
         if($fechaInicial == '1990-01-01'){
            array_push($guardarCobros,$total-$dineroPrestado);
         }else{
           array_push($guardarCobros,$total-$dineroPrestado );
         }
         $n = 1;
       }
     }else{
       if($res == "ok"){
          array_push($guardarCobros,$p["pagoClienteTarjeta"]);
          $n = 1;
       }
     }
   }
 }
 $n = 0;
 $guardar = array();
};

function verifica_rangoDos($date_inicio, $date_fin, $date_nueva) {
   $date_inicio = strtotime($date_inicio);
   $date_fin = strtotime($date_fin);
   $date_nueva = strtotime($date_nueva);
   if (($date_nueva >= $date_inicio) && ($date_nueva <= $date_fin)){
     return "ok";
   }else{
     return "error";
   }
 }

 foreach ($respuestaInteres as $key => $value) {
      array_push($guardarCobros,$value["interes"]);
   };


?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->
<center>
  <h1><?php echo '$'. number_format(array_sum($guardarCobros)); ?></h1>
</center>
<div class="box box-solid bg-teal-gradient">

	<div class="box-header">

 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Gráfico de Utilidad Tres</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart-utilidadTres" style="height: 250px;"></div>

  </div>

</div>

<script>

 var line = new Morris.Line({
    element          : 'line-chart-utilidadTres',
    resize           : true,
    data             : [

    <?php

       echo "{ y: '0', utilidadTres: ".array_sum($guardarCobros)." }";
    ?>

    ],
    xkey             : 'y',
    ykeys            : ['utilidadTres'],
    labels           : ['utilidadTres'],
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
