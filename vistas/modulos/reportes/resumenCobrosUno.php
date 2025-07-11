
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

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$graficoCobrosPost = ReporteControlador::ctrGraficaCobradoresPost($fechaInicial,$fechaFinal);

$graficoPrestamosPost = ReporteControlador::ctrGraficaPrestamosPost($fechaInicial,$fechaFinal);


$graficoGastosPost = ReporteControlador::ctrGastoPost($fechaInicial,$fechaFinal);
$respuestaTablaGastosPost = ReporteControlador::ctrMostrarTablaGastoPost($fechaInicial,$fechaFinal);


$graficoEfectivoPost = ReporteControlador::ctrEfectivoPost($item,$valor,$fechaInicial,$fechaFinal);
$respuestaTablaEfectivoPost = ReporteControlador::ctrMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal);

$respuestaTablaBancoPost = ReporteControlador::ctrMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal);
$graficoBancoPost = ReporteControlador::ctrBancoPost($fechaInicial,$fechaFinal);


$respuestaTablaBilleteraPost = ReporteControlador::ctrMostrarReporteBilleteraPost($fechaInicial,$fechaFinal);
$graficoBilleteraPost = ReporteControlador::ctrBilleteraPost($fechaInicial,$fechaFinal);

?>
<form method="post" class="mb-5">

    <div class="form-group">

      <h4 style="font-size:30px;">SELECCIONAR USUARIO</h4>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <select class="form-control usuarioReporte" name="usuarioReporte">
          <option value="0" style="font-size:25px;">Seleccionar....</option>
          <?php
          foreach ($usuarios as $key => $value) {
            echo '<option value='.$value["id"].' style="font-size:25px;">'.$value["nombre"].'</option>';
          }
          ?>
        </select>
      </div>
    </div>

<div class="row">
    <div class="col-lg-6 col-sm-12">
      <button type="submit" class="btn btn-success btn-lg btn-block mb-5" style="margin-bottom:10px;">CALCULAR</button>
    </div>
    <div class="col-lg-6 col-sm-12">
      <button type="button" class="btn btn-danger btn-lg btn-block mb-5 btnCancelarUsuarioReporte" style="margin-bottom:30px;">CANCELAR</button>
    </div>
</div>

  <?php
    $graficoCobrosPost = ReporteControlador::ctrGraficaCobradoresPost($fechaInicial,$fechaFinal);
    $graficoPrestamosPost = ReporteControlador::ctrGraficaPrestamosPost($fechaInicial,$fechaFinal);

    $respuestaTablaGastosPost = ReporteControlador::ctrMostrarTablaGastoPost($fechaInicial,$fechaFinal);
    $graficoGastosPost = ReporteControlador::ctrGastoPost($fechaInicial,$fechaFinal);

    $graficoEfectivoPost = ReporteControlador::ctrEfectivoPost($item,$valor,$fechaInicial,$fechaFinal);
    $respuestaTablaEfectivoPost = ReporteControlador::ctrMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal);

    $respuestaTablaBancoPost = ReporteControlador::ctrMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal);
    $graficoBancoPost = ReporteControlador::ctrBancoPost($fechaInicial,$fechaFinal);

    $respuestaTablaBilleteraPost = ReporteControlador::ctrMostrarReporteBilleteraPost($fechaInicial,$fechaFinal);
    $graficoBilleteraPost = ReporteControlador::ctrBilleteraPost($fechaInicial,$fechaFinal);
  ?>

</form>

<div class="col-lg-12 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">USUARIO</h3>
    </div>

    <div class="box-body">
              <div class="row">
                <center>
                <h4 style="font-size:65px;" class="nombreUsuarioResposteMostrar"></h4>
                </center>
              </div>
    </div>


  </div>
</div>

