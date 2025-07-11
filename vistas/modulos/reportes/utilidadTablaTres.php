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

$respuesta = ReporteControlador::ctrMostrarTablaUtilidadTres($item,$valor,$fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

?>

<table class="table table-bordered table-striped dt-responsive tablas">

<thead>

 <tr>
   <th style="width:10px">#</th>
   <th>Nombre Usuario</th>
   <th>Nombre Cliente</th>
   <th>Utilidad Tres</th>
   <th>Fecha</th>
 </tr>

</thead>

<tbody>
  <?php

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

        $res = verifica_rango($fechaInicial, $fechaFinal, $p["fechaPagoClienteTarjeta"]);
        //var_dump($res);
       if($n == 0){

         if($res == "ok"){

           echo '<tr>

               <td>'.($key+1).'</td>

               <td>'.$value["nombre"].'</td>

               <td>'.$value["nombreCliente"].'</td>';

               if($fechaInicial == '1990-01-01'){
                  echo '<td>'.number_format($total - $dineroPrestado).'</td>';
               }else{
                  //var_dump($p["pagoClienteTarjeta"]);
                  echo '<td>'.number_format($total - $dineroPrestado).'</td>';
               }

               echo '<td>'.$p["fechaPagoClienteTarjeta"].'</td>

             </tr>';

             $n = 1;

         }

       }else{

         if($res == "ok"){

           echo '<tr>

               <td>'.($key+1).'</td>

               <td>'.$value["nombre"].'</td>

               <td>'.$value["nombreCliente"].'</td>

               <td>'.number_format($p["pagoClienteTarjeta"]).'</td>

               <td>'.$p["fechaPagoClienteTarjeta"].'</td>

             </tr>';

             $n = 1;

         }

       }

     }
   }

   $n = 0;

   $guardar = array();
   $guardarCobros = array();

  };


  function verifica_rango($date_inicio, $date_fin, $date_nueva) {
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

       echo '<tr>

           <td>'.($key+1).'</td>

           <td>'.$value["nombre"].'</td>

           <td>'.$value["nombreCliente"].'</td>

           <td style="background:#F2F8DD;">'.number_format($value["interes"]).'</td>';

           echo '<td>'.$value["fechaPagoClienteTarjeta"].'</td>

         </tr>';

     };

  ?>

</tbody>

</table>
