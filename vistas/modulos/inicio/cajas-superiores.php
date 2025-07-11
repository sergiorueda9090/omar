<?php

$respuesta = InicioControlador::ctrInicioDatos();
$respuestaCobros = InicioControlador::ctrInicioDatosCobros();
$porcentajeInteres = InicioControlador::ctrPorcentajeActivos();

?>

<div class="col-lg-4 col-xs-12 col-sm-12">

  <div class="small-box bg-green">

    <div class="inner">

      <h3>$ <?php echo number_format($respuesta[0]["saldoAInversionCasita"]); ?> </h3>

      <p>Saldo A Inversion</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="reportes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-12 col-sm-12">

  <div class="small-box bg-green">

    <div class="inner">

      <h3>$ <?php echo number_format($respuesta[0]["saldoTotalCasita"]); ?></h3>

      <p>Saldo Total</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="reportes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>


<!--==============================================
SALDO A INVERSION
==============================================-->

<div class="col-lg-2 col-xs-6 col-sm-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3># <?php echo number_format($respuesta[0]["cantidadUsuarioReporte"]); ?></h3>

      <p>Clientes</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="reportes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-2 col-xs-6 col-sm-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($porcentajeInteres["promedio"]) ?> %</h3>
      <p>Porcentaje Promedio</p>

    </div>

    <div class="icon">

      <i class="fa fa-percent"></i>

    </div>

    <a href="reportes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-blue">

    <div class="inner">

      <h3># <?php echo $respuesta[0]["mensual"]; ?></h3>
      <p>Saldo a Inversion</p>
      <h3>$ <?php echo number_format($respuesta[0]["saldoAInversionCasitaMensual"]); ?></h3>
      <p>Saldo Total</p>
      <h3>$ <?php echo number_format($respuesta[0]["saldoTotalCasitaMensual"]); ?></h3>
       <p>Clientes Mensuales</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-blue">

    <div class="inner">

  <h3># <?php echo $respuesta[0]["quincenal"]; ?></h3>
  <p>Saldo a Inversion</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoAInversionCasitaQuincenal"]); ?></h3>
  <p>Saldo Total</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoTotalCasitaQuincenal"]); ?></h3>
   <p>Clientes Quincenal</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-blue">

    <div class="inner">

  <h3># <?php echo $respuesta[0]["semanal"]; ?></h3>
  <p>Saldo a Inversion</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoAInversionCasitaSemanal"]); ?></h3>
  <p>Saldo Total</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoTotalCasitaSemanal"]); ?></h3>
   <p>Clientes Semanal</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-12">

  <div class="small-box bg-blue">

    <div class="inner">

  <h3># <?php echo $respuesta[0]["diario"]; ?></h3>
  <p>Saldo a Inversion</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoAInversionCasitaDiario"]); ?></h3>
  <p>Saldo Total</p>
  <h3>$ <?php echo number_format($respuesta[0]["saldoTotalCasitaDiario"]); ?></h3>
  <p>Clientes Diario</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<!--==============================================
FIN SALDO A INVERSION
==============================================-->



<!--==============================================
CLIENTES MOROSOS
==============================================-->

 <div class="col-lg-6 col-xs-12">

  <div class="small-box bg-orange">

    <div class="inner">

     <h3># <?php echo number_format($respuesta[0]['cantidadMoroso']); ?></h3>

      <h3>$ <?php echo number_format($respuesta[0]['dineroMoroso']); ?></h3>

      <h4>Clientes morosos saldo a Inversion</h4>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="clientesMorosos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

    </div>

<div class="col-lg-6 col-xs-12">

  <div class="small-box bg-orange">

    <div class="inner">


      <h3># <?php echo number_format($respuesta[0]['cantidadMoroso']); ?></h3>

       <h3>$ <?php echo number_format($respuesta[0]['saldoTotalMoroso']); ?></h3>

      <h4>Clientes morosos saldo Total</h4>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="clientesMorosos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

    </div>



<!--==============================================
FIN CLIENTES MOROSOS
==============================================-->

<!--==============================================
CLIENTES PERDIDOS
==============================================-->

 <div class="col-lg-6 col-xs-12">

  <div class="small-box bg-red">

    <div class="inner">

      <h3># <?php echo number_format($respuesta[0]['cantidadPerdido']); ?></h3>

       <h3>$ <?php echo number_format($respuesta[0]['dineroPerdido']); ?></h3>

      <h4>Clientes Perdidos saldo a la inversión</h4>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="clientesPerdidos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

    </div>

<div class="col-lg-6 col-xs-12">

  <div class="small-box bg-red">

    <div class="inner">


      <h3># <?php echo number_format($respuesta[0]['cantidadPerdido']); ?></h3>

       <h3>$ <?php echo number_format($respuesta[0]['saldoTotalPerdido']); ?></h3>

      <h4>Clientes Perdidos saldo a Total</h4>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="clientesPerdidos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

    </div>


<!--==============================================
FIN CLIENTES PERDIDOS
==============================================-->
