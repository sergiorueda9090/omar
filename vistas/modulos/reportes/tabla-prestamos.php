<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $respuesta = ReporteControlador::ctrMostrarTablaPrestamosPost($fechaInicial,$fechaFinal,$_POST['usuarioReporte']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $respuesta = ReporteControlador::ctrMostrarTablaPrestamos($fechaInicial,$fechaFinal);
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

        <td>'.$value["nombreCliente"].'</td>

        <td>'.number_format($value["dineroPrestadoCliente"]).'</td>

        <td>'.$value["fechaPrestamoCliente"].'</td>

      </tr>';

  };

  ?>

</tbody>

</table>
