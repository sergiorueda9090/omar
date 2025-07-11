<style>

  /* Ocultar el cuadro de búsqueda */

  #mitablas_filter {

    display: none;

  }



  /* Ocultar el selector de cantidad de registros */

  #mitablas_length {

    display: block;

  }

</style>

<div class="content-wrapper">



  <section class="content-header">



    <h1>



      Administrar clientes

      <?php



      $respuesta = TarjetaCliente::ctrMostrarTarjetaCliente();



      $proximaFecha = TarjetaCliente::ctrMostrarProximaFecha();



      $saldoInversionValidarCero = ($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"])-$respuesta["interesTotalCliente"];



      if($saldoInversionValidarCero <= 0){



        if(isset($_GET["id"]) && !empty($_GET["id"])){



            $ssssss = 0;



            $respuestasaldoInversionValidarCero = TarjetaCliente::ctrMostrarTarjetaClienteActualizarInversion($_GET["id"], $ssssss);



        }





      }else{



        if(isset($_GET["id"]) && !empty($_GET["id"])){



            $respuestasaldoInversionValidarCero = TarjetaCliente::ctrMostrarTarjetaClienteActualizarInversion($_GET["id"], $saldoInversionValidarCero);



        }



       }



      //var_dump($proximaFecha);

      $u3 = 0;

      if($respuesta["cuotasDebe"] == 0){

            $total = ($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"])-$respuesta["interesTotalCliente"];

            if($total <= 0){

              $u3 = number_format($total*-1);

             }else{

                echo 0;

             }

        $idActualizarEstadoTarjeta = $_GET["id"];

        $estadoPago = 'PAGO';

        $actualizarEstadoTarjeta = TarjetaCliente::ctractualizarEstadoTarjeta($idActualizarEstadoTarjeta,$estadoPago);

      }else {

        $idActualizarEstadoTarjeta = $_GET["id"];

        if(isset($_GET["estado"])){

          $estadoPago = $_GET["estado"];

          $actualizarEstadoTarjeta = TarjetaCliente::ctractualizarEstadoTarjeta($idActualizarEstadoTarjeta,$estadoPago);

        }



      }

      ?>



    </h1>



    <ol class="breadcrumb">



      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



      <li class="active">Administrar clientes</li>



    </ol>



  </section>



  <section class="content">



    <div class="box">



      <div class="box-header with-border">





      </div>



      <div class="">



        <div class="row">



          <div class="col-sm-12 col-md-6 col-lg-6">



            <div class="box box-success">



              <div class="box-header text-center">



                <div class="col-lg-12" style="background:#fbf7f7;padding:10px;">

                  <h3 class="box-title text-center" style="font-size:29px;margin-bottom:5px;font-family:'Open Sans';color:#0169a5;">CLIENTE</h3>

                  <button type="button" class="btn btn-box-tool" style="float:right;" data-widget="collapse"><i class="fa fa-minus" style="color:#000000;"></i></button>

                </div>



                <div class="mt-2 mb-2 box-body">

                    <div class="row">

                        <div class="col-sm-12 col-md-6 col-lg-3 mt-2 mb-2">

                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#exampleModalPagarMonto" style="font-size:15px;margin-top:5px;margin-bottom:5px;font-family:'Open Sans';">Pagar Monto</button>

                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mt-2 mb-2">

                            <button type="button" class="btn btn-info btn-sm btn-block btnPagarInteresTarjeta" data-toggle="modal" data-target="#exampleModalPagarInteres" style="font-size:15px;margin-top:5px;margin-bottom:5px;font-family:'Open Sans';">Pagar Interes</button>

                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mt-2 mb-2">

                            <button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#exampleModalPagarSaldo" style="font-size:15px;margin-top:5px;margin-bottom:5px;font-family:'Open Sans';">Pagar Saldo</button>

                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mt-2 mb-2">

                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#exampleModalFechaProximoPago" style="font-size:15px;margin-top:5px;margin-bottom:5px;font-family:'Open Sans';">Proximo Pago</button>

                            <?php echo $proximaFecha["fechaCuota"]; ?>

                        </div>

                    </div>



                </div>





                <div class="mt-2 mb-2 box-body">

                    <div class="row">



                      <div class="col-12 mt-2 mb-2">

                          <button type="button" class="btn btn-primary btn-sm btn-block"  id="mostrarBtn"  style="font-size:15px;margin-top:5px;margin-bottom:5px;font-family:'Open Sans';">Agregar O Mostrar Nota</button>

                      </div>



                        <div class="col-12 mt-2 mb-2" id="divNota" style="display: none;">

                          <div class="form-group">

                            <label for="exampleFormControlTextarea1">NOTA</label>

                            <textarea class="form-control notaCliente" id="notaCliente" rows="3"><?php echo $respuesta['notaCliente']; ?></textarea>

                          </div>



                            <button id="ocultarBtnAgregarNota" type="button" class="btn btn-primary btn-sm btn-block ocultarBtnAgregarNota">Ocultar</button>

                        </div>



                    </div>

                </div>





              </div>



              <div class="box-body">



                <table class="table table-striped table-bordered" style="font-size:19px;font-family:'Open Sans';">



                  <tbody>



                    <tr>

                      <?php if($respuesta["cuotasDebe"] == 0){

                        echo'<th scope="row">Estado Credito</th>

                          <td id="estadoDelCredito" style="background:#84d663" class="text-center">

                            <strong id="cambioDeEstadoCredito">Cancelado</strong>

                          </td>

                        </tr>';

                      }else{

                          echo'<th scope="row">Estado Credito</th>

                            <td id="estadoDelCredito" style="background: #FFFF00" class="text-center">

                              <strong id="cambioDeEstadoCredito">Vigente</strong>

                            </td>

                          </tr>';

                      } ?>





                    <tr>

                    <th scope="row">Numero de la tarjeta</th>

                      <td style="text-align: center" class="bg-success">

                        <strong># <?php echo $respuesta["numeroTarjetaCliente"]; ?></strong>

                      </td>

                    </tr>



                    <tr>

                     <th scope="row">Nombre del cliente</th>

                      <td style="text-align: center" class="bg-success">

                       <strong><?php echo $respuesta["nombreCliente"]; ?></strong>

                      </td>

                    </tr>



                    <tr>

                      <th scope="row">Dinero prestado</th>

                      <td style="text-align: center" class="bg-success">

                        <strong><?php echo number_format($respuesta["dineroPrestadoCliente"]); ?></strong>

                      </td>

                    </tr>



                    <tr>

                     <th scope="row">Plazo prestamo</th>

                       <td style="text-align: center" class="bg-success">

                          <strong><?php echo number_format($respuesta["tiempoPrestamoCliente"]); ?></strong>

                       </td>

                    </tr>



                    <tr>

                     <th scope="row">% interes</th>

                      <td style="text-align: center" class="bg-success">

                       <strong><?php echo number_format($respuesta["interesPrestamoCliente"]); ?>%</strong>

                      </td>

                    </tr>



                    <tr>

                    <th scope="row">Valor cuota</th>

                      <td style="text-align: center" class="bg-success">

                        <strong><?php echo number_format($respuesta["valorCuota"]); ?></strong>

                      </td>

                    </tr>



                    <tr>

                    <th scope="row">Fecha del prestamo</th>

                      <td style="text-align: center" class="bg-success">

                        <strong><?php echo $respuesta["diaPrestamoCliente"]; ?></strong>

                      </td>

                    </tr>



                    <tr>

                      <th scope="row">Abono Total + intereses</th>

                      <td style="text-align: center"><?php echo number_format($respuesta["abonoTotalCliente"]+$respuesta["interesTotalCliente"]); ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Abono Total</th>

                      <td style="text-align: center"><?php echo number_format($respuesta["abonoTotalCliente"]); ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Saldo Total</th>

                      <td style="text-align: center"><?php  if($respuesta["cuotasDebe"] == 0){ echo 0; }else{echo number_format($respuesta["saldoTotalCliente"]-$respuesta["abonoTotalCliente"]);} ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Saldo A Inversion + Intereses</th>

                      <td style="text-align: center"><?php $total = number_format(($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"])-$respuesta["interesTotalCliente"]); if($total <= 0){echo 0; }else{ echo $total; } ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Intereses Pendientes</th>

                      <td style="text-align: center"><?php if($respuesta["cuotasDebe"] == 0){

                                                               echo 0;

                                                              }

                                                             else{

                                                               $total = ($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"]);

                                                                if($total <=0){echo number_format($respuesta["valorTotalInteresCliente"]+$total);

                                                              }else{

                                                                echo number_format($respuesta["valorTotalInteresCliente"]);

                                                               }

                                                             } ?>

                      </td>

                    </tr>



                    <tr>

                      <th scope="row">Cuotas Pagas</th>

                      <td style="text-align: center"><?php echo $respuesta["cuotasPagas"]; ?></td>

                    </tr>
                    



                    <tr>

                      <th scope="row">Cuotas Pendientes</th>

                      <td style="text-align: center"><?php echo $respuesta["cuotasDebe"]; ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Intereses</th>

                      <td style="text-align: center"><?php echo number_format($respuesta["interesTotalCliente"]); ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Utilidad Real 1</th>

                      <td style="text-align: center"><?php if($respuesta["cuotasDebe"] == 0){

                                                            echo $u3;

                                                          }else{

                                                           echo number_format($respuesta["valorTotalInteresCliente"]+$respuesta["interesTotalCliente"]);

                                                          } ?></td>

                    </tr>



                    <tr>

                      <th scope="row">Utilidad Real 2</th>

                      <td style="text-align: center"><?php if($respuesta["cuotasDebe"] == 0){

                                                            echo $u3;

                                                          }else{

                                                            if($respuesta["tipoPrestamoCliente"] == 'diario'){

                                                               echo number_format(round(($respuesta["interesMensualCliente"]/$respuesta["numeroCuotasCliente"])*$respuesta["cuotasPagas"]));

                                                             }else if($respuesta["tipoPrestamoCliente"] == 'quincenal'){

                                                               echo number_format(($respuesta["interesMensualCliente"]/2)*$respuesta["cuotasPagas"]);

                                                             }else if($respuesta["tipoPrestamoCliente"] == 'semanal'){

                                                               echo number_format(($respuesta["interesMensualCliente"]/4)*$respuesta["cuotasPagas"]);

                                                             }

                                                             else{

                                                               echo number_format(($respuesta["interesMensualCliente"]*$respuesta["cuotasPagas"])+$respuesta["interesTotalCliente"]);

                                                             }

                                                          }

                                  ?>

                      </td>

                    </tr>



                    <tr>

                      <th scope="row">Utilidad Real 3</th>

                      <td style="text-align: center"><?php if($respuesta["cuotasDebe"] == 0){

                                                                  $total = ($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"])-$respuesta["interesTotalCliente"];

                                                                  if($total <= 0){

                                                                    echo number_format($total*-1);

                                                                    $u3 = number_format($total*-1);

                                                                   }else{

                                                                      echo 0;

                                                                   }

                                                             }else{

                                                              $total = ($respuesta["dineroPrestadoCliente"]-$respuesta["abonoTotalCliente"])-$respuesta["interesTotalCliente"];

                                                              if($total <= 0){

                                                                echo number_format($total*-1);

                                                               }else{

                                                                  echo 0;

                                                               }

                                                             } ?></td>

                    </tr>



                  </tbody>



                </table>



              </div>



              <div class="box-footer">

                <small>Many more skins available. <a href="http://fronteed.com/iCheck/">Documentation</a></small>

              </div>



          </div>



          </div>



          <div class="col-sm-12 col-md-6 col-lg-6">



            <h3 class="text-center" style="font-size:32px;font-family:'Open Sans';color:#0169a5;"><?php echo $respuesta["nombreCliente"]; ?></h3>



            <table id="mitablas" class="table table-bordered table-striped dt-responsive tablas" style="font-size:15px;font-family:'Open Sans';">



             <thead>



              <tr>



                <th style="width:2px">#</th>

                <th style="width:43px">Fecha</th>

                <th style="width:43px">Valor</th>

                <th style="width:5px">Tipo</th>

                <th style="width:5px">Acciones</th>



              </tr>



             </thead>



             <tbody>



               <?php



                $respuestaDos = TarjetaCliente::ctrMostrarCuotasPagasTarjetaCliente();

                $catidadTotalCuotas = count($respuestaDos);

               foreach ($respuestaDos as $key => $value) {

                  echo '<tr>

                          <td>'.($key+1).'</td>

                          <td  style="font-size:12px;">'.$value["fechaPagoClienteTarjeta"].'</td>';

                          if($value["pagoClienteTarjeta"] == 0){

                            $valor = $value["valorInteresClienteTarjeta"];

                            echo '<td>'.number_format($valor).'</td>';

                            echo '<td style="background:#e6f1be85;color:#c59c08;text-align:center;margin:auto;font-family: Source Sans Pro, sans-serif;font-size: 17px;">INTERES</td>';

                            echo'<td>';

                            if($respuesta["cuotasDebe"] == 0){

                              echo '<center>

                                  <div class="btn-group" style="text-align:center;margin:auto;">

                                        <button class="btn btn-danger btnEliminarPagoInteres" disabled valorInteresSaldoInversion='.$valor.' idPagoCuotaInteres='.$value["idPagarTarjeta"].' style="text-align:center;margin:auto;"><i class="fa fa-times"></i></button>

                                  </div>

                              </center>

                            </td>';

                            }else{

                              echo '<center>

                                  <div class="btn-group" style="text-align:center;margin:auto;">

                                        <button class="btn btn-danger btnEliminarPagoInteres" valorInteresSaldoInversion='.$valor.' idPagoCuotaInteres='.$value["idPagarTarjeta"].' style="text-align:center;margin:auto;"><i class="fa fa-times"></i></button>

                                  </div>

                              </center>

                            </td>';

                            }



                          }else{

                            $valor = $value["pagoClienteTarjeta"];

                            echo '<td>'.number_format($valor).'</td>';

                            echo '<td style="background:#bbfedf;color:#04864a;text-align:center;margin:auto;font-family: Source Sans Pro, sans-serif;font-size: 17px;">CUOTA</td>';

                            echo'<td>';

                                if($respuesta["cuotasDebe"] == 0){

                                  echo '<center>

                                      <div class="btn-group" style="text-align:center;margin:auto;">

                                            <button class="btn btn-danger btnEliminarPagoCuota" idPagoCuota='.$value["idPagarTarjeta"].' valorCuota='.$respuesta["valorCuota"].' valorPagado='.$valor.' cantidadCuotas='.$catidadTotalCuotas.' style="text-align:center;margin:auto;"><i class="fa fa-times"></i></button>

                                      </div>

                                  </center>

                                </td>';

                              }else{

                                echo '<center>

                                    <div class="btn-group" style="text-align:center;margin:auto;">

                                          <button class="btn btn-danger btnEliminarPagoCuota" idPagoCuota='.$value["idPagarTarjeta"].' valorCuota='.$respuesta["valorCuota"].' valorPagado='.$valor.' cantidadCuotas='.$catidadTotalCuotas.' style="text-align:center;margin:auto;"><i class="fa fa-times"></i></button>

                                    </div>

                                </center>

                              </td>';

                              }



                          }





                  echo'</tr>';

               }



               ?>



             </tbody>



            </table>



          </div>



          <div class="col-sm-12 col-md-6 col-lg-6 mt-5">

            <br><br>

              <h3 class="text-center" style="font-size:32px;font-family:'Open Sans';color:#0169a5;">CLIENTES</h3>

            <table class="table table-bordered table-striped dt-responsive tablas mt-5" width="100%">



             <thead>



              <tr>



                <th style="width:10px">#</th>

                <th>Tarjeta</th>

                <th>Nombre</th>

                <th>Prestamo</th>

                <th>Estado</th>

                <th>Acciones</th>



              </tr>



             </thead>



             <tbody>



             <?php



               $item = null;

               $valor = null;

               $estado = 'ACTIVO';



               $clientes = ControladorClientes::ctrMostrarClientes($item, $valor,$estado);



               foreach ($clientes as $key => $value) {





                 echo '<tr>



                         <td>'.($key+1).'</td>



                         <td>'.$value["numeroTarjetaCliente"].'</td>



                         <td>'.$value["nombreCliente"].'</td>



                         <td>'.number_format($value["dineroPrestadoCliente"]).'</td>



                         <td style="background:#bbfedf;color:#04864a;text-align:center;margin:auto;font-family: Source Sans Pro, sans-serif;font-size: 17px;"><strong>ACTIVO</strong></td>



                         <td style="text-align:center;">



                           <div class="btn-group">';



                           if($_SESSION["perfil"] == "Administrador"){



                               echo '<button type="button" class="btn btn-outline-info"><a href="index.php?ruta=tarjetaCliente&id='.$value["id"].'&estado=ACTIVO"" style="position:relative; z-index:1"><i class="fa fa-calendar"></i></a></button>';

                               echo '';





                           }



                           echo '</div>



                         </td>



                       </tr>';



                 }



             ?>



             </tbody>



            </table>

          </div>



        </div>







      </div>



    </div>





    <!-- Modal pagar monto -->

<div class="modal fade" id="exampleModalPagarMonto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog" role="document">



    <div class="modal-content">



      <div class="modal-header" style="background:#28A745; color:white">



        <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">PAGAR MONTO 1</h5>



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>



      </div>



      <form method="post">



        <div class="modal-body">



            <div class="form-group">

              <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Ingresar pago:</label>

              <input type="text" class="form-control valorPagarTarjetaCliente" name="valorPagarTarjetaCliente" style="font-size:18px;">

            </div>



            <div class="form-group">

              <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Fecha:</label>

              <input type="date" class="form-control fechaTarjetaCliente" name="fechaTarjetaCliente" style="font-size:18px;">

            </div>



            <div class="form-group">

              <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">2 FECHA PROXIMO PAGO:</label>

              <input type="date" class="form-control fechaProximoTarjetaCliente" name="fechaProximoTarjetaCliente" value="<?php echo $proximaFecha["fechaCuota"]; ?>" style="font-size:18px;">

            </div>



            <div class="form-group" style="display:none;">

              <label for="recipient-name" class="col-form-label">id:</label>

              <input type="text" class="form-control idClienteTarjetaCliente" value="<?php echo $respuesta["idCliente"]; ?>" name="idClienteTarjetaCliente">

            </div>



            <div class="form-group" style="display:none;">

              <label for="recipient-name" class="col-form-label">VALOR DE LA CUOTA:</label>

              <input type="text" class="form-control valorCuotaTarjetaCliente" name="valorCuotaTarjetaCliente" value="<?php echo $respuesta["valorCuota"]; ?>" name="idClienteTarjetaCliente">

            </div>



            <input type="hidden" class="form-control" name="idClienteCuotaPagarMonto" value="<?php echo $proximaFecha["id"]; ?>" style="font-size:18px;font-family:'Open Sans';">



        </div>



        <div class="modal-footer">



          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:18px;font-family:'Open Sans';">Cerrar</button>

          <button type="submit" class="btn btn-success pagarMotonTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">Pagar Monto</button>



        </div>



    </form>



    <?php

      $pagoTarjeta = new TarjetaCliente();

      $pagoTarjeta -> ctrAgregarPagoTarjetaCliente();

      $pagoTarjeta -> ctrActualizarSaldoAInversion();

      $pagoTarjeta -> ctrActualizarProximaFechaPagarMonto();

    ?>



    </div>



  </div>



</div>







<!-- Modal pagar Interes -->

<div class="modal fade" id="exampleModalPagarInteres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<div class="modal-dialog" role="document">



<div class="modal-content">



  <div class="modal-header" style="background:#28A745; color:white">



    <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">PAGAR INTERES</h5>



    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

      <span aria-hidden="true">&times;</span>

    </button>



  </div>



  <form method="post">



    <div class="modal-body">



        <div class="form-group">

          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Ingresar intereses:</label>

          <input type="text" class="form-control valorInteresTarjetaCliente" name="valorInteresTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">

        </div>



        <div class="form-group">

          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Fecha:</label>

          <input type="date" class="form-control fechaInteresTarjetaCliente" name="fechaInteresTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">

        </div>



        <div class="form-group">

            <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Fecha proximo pago:</label>

            <input type="date" class="form-control fechaProximoTarjetaCliente" name="fechaProximoTarjetaCliente" value="<?php echo $proximaFecha["fechaCuota"]; ?>" style="font-size:18px;">

        </div>



        <div class="form-group" style="display:none;">

          <label for="recipient-name" class="col-form-label">id:</label>

          <input type="text" class="form-control idClienteInteresTarjetaCliente" value="<?php echo $respuesta["idCliente"]; ?>" name="idClienteInteresTarjetaCliente">

        </div>



        <input type="hidden" class="form-control" name="idClienteCuotaPagarMonto" value="<?php echo $proximaFecha["id"]; ?>" style="font-size:18px;font-family:'Open Sans';">

        

        <div class="form-group" style="display:none;">

              <label for="recipient-name" class="col-form-label">id:</label>

              <input type="text" class="form-control idClienteTarjetaCliente" value="<?php echo $respuesta["idCliente"]; ?>" name="idClienteTarjetaCliente">

        </div>



      

    </div>



    <div class="modal-footer">



      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:18px;">Cerrar</button>

      <button type="submit" class="btn btn-success" style="font-size:18px;">Pagar Interes</button>



    </div>



</form>



<?php

$interesTarjeta = new TarjetaCliente();

$interesTarjeta -> ctrAgregarInteresTarjetaCliente();

$interesTarjeta -> ctrActualizarProximaFechaPagarMonto();

?>



</div>



</div>



</div>





<!-- Modal pagar SALDO -->

<div class="modal fade" id="exampleModalPagarSaldo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<div class="modal-dialog" role="document">



<div class="modal-content">



  <div class="modal-header" style="background:#28A745; color:white">



    <h5 class="modal-title" id="exampleModalLabel" style="font-size:30px;font-family:'Open Sans';text-align:center;">PAGAR SALDO</h5>



    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

      <span aria-hidden="true">&times;</span>

    </button>



  </div>



  <form method="post">



    <div class="modal-body">



      <div class="form-group">

        <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Dinero Prestado:</label>

        <input type="text" class="form-control dineroPrestadoSaldoTarjetaCliente" name="dineroPrestadoSaldoTarjetaCliente" value="<?php echo number_format($respuesta["dineroPrestadoCliente"]); ?>" style="font-size:18px;font-family:'Open Sans';" readonly>

        <input type="hidden" class="form-control dineroPrestadoSaldoTarjetaClienteOculto" name="dineroPrestadoSaldoTarjetaClienteOculto" value="<?php echo $respuesta["dineroPrestadoCliente"]; ?>" style="font-size:18px;font-family:'Open Sans';">

      </div>



      <div class="form-group">

        <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Abono Cliente:</label>

        <input type="text" class="form-control abonoSaldoTarjetaCliente" name="abonoSaldoTarjetaCliente" value="<?php echo number_format($respuesta["abonoTotalCliente"]); ?>" style="font-size:18px;font-family:'Open Sans';" readonly>

        <input type="hidden" class="form-control abonoSaldoTarjetaClienteOculto" name="abonoSaldoTarjetaClienteOculto" value="<?php echo $respuesta["abonoTotalCliente"]; ?>" style="font-size:18px;font-family:'Open Sans';">

      </div>



      <div class="form-group">

        <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Interes %:</label>

        <input type="text" class="form-control interesSaldoTarjetaCliente" name="interesSaldoTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">

      </div>



      <div class="form-group">

        <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Tiempo:</label>

        <input type="text" class="form-control tiempoSaldoTarjetaCliente" name="tiempoSaldoTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">

      </div>



        <div class="form-group">

          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Saldo:</label>

          <input type="text" class="form-control tSaldoTarjetaCliente" name="tSaldoTarjetaCliente" style="font-size:18px;font-family:'Open Sans';" readonly>

        </div>



        <div class="form-group">

          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';">Fecha:</label>

          <input type="date" class="form-control fechaSaldoTarjetaCliente" name="fechaSaldoTarjetaCliente" style="font-size:18px;font-family:'Open Sans';">

        </div>



        <div class="form-group" style="display:none;">

          <label for="recipient-name" class="col-form-label">id:</label>

          <input type="text" class="form-control idClienteSaldoTotalTarjetaCliente" value="<?php echo $respuesta["idCliente"]; ?>" name="idClienteSaldoTotalTarjetaCliente">

          <input type="text" class="form-control pagoSaldoTotalCambio" value="<?php  if($respuesta["cuotasDebe"] == 0){ echo 0; }else{echo number_format($respuesta["saldoTotalCliente"]-$respuesta["abonoTotalCliente"]);} ?>" name="pagoSaldoTotalCambio">

        </div>





    </div>



    <div class="modal-footer">



      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:18px;">Cerrar</button>

      <button type="submit" class="btn btn-success" style="font-size:18px;">Pagar Saldo</button>



    </div>



</form>



<?php

$pagarSaldoTarjeta = new TarjetaCliente();

$pagarSaldoTarjeta -> ctrPagarSaldoTarjetaCliente();

?>



</div>



</div>



</div>







<!-- Modal PROXIMO PAGGO -->

<div class="modal fade" id="exampleModalFechaProximoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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

          <label for="recipient-name" class="col-form-label" style="font-size:24px;font-family:'Open Sans';text-align:center;">1 FECHA PROXIMO PAGO:</label>

          <input type="date" class="form-control" name="proximaFechaCliente" value="<?php echo $proximaFecha["fechaCuota"]; ?>" style="font-size:18px;font-family:'Open Sans';">

          <input type="hidden" class="form-control" name="idClienteCuota" value="<?php echo $proximaFecha["id"]; ?>" style="font-size:18px;font-family:'Open Sans';">

          <input type="hidden" class="form-control" name="idClienteCuotaFecha" value="<?php echo $respuesta["idCliente"]; ?>" style="font-size:18px;font-family:'Open Sans';">

          <input type="hidden" class="form-control idClienteTarjetaCliente" value="<?php echo $respuesta["idCliente"]; ?>" name="idClienteTarjetaCliente">

        </div>





    </div>



    <div class="modal-footer">



      <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:18px;">Cerrar</button>

      <button type="submit" class="btn btn-success" style="font-size:18px;">Actualizar Fecha</button>



    </div>



</form>



<?php



  $agregarProximaFecha = new TarjetaCliente();

  $agregarProximaFecha -> ctrActualizarProximaFecha();



?>



</div>



</div>



</div>





  </section>



</div>



<?php

$eliminarPagoTarjeta = new TarjetaCliente();

$eliminarPagoTarjeta -> ctrEliminarpagosTarjeta();

?>





<?php

$eliminarPagoInteres = new TarjetaCliente();

$eliminarPagoInteres -> ctrEliminarPagosInteres();

?>



<script>

  document.addEventListener("DOMContentLoaded", function () {

    // Seleccionamos la tabla

    const tabla = document.getElementById("mitablas");



    // Añadimos un evento de clic a la tabla

    tabla.addEventListener("click", function (event) {

      // Comprobamos si el elemento clickeado es un <td>

      if (event.target.tagName === "TD") {

        // Eliminamos el contenido del <td>

        event.target.innerHTML = "";

      }

    });

  });

  

</script>