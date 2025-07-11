<?php



if($_SESSION["perfil"] == "Especial"){



  echo '<script>



    window.location = "inicio";



  </script>';



  return;



}



?>



<div class="content-wrapper">



  <section class="content-header">



    <h1>



      Administrar clientes



    </h1>



    <ol class="breadcrumb">



      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



      <li class="active">Administrar clientes</li>



    </ol>



  </section>



  <section class="content">



    <div class="box">



      <div class="box-header with-border">



        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCliente">



          Agregar cliente



        </button>



        <button class="btn btn-success" data-toggle="modal" data-target="#modalCalculadora">



          CALCULADORA



        </button>



      </div>



      <div class="box-body">



       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">



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



                      <div class="btn-group">



                        <button class="btn btn-success btnInformeCliente" data-toggle="modal" data-target="#modalInformacionCliente" idCliente="'.$value["id"].'"><i class="fa fa-user"></i></button>

                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';



                      if($_SESSION["perfil"] == "Administrador"){



                          echo '<button type="button" class="btn btn-outline-info"><a href="index.php?ruta=tarjetaCliente&id='.$value["id"].'&estado=ACTIVO"" style="position:relative; z-index:1"><i class="fa fa-calendar"></i></a></button>';

                          echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';





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



  </section>



</div>



<!--=====================================

MODAL AGREGAR CLIENTE

======================================-->



<div id="modalAgregarCliente" class="modal fade" role="dialog" style="font-size:15px;font-family:'Open Sans';">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">



      <form role="form" method="post">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header success" style="background:#28A745; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Agregar cliente</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">







            <div class="row">



                  <!-- NUMERO DE LA TARJETA -->

                <div class="col-12 col-sm-12 col-md-6">



                  <div class="form-group">



                    <label for="">NUMERO DE LA TARJETA</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>



                      <input type="numer" autocomplete="off" class="form-control input-lg numeroTarjetaCliente" name="numeroTarjetaCliente" placeholder="Ingresar Numero Tarjeta" required>



                    </div>



                  </div>



                </div>





                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="col-12 col-sm-12 col-md-6">



                  <div class="form-group">



                    <label for="">NOMBRE</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-user"></i></span>



                      <input type="text" autocomplete="off" class="form-control input-lg nombreCliente" name="nombreCliente" placeholder="Ingresar nombre" required>



                    </div>



                  </div>



                </div>



                <!--<div class="col-12 col-sm-12 col-md-6">-->



                  <!-- SELECCIONAR ZONA -->



                <!--  <div class="form-group">



                    <label for="">SELECCIONAR ZONA</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-building"></i></span>



                      <select class="form-control zonaPrestamoCliente" name="zonaPrestamoCliente">

                        <option value="0">Seleccionar zona</option>

                        <option value="norte">Norte</option>

                        <option value="sur">Sur</option>

                        <option value="centro">Centro</option>

                        <option value="occidente">Occidente</option>

                        <option value="oriente">Oriente</option>

                      </select>



                    </div>



                  </div>



                </div>-->



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- PRESTAMO DINERO -->



                  <div class="form-group">



                    <label for="">PRESTAMO DINERO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-money"></i></span>



                      <input type="text" autocomplete="off" class="form-control input-lg dineroPrestadoCliente" name="dineroPrestadoCliente" placeholder="Dinero Prestado" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- INTERES -->



                  <div class="form-group">



                    <label for="">INTERES</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>



                      <input type="number" autocomplete="off" class="form-control input-lg interesPrestamoCliente" name="interesPrestamoCliente" placeholder="% Interes" required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6">



                  <!-- TIEMPO PRESTAMO -->



                  <div class="form-group">



                    <label for="">TIEMPO PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" autocomplete="off" class="form-control input-lg tiempoPrestamoCliente" name="tiempoPrestamoCliente" placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- TIPO PRESTAMO -->

                  <div class="form-group">



                    <label for="">TIPO PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <select class="form-control tipoPrestamoCliente" name="tipoPrestamoCliente">

                        <option value="0">Tipo Del Prestamo</option>

                        <option value="diario">Diario</option>

                        <option value="semanal">Semanal</option>

                        <option value="quincenal">Quincenal</option>

                        <option value="mensual">Mensual</option>

                      </select>



                    </div>



                  </div>



                </div>



                <!--==================================

                   SELECCIONAR COBROS QUINCENALES

                 ==================================-->

                 <div class="col-12 col-sm-12 col-md-6 mostrarPrimerQuincena" style="display:none;">



                   <!-- DIA DEL PRESTAMO -->



                   <div class="form-group">



                     <label for="">PRIMER COBRO QUINCENAL</label>



                     <div class="input-group">



                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                       <input type="date" class="form-control input-lg primerCobroQuincenalCliente" name="primerCobroQuincenalCliente" placeholder="Tiempo Prestamo">



                     </div>



                   </div>



                 </div>



                 <div class="col-12 col-sm-12 col-md-6 mostrarSundaQuincena" style="display:none;">



                   <!-- DIA DEL PRESTAMO -->



                   <div class="form-group">



                     <label for="">SUGUNDO COBRO QUINCENAL</label>



                     <div class="input-group">



                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                       <input type="date" class="form-control input-lg segundoCobroQuincenalCliente" name="segundoCobroQuincenalCliente" placeholder="Tiempo Prestamo">



                     </div>



                   </div>



                 </div>

                 <!--==================================

                    FIN SELECCIONAR COBROS QUINCENALES

                  ==================================-->





                  <!--==================================

                     SELECCIONAR COBROS SEMANAL

                   ==================================-->

                   <div class="col-12 col-sm-12 col-md-6 mostrarCobroSemanal" style="display:none;">



                     <!-- DIA DEL PRESTAMO -->



                     <div class="form-group">



                       <label for="">PRIMER COBRO SEMANAL</label>



                       <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                         <input type="date" class="form-control input-lg primerCobroSemanal" name="primerCobroSemanal">



                       </div>



                     </div>



                   </div>



                   <div class="col-12 col-sm-12 col-md-6 mostrarCobroSemanal" style="display:none;">



                     <!-- DIA DEL PRESTAMO -->



                     <div class="form-group">



                       <label for="">SEGUNDO COBRO SEMANAL</label>



                       <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                         <input type="date" class="form-control input-lg segundaCobroSemanal" name="segundaCobroSemanal">



                       </div>



                     </div>



                   </div>



                   <div class="col-12 col-sm-12 col-md-6 mostrarCobroSemanal" style="display:none;">



                     <!-- DIA DEL PRESTAMO -->



                     <div class="form-group">



                       <label for="">TERCERO COBRO SEMANAL</label>



                       <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                         <input type="date" class="form-control input-lg terceroCobroSemanal" name="terceroCobroSemanal">



                       </div>



                     </div>



                   </div>



                   <div class="col-12 col-sm-12 col-md-6 mostrarCobroSemanal" style="display:none;">



                     <!-- DIA DEL PRESTAMO -->



                     <div class="form-group">



                       <label for="">CUARTO COBRO SEMANAL</label>



                       <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                         <input type="date" class="form-control input-lg cuartoCobroSemanal" name="cuartoCobroSemanal">



                       </div>



                     </div>



                   </div>

                   <!--==================================

                      FIN COBROS SEMANAL

                    ==================================-->





                <div class="col-12 col-sm-12 col-md-6">



                  <!-- DIA DEL PRESTAMO -->



                  <div class="form-group">



                    <label for="">FECHA DEL PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" autocomplete="off" class="form-control input-lg diaPrestamoCliente" name="diaPrestamoCliente" placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- DIA DEL COBRO -->



                  <div class="form-group">



                    <label for="">DIA DEL COBRO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" autocomplete="off" class="form-control input-lg diaCobroPrestamoCliente" name="diaCobroPrestamoCliente" placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- FECHA DEL PRESTAMO -->



                  <div class="form-group">



                    <label for="">FECHA DEL PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" autocomplete="off" class="form-control input-lg fechaPrestamoCliente" name="fechaPrestamoCliente" placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- FECHA FIN PRESTAMO -->



                  <div class="form-group">



                    <label for="">Fecha Fin Prestamo</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="text" value="11/05/2021" class="form-control input-lg fechaFinPrestamoCliente" name="fechaFinPrestamoCliente" placeholder="Tiempo Prestamo">



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6">



                  <!-- Interes Mensual -->



                  <div class="form-group">



                    <label for="">Interes Mensual</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input autocomplete="off" type="text" class="form-control input-lg interesMensualCliente" name="interesMensualCliente" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- Nº Cuotas -->



                  <div class="form-group">



                    <label for="">Nº Cuotas</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input autocomplete="off" type="text" class="form-control input-lg numeroCuotasCliente" name="numeroCuotasCliente" required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6">



                  <!-- Valor de la Cuota -->



                  <div class="form-group">



                    <label for="">Valor de la Cuota</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input autocomplete="off" type="text" class="form-control input-lg valorCuotaCliente" name="valorCuotaCliente" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6">



                  <!-- Valor Total de Interes -->



                  <div class="form-group">



                    <label for="">Valor Total de Interes</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input autocomplete="off" type="text" class="form-control input-lg valorTotalInteresCliente" name="valorTotalInteresCliente"  required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6">



                  <!-- Saldo Total a Pagar -->



                  <div class="form-group">



                    <label for="">Saldo Total a Pagar</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg saldoTotalPagarCliente" name="saldoTotalPagarCliente" required>

                      <input type="hidden" class="form-control input-lg fechasTotalesCliente" name="fechasTotalesCliente" required>



                    </div>



                  </div>



                </div>



            </div>





          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-success">Guardar cliente</button>



        </div>



      </form>



      <?php



        $crearCliente = new ControladorClientes();

        $crearCliente -> ctrCrearCliente();



      ?>



    </div>



  </div>



</div>



<!--=====================================

MODAL EDITAR CLIENTE

======================================-->



<div id="modalEditarCliente" class="modal fade" role="dialog">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">



      <form role="form" method="post">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header success" style="background:#28A745; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Editar cliente</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">







            <div class="row">



                  <!-- NUMERO DE LA TARJETA -->

                <div class="col-12 col-sm-12 col-md-6">



                  <div class="form-group">



                    <label for="">NUMERO DE LA TARJETA</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>



                      <input type="numer" class="form-control input-lg editarNumeroTarjetaCliente" name="editarNumeroTarjetaCliente" placeholder="Ingresar Numero Tarjeta" required>



                    </div>



                  </div>



                </div>





                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="col-12 col-sm-12 col-md-6">



                  <div class="form-group">



                    <label for="">ENTRADA PARA EL NOMBRE</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-user"></i></span>



                      <input type="text" class="form-control input-lg editarNombreCliente" name="editarNombreCliente" placeholder="Ingresar nombre" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- SELECCIONAR ZONA -->



                  <div class="form-group">



                    <label for="">SELECCIONAR ZONA</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-building"></i></span>



                      <select class="form-control editarZonaPrestamoCliente" name="editarZonaPrestamoCliente">

                        <option value="0">Seleccionar zona</option>

                        <option value="norte">Norte</option>

                        <option value="sur">Sur</option>

                        <option value="centro">Centro</option>

                        <option value="occidente">Occidente</option>

                        <option value="oriente">Oriente</option>

                      </select>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- PRESTAMO DINERO -->



                  <div class="form-group">



                    <label for="">PRESTAMO DINERO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-money"></i></span>



                      <input type="number" class="form-control input-lg editarDineroPrestadoCliente" name="editarDineroPrestadoCliente" placeholder="Dinero Prestado" readonly required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- INTERES -->



                  <div class="form-group">



                    <label for="">INTERES</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>



                      <input type="number" class="form-control input-lg editarInteresPrestamoCliente" name="editarInteresPrestamoCliente" readonly placeholder="% Interes" required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- TIEMPO PRESTAMO -->



                  <div class="form-group">



                    <label for="">TIEMPO PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarTiempoPrestamoCliente" name="editarTiempoPrestamoCliente" readonly placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- TIPO PRESTAMO -->

                  <div class="form-group">



                    <label for="">TIPO PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <select class="form-control editarTipoPrestamoCliente" name="editarTipoPrestamoCliente" readonly>

                        <option value="0">Tipo Del Prestamo</option>

                        <option value="diario">Diario</option>

                        <option value="semanal">Semanal</option>

                        <option value="quincenal">Quincenal</option>

                        <option value="mensual">Mensual</option>

                      </select>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- DIA DEL PRESTAMO -->



                  <div class="form-group">



                    <label for="">DIA DEL PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" class="form-control input-lg editarDiaPrestamoCliente" name="editarDiaPrestamoCliente" readonly placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- DIA DEL COBRO -->



                  <div class="form-group">



                    <label for="">DIA DEL COBRO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" class="form-control input-lg editarDiaCobroPrestamoCliente" name="editarDiaCobroPrestamoCliente" readonly placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- FECHA DEL PRESTAMO -->



                  <div class="form-group">



                    <label for="">FECHA DEL PRESTAMO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" class="form-control input-lg editarFechaPrestamoCliente" name="editarFechaPrestamoCliente" readonly placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- FECHA FIN PRESTAMO -->



                  <div class="form-group">



                    <label for="">Fecha Fin Prestamo</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                      <input type="date" class="form-control input-lg editarFechaFinPrestamoCliente" name="editarFechaFinPrestamoCliente" readonly placeholder="Tiempo Prestamo" required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- Interes Mensual -->



                  <div class="form-group">



                    <label for="">Interes Mensual</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarInteresMensualCliente" name="editarInteresMensualCliente" readonly required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- Nº Cuotas -->



                  <div class="form-group">



                    <label for="">Nº Cuotas</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarNumeroCuotasCliente" name="editarNumeroCuotasCliente" readonly required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- Valor de la Cuota -->



                  <div class="form-group">



                    <label for="">Valor de la Cuota</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarValorCuotaCliente" name="editarValorCuotaCliente" readonly required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- Valor Total de Interes -->



                  <div class="form-group">



                    <label for="">Valor Total de Interes</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarValorTotalInteresCliente" name="editarValorTotalInteresCliente" readonly  required>



                    </div>



                  </div>



                </div>





                <div class="col-12 col-sm-12 col-md-6" style="display:none;">



                  <!-- Saldo Total a Pagar -->



                  <div class="form-group">



                    <label for="">Saldo Total a Pagar</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>



                      <input type="text" class="form-control input-lg editarSaldoTotalPagarCliente" name="editarSaldoTotalPagarCliente" readonly required>

                      <input type="hidden" class="form-control input-lg idClienteEditar" name="idClienteEditar" readonly required>



                    </div>



                  </div>



                </div>



                <div class="col-12 col-sm-12 col-md-12">



                  <!-- SELECCIONAR ZONA -->



                  <div class="form-group">



                    <label for="">SELECCIONAR ESTADO</label>



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-building"></i></span>



                      <select class="form-control editarEstadoCliente" name="editarEstadoCliente">

                        <option value="ACTIVO">ACTIVO</option>

                        <option value="PAGO">PAGO</option>

                        <option value="MOROSO">MOROSO</option>

                        <option value="PERDIDO">PERDIDO</option>

                      </select>



                    </div>



                  </div>



                </div>



            </div>





          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-success">Actualizar cliente</button>



        </div>



      </form>



      <?php



      $editarCliente = new ControladorClientes();

      $editarCliente -> ctrEditarCliente();



      ?>



    </div>







  </div>



</div>





<div class="modal fade" id="modalCalculadora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header success" style="background:#28A745; color:white">

        <h5 class="modal-title" id="exampleModalLabel">CALCULADORA</h5>

        <button type="button" class="close cerrarCalculadora" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">



        <div class="row">

            <div class="col-lg-6 col-sm-12">

              <h6>CALCULAR INTERES</h6>

              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg valorCuotaCalculadora" placeholder="valor Cuota">



                </div>



              </div>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg tiempoCalculadora" placeholder="Tiempo">



                </div>



              </div>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg dineroPrestadoCalculadora" placeholder="Dinero Prestado">



                </div>



              </div>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg resultadoCalculadora" readonly disabled>



                </div>



              </div>

            </div>



            <div class="col-lg-6 col-sm-12">



              <h6>CALCULAR CUOTA</h6>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg dieneroPrestadoDosCalculadora" placeholder="Dienero Prestado">



                </div>



              </div>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg  porcentajeDosCalculadora" placeholder="Porcentaje">



                </div>



              </div>



              <div class="form-group">

                 <div class="form-check form-check-inline">

                    <input class="form-check-input mensualChe" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">

                    <label class="form-check-label" for="inlineRadio1" style="font-size:12px;">Mensual</label>



                    <input class="form-check-input quincenalChe" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">

                    <label class="form-check-label" for="inlineRadio2" style="font-size:12px;">Quincenal</label>



                    <input class="form-check-input semanalChe" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">

                    <label class="form-check-label" for="inlineRadio2" style="font-size:12px;">Semanal</label>



                    <input class="form-check-input diarioChe" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">

                    <label class="form-check-label" for="inlineRadio2" style="font-size:12px;">Diaria</label>

                  </div>



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg tiempoDosCalculadora" placeholder="Tiempo">



                </div>



              </div>



              <div class="form-group">



                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>



                  <input type="text" class="form-control input-lg resultadoDosCalculadora" readonly disabled>



                </div>



              </div>

            </div>

        </div>



      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary cerrarCalculadora" data-dismiss="modal">Cerrar</button>

        <button type="button" class="btn btn-success calculadora">Calcular</button>

      </div>

    </div>

  </div>

</div>





<!--=====================================

MODAL INFORMACION CLIENTE

======================================-->



<div id="modalInformacionCliente" class="modal fade" role="dialog">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">





        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header success" style="background:#28A745; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Informacion cliente</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">



            <div>



              <h2 class="text-center" style="font-size:22px;font-family:'Open Sans';">Detalle cliente</h2>



              <table class="table" id="tablaContenido" style="font-size:18px;font-family:'Open Sans';"><tbody>



               <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Numero tarjeta</strong></td>

                  <td><strong class="infoClienteTarjeta"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong> Nombre del Cliente</strong></td>

                  <td><strong class="infoClienteNombre"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong> Fecha del préstamo</strong></td>

                  <td><strong class="infoClienteFechaPrestamo"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Total cuotas</strong></td>

                  <td><strong class="infoClienteCuotasTotales"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Valor cuota</strong></td>

                  <td><strong class="infoClienteValorCuota"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Cuotas pagas</strong></td>

                  <td><strong class="infoClienteCuotasPagas"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Cuotas Pendientes</strong></td>

                  <td><strong class="infoClienteCuotasPendientes"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Saldo total</strong></td>

                  <td><strong class="infoClienteSaldoTotal"></strong></td>

                </tr>



                <tr style="background:#EAF2F8; cursor: pointer;" onclick="this.style.display='none'">

                  <td><strong>Abono total</strong></td>

                  <td><strong class="infoClienteAbonoTotal"></strong></td>

                </tr>



               </tbody>



              </table>



            </div>



            <div>



            </div>



          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



        </div>





    </div>



  </div>



</div>



<?php



  $eliminarCliente = new ControladorClientes();

  $eliminarCliente -> ctrEliminarCliente();



?>

