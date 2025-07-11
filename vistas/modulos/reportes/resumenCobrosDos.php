

<div class="box box-danger"></div>

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

$respuestaTablaEfectivo = ReporteControlador::ctrMostrarReporteEfectivo($item,$valor,$fechaInicial,$fechaFinal);
$graficoEfectivo = ReporteControlador::ctrEfectivo($fechaInicial,$fechaFinal);

$respuestaTablaBanco = ReporteControlador::ctrMostrarReporteBanco($item,$valor,$fechaInicial,$fechaFinal);
$graficoBanco = ReporteControlador::ctrBanco($fechaInicial,$fechaFinal);


$respuestaTablaBilletera = ReporteControlador::ctrMostrarReporteBilletera($fechaInicial,$fechaFinal);
$graficoBilletera = ReporteControlador::ctrBilletera($fechaInicial,$fechaFinal);

?>


  <div class="form-group row">
      <h4 class="col-sm-3 col-form-label">PAGOS EN EFECTIVO</h4>
      <div class="col-sm-9">
        <table class="table table-bordered table-striped dt-responsive">

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

          foreach ($respuestaTablaEfectivo as $key => $value) {

            echo '<tr>

                <td>'.($key+1).'</td>

                <td>'.$value["nombre"].'</td>

                <td>'.$value["nombreEfectivo"].'</td>

                <td>'.number_format($value["valorEfectivo"]).'</td>

                <td>'.$value["fechaEfectivo"].'</td>

              </tr>';

          };

          ?>

        </tbody>

        </table>

        <div class="form-group row">
            <h4 class="col-sm-5 col-form-label">SALDO EFECTIVO</h4>
            <div class="col-sm-7">
              <h4><?php
                       $pilaEfectivo = array();
                          foreach ($graficoEfectivo as $key => $value) {
                            array_push($pilaEfectivo,$value["totalEfectivo"]);
                          }
                        echo number_format(array_sum($pilaEfectivo));
              ?></h4>
            </div>
        </div>

      </div>

  </div>

  <div class="form-group row">
      <h4 class="col-sm-3 col-form-label">PAGOS EN BANCOS</h4>
      <div class="col-sm-9">
        <table class="table table-bordered table-striped dt-responsive">

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

          foreach ($respuestaTablaBanco as $key => $value) {

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

        <div class="form-group row">
            <h4 class="col-sm-5 col-form-label">SALDO BANCOS</h4>
            <div class="col-sm-7">
              <h4><?php
              $pilaBanco = array();
                 foreach ($graficoBanco as $key => $value) {
                   array_push($pilaBanco,$value["totalBanco"]);
                 }
               echo number_format(array_sum($pilaBanco));
              ?></h4>
            </div>
        </div>

      </div>

  </div>

  <div class="form-group row">
      <h4 class="col-sm-3 col-form-label">PAGOS EN BILLETERA</h4>
      <div class="col-sm-9">
        <table class="table table-bordered table-striped dt-responsive">

        <thead>

         <tr>
           <th style="width:10px">#</th>
           <th>Nombre Usuario</th>
           <th>Nombre Billetera</th>
           <th>Billetera</th>
           <th>Fecha</th>
         </tr>

        </thead>

        <tbody>
          <?php

          foreach ($respuestaTablaBilletera as $key => $value) {

            echo '<tr>

                <td>'.($key+1).'</td>

                <td>'.$value["nombre"].'</td>

                <td>'.$value["nombreBilletera"].'</td>

                <td>'.number_format($value["valorBilletera"]).'</td>

                <td>'.$value["fechaBilletera"].'</td>

              </tr>';

          };

          ?>

        </tbody>

        </table>

        <div class="form-group row">
            <h4 class="col-sm-5 col-form-label">SALDO BILLETERA</h4>
            <div class="col-sm-7">
              <h4 class="pull-right"><?php
              $pilaBilletera = array();
                 foreach ($graficoBilletera as $key => $value) {
                   array_push($pilaBilletera,$value["totalBilletera"]);
                 }
               echo number_format(array_sum($pilaBilletera));
              ?></h4>
            </div>
        </div>


      </div>


  </div>
