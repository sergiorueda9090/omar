<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Cobros

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Cobros</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group mt-5 mb-5" style="margin-bottom:40px;">

          <button type="button" class="btn btn-default" id="daterange-btn2">

            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

          </button>

        </div>

        <div class="box-tools pull-right" style="margin-top:40px;">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }

        ?>

           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

          <?php

          if(isset($_GET["fechaInicial"])){

            echo '<a href="vistas/modulos/reporteExcel/descargar-reporteUtilidades.php?reporte=reporteUtilidades&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

          }else{

             echo '<a href="vistas/modulos/reporteExcel/descargar-reporteUtilidades.php?reporte=reporteUtilidades">';

          }

          ?>

             <button class="btn btn-warning" style="margin-top:5px">Descargar reporte Utilidades</button>

            </a>

        </div>

      </div>

      <div class="box-body mt-5">

        <!--=====================================
              RESUMEN COBROS
        =======================================-->
        <div class="box box-danger" style="margin-top:40px;"></div>

        <div class="row">

          <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/resumenCobrosUno.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            //include "reportes/resumenCobrosDos.php";

            ?>

          </div>

        </div>



        <!--=====================================
              ADMINISTRADOR DE COBROS
        =======================================-->

        <div class="box box-success"></div>

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">COBRADORES </h1>
            <br>
          </div>

          <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/tabla-cobros.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            //include "reportes/grafica-cobradores.php";


            ?>

          </div>

           <div class="col-md-12 col-xs-12">

            <?php

            //include "reportes/grafico-ventas.php";

            ?>

           </div>

        </div>


        <div class="box box-warning"></div>

        <!--=====================================
              ADMINISTRADOR DE PRESTAMOS
        =======================================-->

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">PRESTAMOS</h1>
            <br>
          </div>

          <div class="col-md-12 col-xs-12">
              <?php
                include "reportes/tabla-prestamos.php";
              ?>
          </div>

          <div class="col-md-6 col-xs-12">
            <?php
              //include "reportes/grafica-prestamos.php";
            ?>
          </div>

           <div class="col-md-12 col-xs-12">
            <?php
              //include "reportes/estadistica-prestamos.php";
            ?>
           </div>

        </div>

        <div class="box box-primary"></div>

        <!--=====================================
              ADMINISTRADOR DE GASTOS
        =======================================-->

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">GASTOS</h1>
            <br>
          </div>


          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/tabla-gastos.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/grafica-gasto.php";


            ?>

          </div>

           <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/estadistica-gastos.php";

            ?>

           </div>

        </div>

        <div class="box box-danger"></div>

        <!--=====================================
              ADMINISTRADOR DE BILLETERA
        =======================================-->

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">BILLETERA</h1>
            <br>
          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/tabla-billetera.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/grafica-billetera.php";


            ?>

          </div>

           <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/estadistica-billetera.php";

            ?>

           </div>

        </div>

        <div class="box box-success"></div>

        <!--=====================================
              ADMINISTRADOR DE BANCO
        =======================================-->

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">BANCO</h1>
            <br>
          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/tabla-banco.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/grafica-banco.php";


            ?>

          </div>

           <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/estadistica-banco.php";

            ?>

           </div>

        </div>

        <div class="box box-warning"></div>

        <!--=====================================
              ADMINISTRADOR DE EFECTIVO
        =======================================-->

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">EFECTIVO</h1>
            <br>
          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/tabla-efectivo.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reportes/grafica-efectivo.php";


            ?>

          </div>

           <div class="col-md-12 col-xs-12">

            <?php

            include "reportes/estadistica-efectivo.php";

            ?>

           </div>

        </div>


        <!--=====================================
            UTILIDAD UNO
        =======================================-->

      <div class="box box-info"></div>

        <div class="row">

          <div class="col-md-12 col-xs-12 mt-2">
            <h1 class="text-center">UTILIDAD UNO</h1>
            <br>
          </div>

          <div class="col-md-6 col-xs-12">

            <?php
            echo '<center><h3>UTILIDAD UNO</h3></center>';
            include "reportes/utilidadTablaUno.php";

            ?>

          </div>

          <div class="col-md-6 col-xs-12">

            <?php
            echo '<center><h3>UTILIDAD UNO</h3></center>';
            include "reportes/estadistica-utilidadUno.php";

            ?>

          </div>

      </div>

      <!--=====================================
          FIN UTILIDAD UNO
      =======================================-->

      <!--=====================================
          UTILIDAD DOS
      =======================================-->

    <div class="box box-info"></div>

      <div class="row">

        <div class="col-md-12 col-xs-12 mt-2">
          <h1 class="text-center">UTILIDAD DOS</h1>
          <br>
        </div>

        <div class="col-md-6 col-xs-12">

          <?php
          echo '<center><h3>UTILIDAD DOS</h3></center>';
          include "reportes/utilidadTablaDos.php";

          ?>

        </div>

        <div class="col-md-6 col-xs-12">

          <?php
          echo '<center><h3>UTILIDAD DOS</h3></center>';
          include "reportes/estadistica-utilidadDos.php";

          ?>

        </div>

    </div>

    <!--=====================================
        FIN UTILIDAD DOS
    =======================================-->


    <!--=====================================
        UTILIDAD TRES
    =======================================-->

  <div class="box box-info"></div>

    <div class="row">

      <div class="col-md-12 col-xs-12 mt-2">
        <h1 class="text-center">UTILIDAD TRES</h1>
        <br>
      </div>

      <div class="col-md-6 col-xs-12">

        <?php
        echo '<center><h3>UTILIDAD TRES</h3></center>';
        include "reportes/utilidadTablaTres.php";

        ?>

      </div>

      <div class="col-md-6 col-xs-12">

        <?php
        echo '<center><h3>UTILIDAD TRES</h3></center>';
        include "reportes/estadistica-utilidadTres.php";

        ?>

      </div>

  </div>

  <!--=====================================
      FIN UTILIDAD TRES
  =======================================-->




    </div>

  </section>

 </div>
