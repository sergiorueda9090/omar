<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$item = null;
$valor = null;

$respuesta = ReporteControlador::ctrUtilidadDos($fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

//var_dump($respuesta);
//$respuestaTotalInteres = ReporteControlador::ctrUtilidadDosInteres($item,$valor,$fechaInicial,$fechaFinal);

?>

<table class="table table-bordered table-striped dt-responsive tablas">

<thead>

 <tr>
   <th style="width:10px">#</th>
   <th>Nombre Usuario</th>
   <th>Nombre Cliente</th>
   <th>Utilidad Dos</th>
   <th>Fecha</th>
 </tr>

</thead>

<tbody>
  <?php

  foreach ($respuesta as $key => $values) {

    $respuestaDos = ReporteControlador::ctrUtilidadDosDos($fechaInicial,$fechaFinal,$values["id"]);

    $fecha = $fecha[0]["fechaIngresoCuota"];

    foreach ($respuestaDos as $keyDos => $value) {

      if($value["fechaIngresoCuota"] == '0000-00-00'){

      }else{

        $fecha = $value["fechaIngresoCuota"];

      }

      echo '<tr>

          <td>'.($keyDos+1).'</td>

          <td>'.$value["nombre"].'</td>

          <td>'.$value["nombreCliente"].'</td>';

            if($values["tipoPrestamoCliente"] == 'diario'){
                echo '<td>'.number_format(round(($values["interesMensualCliente"]/30))).'</td>';
            }else if($values["tipoPrestamoCliente"] == 'semanal'){
              echo '<td>'.number_format(($values["interesMensualCliente"]/4)).'</td>';
            }else if($values["tipoPrestamoCliente"] == 'quincenal'){
                echo '<td>'.number_format(($values["interesMensualCliente"]/2)).'</td>';
            }
            else{
              echo '<td>'.number_format($values["interesMensualCliente"]).'</td>';
            }

          echo '<td>'.$fecha.'</td>

        </tr>';
    }

  };

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
