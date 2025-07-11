<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ReporteControlador::ctrDescargarReporteExcelUtilidad($fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

?>

<table class="table table-bordered table-striped dt-responsive tablas">

<thead>

 <tr>
   <th style="width:10px">#</th>
   <th>Nombre Usuario</th>
   <th>Nombre Cliente</th>
   <th>Utilidad Uno</th>
   <th>Fecha</th>
 </tr>

</thead>

<tbody>
  <?php

  foreach ($respuesta as $key => $value) {

    echo '<tr>

        <td>'.($key+1).'</td>

        <td>'.$value["nombre"].'</td>

        <td>'.$value["nombreCliente"].'</td>

        <td>'.number_format($value["valorTotalInteresCliente"]).'</td>';

        echo '<td>'.$value["fechaPrestamoCliente"].'</td>

      </tr>';

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