<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">TOTAL COBROS SSSSS</h3>
    </div>
    <div class="box-body" style="padding:0px;">
      <div class="form-group row mt-5">
        <div class="col-sm-8 pull-left">
          <h4 class="pull-left" style="font-size:30px;">
            <?php
              $pilaCobrosPost = array();
                foreach ($graficoCobrosPost as $key => $valueCobrosPost) {
                        array_push($pilaCobrosPost,$valueCobrosPost["totalCobrado"]);
                }
                echo '$ '.number_format(array_sum($pilaCobrosPost));
            ?>
          </h4>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">TOTAL PRESTAMOS</h3>
    </div>
  <div class="box-body">
    <div class="form-group row mt-5">
      <div class="col-sm-8 pull-left">
        <h4 class="pull-left" style="font-size:30px;">
          <?php
          $pilaPrestamos = array();
            foreach ($graficoPrestamosPost as $key => $valuePrestamosPost) {
              //echo '$ '.number_format($valuePrestamosPost["totalPrestamo"]);
              array_push($pilaPrestamos,$valuePrestamosPost["totalPrestamo"]);
            }
            echo '$ '.number_format(array_sum($pilaPrestamos));
          ?>
        </h4>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">PAGOS EN BILLETERA</h3>
    </div>
  <div class="box-body" style="padding:0px;">
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

      foreach ($respuestaTablaBilleteraPost as $key => $value) {

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
        <h4 class="col-sm-5 col-form-label" style="font-size:25px;">SALDO BILLETERA</h4>
        <div class="col-sm-7">
          <h4 class="pull-right" style="font-size:30px;"><?php
          $pilaBilletera = array();
             foreach ($graficoBilleteraPost as $key => $value) {
               array_push($pilaBilletera,$value["totalBilletera"]);
             }
               echo number_format(array_sum($pilaBilletera));
          ?></h4>
        </div>
    </div>

  </div>
  </div>
  <div class="clearfix"></div>
</div>

<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">TOTAL GASTOS</h3>
    </div>
  <div class="box-body" style="padding:0px;">
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
      foreach ($respuestaTablaGastosPost as $key => $value) {
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
    <div class="form-group row">
        <h4 class="col-sm-5 col-form-label" style="font-size:25px;">SALDO GASTOS</h4>
        <div class="col-sm-7">
          <h4 class="pull-right" style="font-size:30px;"><?php
            $pila = array();
                    foreach ($graficoGastosPost as $key => $value) {
                      array_push($pila,$value["totalGasto"]);
                    }
                    echo number_format(array_sum($pila));
          ?></h4>
        </div>
    </div>
  </div>
  </div>
</div>


<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">PAGOS EN EFECTIVO</h3>
    </div>
  <div class="box-body" style="padding:0px;">
    <table class="table table-bordered table-striped dt-responsive">

    <thead>

     <tr>
       <th style="width:10px">#</th>
       <th>Nombre Usuario</th>
       <th>Nombre Efectivo</th>
       <th>Efectivo</th>
       <th>Fecha</th>
     </tr>

    </thead>

    <tbody>
      <?php

      foreach ($respuestaTablaEfectivoPost as $key => $value) {

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
        <h4 class="col-sm-5 col-form-label" style="font-size:25px;">SALDO EFECTIVO</h4>
        <div class="col-sm-7">
          <h4 class="pull-right" style="font-size:30px;"><?php
                   $pilaEfectivo = array();
                      foreach ($graficoEfectivoPost as $key => $value) {
                        array_push($pilaEfectivo,$value["totalEfectivo"]);
                      }
                    echo number_format(array_sum($pilaEfectivo));
          ?></h4>
        </div>
    </div>
  </div>
  </div>
</div>


<div class="col-lg-6 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">PAGOS EN BANCOS</h3>
    </div>
  <div class="box-body" style="padding:0px;">
    <table class="table table-bordered table-striped dt-responsive">

    <thead>

     <tr>
       <th style="width:10px">#</th>
       <th>Nombre Usuario</th>
       <th>Nombre Banco</th>
       <th>Banco</th>
       <th>Fecha</th>
     </tr>

    </thead>

    <tbody>
      <?php

      foreach ($respuestaTablaBancoPost as $key => $value) {

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
        <h4 class="col-sm-5 col-form-label" style="font-size:25px;">SALDO BANCOS</h4>
        <div class="col-sm-7">
          <h4 class="pull-right" style="font-size:30px;"><?php
          $pilaBanco = array();
             foreach ($graficoBancoPost as $key => $value) {
               array_push($pilaBanco,$value["totalBanco"]);
             }
           echo number_format(array_sum($pilaBanco));
          ?></h4>
        </div>
    </div>
  </div>
  </div>
</div>


<div class="col-lg-12 col-sm-12">
  <div class="box box-danger">
    <div class="box-header with-border">
     <h3 class="box-title" style="font-size:30px;">RESUMEN TOTAL</h3>
    </div>

    <div class="box-body">
              <div class="row">
                <center>
                <h4 style="font-size:65px;">
                  <?php echo '$ '.number_format((array_sum($pilaBilletera)+array_sum($pilaPrestamos)+
                                array_sum($pila)+array_sum($pilaBanco)+
                                array_sum($pilaEfectivo))-array_sum($pilaCobrosPost)); ?></h4>
                  </center>
              </div>

              <?php

              if(isset($_GET["fechaInicial"])){

                echo '<a class="rutaCobroTotalFecha" href="vistas/modulos/reporteExcel/excelResumenTotal.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

              }else{

                 echo '<a class="rutaCobroTotal" href="vistas/modulos/reporteExcel/excelResumenTotal.php?reporte=reporte&usuarioReporteTotal">';

              }

              ?>

                    <button class="btn btn-block btn-lg" style="text-decoration: none;
                                                                padding: 10px;
                                                                font-weight: 600;
                                                                font-size: 20px;
                                                                color: #ffffff;
                                                                background-color: #1883ba;
                                                                border-radius: 6px;
                                                                border: 0.6px solid #8692ea;">Descargar Resumen Total
                    </button>


             </a>

    </div>


  </div>
</div>
<div class="clearfix"></div>

<!--=====================================================
=====================================================-->
<script>

$(document).on('change','.usuarioReporte',function(){
  var usuarioReporte = $(".usuarioReporte").val();
  $('.rutaCobroTotal').attr('href', 'vistas/modulos/reporteExcel/excelResumenTotal.php?reporte=reporte&usuarioReporteTotal='+usuarioReporte);
  var capturarHfres = $(".rutaCobroTotalFecha").attr('href');
  console.log("capturarHfres ",capturarHfres);
  $(".rutaCobroTotalFecha").attr('href', capturarHfres+'&usuarioReporteTotal='+usuarioReporte);
})

</script>
