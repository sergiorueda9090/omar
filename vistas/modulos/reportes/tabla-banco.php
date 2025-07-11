<?php

$item = null;
$valor = null;

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ReporteControlador::ctrMostrarReporteBanco($item,$valor,$fechaInicial,$fechaFinal);

?>

<table class="table table-bordered table-striped dt-responsive tablas">

<thead>

 <tr>
   <th style="width:10px">#</th>
   <th>Nombre Usuario</th>
   <th>Nombre Gasto</th>
   <th>Gasto</th>
   <th>Fecha</th>
 </tr>

</thead>

<tbody>
  <?php

  foreach ($respuesta as $key => $value) {

    echo '<tr>

        <td>'.($key+1).'</td>

        <td>'.$value["nombre"].'</td>

        <td>'.$value["nombreBanco"].'</td>

        <td>'.number_format($value["valorBanco"]).'</td>

        <td>'.$value["fechaBanco"].'</td>

      </tr>';

  };

  ?>

</tbody>

</table>
