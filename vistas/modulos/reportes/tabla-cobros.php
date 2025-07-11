<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}
  if(isset($_SESSION["idUsuarioSession"])){
    echo "@wwww ".$_SESSION["idUsuarioSession"];
    $respuesta = ReporteControlador::ctrMostrarReportePagosUnique($fechaInicial,$fechaFinal,$_SESSION["idUsuarioSession"]);
  }else{
    $respuesta = ReporteControlador::ctrMostrarReportePagos($fechaInicial,$fechaFinal);
  }

?>

<table class="table table-bordered table-striped dt-responsive tablas">

<thead>

 <tr>
   <th style="width:10px">#</th>
   <th>Nombre Cobrado</th>
   <th>Nombre Cliente</th>
   <th>Cobro</th>
   <th>Fecha</th>
 </tr>

</thead>

<tbody>
  <?php

  foreach ($respuesta as $key => $value) {

    echo '<tr>

        <td>'.($key+1).'</td>

        <td>'.$value["nombre"].'</td>

        <td>'.$value["nombreCliente"].'</td>';

        $p = $value["pagoClienteTarjeta"];

        if($p == 0){

          if($value["valorInteresClienteTarjeta"] != 0){

            echo'<td style="background:#F2F8DD;">'.number_format($value["valorInteresClienteTarjeta"]).'</td>';

          }

        }else{

            echo'<td>'.number_format($value["pagoClienteTarjeta"]).'</td>';

        }

        echo'<td>'.$value["fechaPagoClienteTarjeta"].'</td>

      </tr>';

  };

  ?>

</tbody>

</table>
