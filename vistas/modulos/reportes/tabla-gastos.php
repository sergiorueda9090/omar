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

$respuesta = ReporteControlador::ctrMostrarTablaGasto($fechaInicial,$fechaFinal);

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

        <td>'.$value["usuario"].'</td>

        <td>'.$value["nombreGasto"].'</td>

        <td>'.number_format($value["valorGasto"]).'</td>

        <td>'.$value["fechaGasto"].'</td>

      </tr>';

  };

  ?>

</tbody>

</table>
