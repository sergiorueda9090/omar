
<?php
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d");
var_dump($hoy);
?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Cobros del dia

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Cobros del dia</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border" style="margin-bottom:15px;">
        <div class="box-tools pull-right">
          <a href="vistas/modulos/reporteExcel/descargar-reporteCobroHoy.php">
            <button class="btn btn-success">Descargar Cobros del dia</button>
          </a>
        </div>
      </div>

      <div class="box-body">

       <table class="table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Numero Tarjeta</th>
           <th>Fecha Cobro</th>
           <th>Nombre Cliente</th>
           <th>Valor Cuota</th>
           <th>Accion</th>

         </tr>

        </thead>

        <?php
        //var_dump($hoy);
        $respuesta = ControladorCobrosDelDia::crtMostrarCobrosDelDia();
        //var_dump($respuesta);

        ?>

        <tbody>
          <?php

          foreach ($respuesta as $key => $value) {

            $fecha_formateada = date("Y-m-d", strtotime($value['fechaCuota']));
            //echo $fecha_formateada;
            if($fecha_formateada <= $hoy){

              echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["numeroTarjetaCliente"].'</td>

                    <td>'.$value['fechaCuota'].'</td>

                    <td>'.$value['nombreCliente'].'</td>

                    <td>'.number_format($value['valorCuota']).'</td>

                    <td>
                      <button type="button" class="btn btn-outline-info btn-lg btn-block">
                            <a href="index.php?ruta=tarjetaCliente&id='.$value["id"].'&estado='.$value["estadoCliente"].'""
                               style="position:relative; z-index:1">
                               <i class="fa fa-calendar"></i>
                             </a>
                      </button>
                      <button type="button" class="btn btn-danger btn-sm btn-block cobroDelDiaInfo"
                                                  data-toggle="modal"
                                                  fecha='.$value["fechaCuota"].'
                                                  idClienteCuota='.$value[0].'
                                                  idClienteCuotaFecha='.$value["id"].'
                                                  data-target="#exampleModalFechaProximoPagoCobroDelDia" >
                          Proximo Pago
                      </button>
                  </td>



                  </tr>';
                  # href="index.php?ruta=tarjetaCliente&id='.$value["id"].'&estado='.$value["estadoCliente"].'""
            }

          }

          ?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL PROXIMO PAGGO
======================================-->
<div class="modal fade" id="exampleModalFechaProximoPagoCobroDelDia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

<div class="modal-content">

  <div class="modal-header" style="background:#28A745; color:white">

    <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">PROXIMO PAGO</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

  </div>

  <form method="post">

    <div class="modal-body">


        <div class="form-group">
          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';text-align:center;">FECHA PROXIMO PAGO:</label>
          <input type="date" class="form-control proximaFechaClienteCobro"   name="proximaFechaCliente" value="" style="font-size:18px;font-family:'Open Sans';">
          <input type="hidden" class="form-control idClienteCuotaCobro"      name="idClienteCuota" value="" style="font-size:18px;font-family:'Open Sans';">

          <input type="hidden" class="form-control idClienteCuotaFechaCobro" name="idClienteCuotaFecha" value="" style="font-size:18px;font-family:'Open Sans';">
          <input type="hidden" class="form-control idClienteCuotaFechaCobro" name="idClienteTarjetaCliente" value="" style="font-size:18px;font-family:'Open Sans';">

          <input type="hidden" class="form-control clienteCuotacobroDelDia"  name="clienteCuotacobroDelDia" value="cobroDelDia" style="font-size:18px;font-family:'Open Sans';">
        </div>


    </div>

    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:18px;">Cerrar</button>
      <button type="submit" class="btn btn-success" style="font-size:18px;">Actualizar Fecha</button>

    </div>

</form>

<?php

  $agregarProximaFecha = new TarjetaCliente();
  $agregarProximaFecha -> ctrActualizarProximaFechaCobrosDia();

?>

</div>

</div>

</div>
<!--=====================================
end MODAL PROXIMO PAGGO
======================================-->


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

      </form>

    </div>

  </div>

</div>
