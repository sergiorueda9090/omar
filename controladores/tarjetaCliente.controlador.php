<?php

class TarjetaCliente{

  /*=======================================
  AGREGAR PAGO MONTO TARJETA
  =======================================*/
  static public function ctrAgregarPagoTarjetaCliente(){

    if(isset($_POST["valorPagarTarjetaCliente"])){

              $id = $_SESSION["id"];
              $idCliente = $_POST["idClienteTarjetaCliente"];
              $valorPagado = str_replace(',','',$_POST["valorPagarTarjetaCliente"]);

              $valorCuota = $_POST["valorCuotaTarjetaCliente"];

              $total = $valorPagado/$valorCuota;

              $array = explode(".", $total);
              $cantidadCuotas = $array[0];


              $cantidadResultado = $array[1];
              $cantidadResultado = '0.'.$cantidadResultado;
              $cantidadResultado = $valorCuota*$cantidadResultado;
              $cantidadResultado = $valorCuota-$cantidadResultado;

              $datos = array("idUsuarioTarjeta"=>$id,
                              "idClienteTarjeta"=>$_POST["idClienteTarjetaCliente"],
                              "pagoClienteTarjeta"=>str_replace(',','',$_POST["valorPagarTarjetaCliente"]),
                              "valorInteresTarjetaCliente"=>0,
                              "fechaPagoClienteTarjeta"=>$_POST["fechaTarjetaCliente"],
                              "cantidadCuotas"=>$cantidadCuotas,
                              "cantidadResultado"=>$cantidadResultado);

              $respuesta = ModeloTarjetaCliente::mdlAgregarPagoTarjetaCliente($datos);

            if($respuesta == "ok"){

              /*SUMAR COBROS DE LA TARJETA PARA SACAR LAS CUOTAS PAGAS*/
              $datos = array("idClienteTarjeta"=>$_POST["idClienteTarjetaCliente"]);
              $respuestaSumarCobros = ModeloTarjetaCliente::mdlSumarCobrosCliente($datos);
              $total = $respuestaSumarCobros['sumaPagosCliente']/$valorCuota;
              $array = explode(".", $total);
              $cantidadCuotas = $array[0];

              $datos = array('cantidadCuotas'=>$cantidadCuotas,
                             'idClienteTarjeta'=>$_POST["idClienteTarjetaCliente"]);

              /*FIN SUMAR COBROS DE LA TARJETA PARA SACAR LAS CUOTAS PAGAS*/
              $respuestaCuotas = ModeloTarjetaCliente::mdlActualizarCuota($datos);

              $datos = array('fechaIngresoCuota'=>$_POST["fechaTarjetaCliente"],
                             'idUsuarioCuota'=>$_POST["idClienteTarjetaCliente"]);

              $maximoId = ModeloTarjetaCliente::mdlMaximoId($datos);

              $datosFecha = array('fechaIngresoCuota'=>$_POST["fechaTarjetaCliente"],
                                  'id'=>$_POST["idClienteTarjetaCliente"],
                                  'ultimaFehca'=>$maximoId[2]);

              $actualizarFecha = ModeloTarjetaCliente::mdlActualizarFecha($datosFecha);

                if($actualizarFecha == "ok" || $actualizarFecha == "error"){

                  echo'<script>

                  swal({
                      type: "success",
                      title: "Pago ha sido guardado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {

                          window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                          }
                        })

                  </script>';
                }else{
                  echo'<script>

                  swal({
                      type: "error",
                      title: "Pago no ha sido guardado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {

                          window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                          }
                        })

                  </script>';
                }

            }else{

              echo'<script>

              swal({
                  type: "error",
                  title: "Pago no ha sido guardado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {

                      window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                      }
                    })

              </script>';

            }

    }

  }

  /*=======================================
  ACTUALIZAR SALDO A LA INVERSION
  =======================================*/
  static public function ctrActualizarSaldoAInversion(){

    if(isset($_POST["valorPagarTarjetaCliente"])){

              $id = $_SESSION["id"];

              $idCliente = $_POST["idClienteTarjetaCliente"];

              $valorPagado = str_replace(',','',$_POST["valorPagarTarjetaCliente"]);

              $datos = array("idUsuarioTarjeta"=>$id,
                              "idClienteTarjeta"=>$_POST["idClienteTarjetaCliente"],
                              "pagoClienteTarjeta"=>str_replace(',','',$_POST["valorPagarTarjetaCliente"]));

              $respuesta = ModeloTarjetaCliente::mdlSeleccionarSaldoAInversion($datos);

              if($respuesta["saldoAinversion"] != ""){

                $cantidad = ($respuesta["saldoAinversion"] - $valorPagado);


                if($cantidad <= 0){
                  $cantidad = 0;
                  $saldoTotal = ($respuesta["saldoTotal"] - $valorPagado);
                  $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal);
                }else{
                  $saldoTotal = ($respuesta["saldoTotal"] - $valorPagado);
                  $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal);
                }

              }

              return $respuesta;

      }else if(isset($_POST["valorInteresTarjetaCliente"])){

        $id = $_SESSION["id"];

        $idCliente = $_POST["idClienteInteresTarjetaCliente"];

        $valorPagado = str_replace(',','',$_POST["valorInteresTarjetaCliente"]);

        $datos = array("idUsuarioTarjeta"=>$id,
                        "idClienteTarjeta"=>$_POST["idClienteInteresTarjetaCliente"],
                        "pagoClienteTarjeta"=>str_replace(',','',$_POST["valorInteresTarjetaCliente"]));

        $respuesta = ModeloTarjetaCliente::mdlSeleccionarSaldoAInversion($datos);

        if($respuesta["saldoAinversion"] != ""){

          $cantidad = ($respuesta["saldoAinversion"] - $valorPagado);

          if($cantidad <= 0){
            $cantidad = 0;
            $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal = $respuesta["saldoTotal"]);
          }else{
            $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal = $respuesta["saldoTotal"]);
          }


        }

        return $respuesta;

      }else if(isset($_POST["tSaldoTarjetaCliente"])){

        $id = $_SESSION["id"];

        $idCliente = $_POST["idClienteSaldoTotalTarjetaCliente"];

        $valorPagado = str_replace(',','',$_POST["tSaldoTarjetaCliente"]);

        $datos = array("idUsuarioTarjeta"=>$id,
                        "idClienteTarjeta"=>$_POST["idClienteSaldoTotalTarjetaCliente"],
                        "pagoClienteTarjeta"=>str_replace(',','',$_POST["tSaldoTarjetaCliente"]));

        $respuesta = ModeloTarjetaCliente::mdlSeleccionarSaldoAInversion($datos);

        if($respuesta["saldoAinversion"] != ""){

          $cantidad = ($respuesta["saldoAinversion"] - $valorPagado);

          if($cantidad <= 0){
            $cantidad = 0;
            $saldoTotal = 0;
            $pagoSaldoTotalCambio = str_replace(',','',$_POST["pagoSaldoTotalCambio"]);
            $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal,$pagoSaldoTotalCambio);
          }else{
            $saldoTotal = 0;
            $pagoSaldoTotalCambio = str_replace(',','',$_POST["pagoSaldoTotalCambio"]);
            $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal,$pagoSaldoTotalCambio);
            $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversion($datos,$cantidad);
          }

        }

        return $respuesta;

      }
  }

  /*=======================================
  AGREGAR PAGO INTERES TARJETA
  =======================================*/
  static public function ctrAgregarInteresTarjetaCliente(){

    if(isset($_POST["valorInteresTarjetaCliente"])){

      $id = $_SESSION["id"];
      $idCliente = $_POST["idClienteInteresTarjetaCliente"];
      $datos = array("idUsuarioTarjeta"=>$id,
                      "idClienteTarjeta"=>$_POST["idClienteInteresTarjetaCliente"],
                      "pagoClienteTarjeta"=>0,
                      "valorInteresTarjetaCliente"=>str_replace(',','',$_POST["valorInteresTarjetaCliente"]),
                      "fechaInteresTarjetaCliente"=>$_POST["fechaInteresTarjetaCliente"]);

     $respuesta = ModeloTarjetaCliente::mdlAgregarIntesTarjetaCliente($datos);

     if($respuesta == "ok"){

       echo'<script>

       swal({
           type: "success",
           title: "Pago de interes ha sido guardado correctamente",
           showConfirmButton: true,
           confirmButtonText: "Cerrar"
           }).then(function(result){
               if (result.value) {

               window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

               }
             })

       </script>';
     }else{

       echo'<script>

       swal({
           type: "error",
           title: "Pago de interes no ha sido guardado correctamente",
           showConfirmButton: true,
           confirmButtonText: "Cerrar"
           }).then(function(result){
               if (result.value) {

               window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

               }
             })

       </script>';

     }

    }

  }

  /*=======================================
  MOSTRAR TARJETA
  =======================================*/
  static public function ctrMostrarTarjetaCliente(){
    if(isset($_GET["id"])){
        $valor = $_GET["id"];
        $item = "id";
        $respuesta = ModeloTarjetaCliente::mdlMostrarTarjetaCliente($item, $valor);
        return $respuesta;
    }
  }

  /*=======================================
  actualizar saldo a la inversion
  =======================================*/
  static public function ctrMostrarTarjetaClienteActualizarInversion($id, $valor){
    if(isset($id)){
        $respuesta = ModeloTarjetaCliente::mdlMostrarTarjetaClienteActualizarInversion($id, $valor);
        return $respuesta;
    }
  }

  /*=======================================
    PROXIMA FECHA
  ========================================*/
  static public function ctrMostrarProximaFecha(){
    if(isset($_GET["id"])){
        $valor = $_GET["id"];
        $item = "id";
        $respuesta = ModeloTarjetaCliente::mdlMostrarProximaFecha($item, $valor);
        return $respuesta;
    }
  }
  /*=======================================
     ACTUALIZAR PROXIMA FECHA
  ========================================*/
  static public function ctrActualizarProximaFecha(){

    if(isset($_POST["proximaFechaCliente"])){

      $idCliente = $_POST["idClienteCuotaFecha"];

      $datos = array("proximaFechaCliente"=>$_POST["proximaFechaCliente"],
                     "idClienteCuota"=>$_POST["idClienteCuota"],
                     "idClienteTarjetaCliente" => $_POST["idClienteTarjetaCliente"]);
                
       $respuesta = ModeloTarjetaCliente::mdlActualizarProximaFecha($datos);

       if($respuesta == "ok"){

         echo'<script>

         swal({
             type: "success",
             title: "Actualizacion correctamente",
             showConfirmButton: true,
             confirmButtonText: "Cerrar"
             }).then(function(result){
                 if (result.value) {

                   window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                 }
               })

         </script>';
       }else{
         echo'<script>

         swal({
             type: "error",
             title: "error en ACTUALIZAR",
             showConfirmButton: true,
             confirmButtonText: "Cerrar"
             }).then(function(result){
                 if (result.value) {

                   window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                 }
               })

         </script>';
       }
    }

  }

  static public function ctrActualizarProximaFechaPagarMonto(){

    if(isset($_POST["fechaProximoTarjetaCliente"])){

      $datos = array("proximaFechaCliente" => $_POST["fechaProximoTarjetaCliente"],
                     "idClienteCuota"      => $_POST["idClienteCuotaPagarMonto"],
                     "idClienteTarjetaCliente" => $_POST["idClienteTarjetaCliente"]);

       $respuesta = ModeloTarjetaCliente::mdlActualizarProximaFecha($datos);

    }

  }

  static public function ctrActualizarProximaFechaCobrosDia(){

    if(isset($_POST["proximaFechaCliente"])){

      $idCliente = $_POST["idClienteCuotaFecha"];

    /*  $datos = array("proximaFechaCliente"=>$_POST["proximaFechaCliente"],
                     "idClienteCuota"=>$_POST["idClienteCuota"]);*/

     $datos = array("proximaFechaCliente"=>$_POST["proximaFechaCliente"],
                    "idClienteCuota"=>$_POST["idClienteCuota"],
                    "idClienteTarjetaCliente" => $_POST["idClienteTarjetaCliente"]);

       $respuesta = ModeloTarjetaCliente::mdlActualizarProximaFecha($datos);

       if($respuesta == "ok"){

         echo'<script>

         swal({
             type: "success",
             title: "Actualizacion correctamente",
             showConfirmButton: true,
             confirmButtonText: "Cerrar"
             }).then(function(result){
                 if (result.value) {

                   window.location = "http://34.206.219.127/cobroDelDia";

                 }
               })

         </script>';
       }else{
         echo'<script>

         swal({
             type: "error",
             title: "error en ACTUALIZAR",
             showConfirmButton: true,
             confirmButtonText: "Cerrar"
             }).then(function(result){
                 if (result.value) {

                   window.location = "http://34.206.219.127/cobroDelDia";

                 }
               })

         </script>';
       }
    }

  }

  /*=======================================
  MOSTRAR TARJETA
  =======================================*/
  static public function ctrMostrarCuotasPagasTarjetaCliente(){
    if(isset($_GET["id"])){
        $valor = $_GET["id"];
        $item = "idClienteTarjeta";
        $respuesta = ModeloTarjetaCliente::mdlMostrarCuotasPagasTarjetaCliente($item, $valor);
        return $respuesta;
    }
  }

  /*=============================================
  ELIMINAR PAGO TARJETA idPagoCuotaInteres
  =============================================*/

  static public function ctrEliminarpagosTarjeta(){

    if(isset($_GET["idPagoCuota"])){

      $datos = $_GET["idPagoCuota"];
      $idCliente = $_GET["id"];
      $valorCuota = $_GET["valorCuota"];
      $cantidadCuotasP = $_GET["cantidadCuotas"];
      $valorPagado = $_GET['valorPagado'];

      $respuestaSaldoTotal = ModeloTarjetaCliente::mdlSeleccionarSaldoAInversionDos($idCliente);

      $totalSaldoTotal = $respuestaSaldoTotal["saldoTotal"] + $valorPagado;

      if($totalSaldoTotal >= $respuestaSaldoTotal["dineroPrestadoCliente"]){
         $datosSaldo = array("SaldoAInversion"=>$respuestaSaldoTotal["dineroPrestadoCliente"],
                             "SaldoTotal"=>$totalSaldoTotal = ($respuestaSaldoTotal["saldoTotal"] + $valorPagado));
      }else{
        $datosSaldo = array("SaldoAInversion"=>$totalSaldoTotal,
                            "SaldoTotal"=>$totalSaldoTotal = ($respuestaSaldoTotal["saldoTotal"] + $valorPagado));
      }

      $respuestaSaldoTotal = ModeloTarjetaCliente::mdlActualizarSaldoAInversionSaldoTotal($idCliente,$datosSaldo);

      if($respuestaSaldoTotal == "ok"){

        $respuesta = ModeloTarjetaCliente::mdlEliminarpagosTarjeta($datos);

        if($respuesta == "ok"){

          /*SUMAR COBROS DE LA TARJETA PARA SACAR LAS CUOTAS PAGAS*/
          $datos = array("idClienteTarjeta"=>$idCliente);
          $respuestaSumarCobros = ModeloTarjetaCliente::mdlSumarCobrosCliente($datos);
          //var_dump($respuestaSumarCobros);

          $total = $respuestaSumarCobros["sumaPagosCliente"]/$valorCuota;
          //var_dump("total ".$total);

          $array = explode(".", $total);
          $cantidadCuotas = $array[0];

          $totalValorPagado = ($respuestaSumarCobros["sumaPagosCliente"]+$valorPagado)/$valorCuota;
          //var_dump("totalDos ".$totalValorPagado);

          $arrayDos = explode(".", $totalValorPagado);
          $cantidadCuotasDos = $arrayDos[0];

          $cantidadCuotas = ($cantidadCuotasDos-$cantidadCuotas);
          //var_dump("cantidadCuotas ".$cantidadCuotas);

          $datos = array('cantidadCuotas'=>$cantidadCuotas,
                         'idClienteTarjeta'=>$idCliente);

          //var_dump($datos);
          #return;

          /*FIN SUMAR COBROS DE LA TARJETA PARA SACAR LAS CUOTAS PAGAS*/
          $respuestaCuotas = ModeloTarjetaCliente::mdlActualizarCuotaUno($datos);

          if($respuestaCuotas == "ok"){

            echo'<script>

            swal({
                type: "success",
                title: "Elimanado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                      window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                    }
                  })

            </script>';
          }else{
            echo'<script>

            swal({
                type: "error",
                title: "Uno error no ha sido borrado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                      window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                    }
                  })

            </script>';
          }

        }else{
          echo'<script>

          swal({
              type: "error",
              title: "Dos error no ha sido borrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
              }).then(function(result){
                  if (result.value) {

                  window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                  }
                })

          </script>';
        }

      }
    }

  }


  /*=============================================
  ELIMINAR PAGO INTERES
  =============================================*/
  static public function ctrEliminarPagosInteres(){

    if(isset($_GET["idPagoCuotaInteres"])){

      $idCliente = $_GET["id"];

      $datos = $_GET["idPagoCuotaInteres"];

      $valorInteresSaldoInversion = $_GET["valorInteresSaldoInversion"];

      $respuesta = ModeloTarjetaCliente::mdlSeleccionarSaldoAInversionDos($idCliente);

      $total = $respuesta["saldoAinversion"] + $valorInteresSaldoInversion;

      if($total >= $respuesta["dineroPrestadoCliente"]){
        $total = $respuesta["dineroPrestadoCliente"];
      }else{
        $total = $total;
      }



      $respuesta = ModeloTarjetaCliente::mdlActualizarSaldoAInversionDos($idCliente,$total);

      if($respuesta == "ok"){

        $respuesta = ModeloTarjetaCliente::mdlEliminarpagosTarjetaInteres($datos);

        if($respuestaCuotas == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Elimanado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                    window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                  }
                })

          </script>';
        }else{
          echo'<script>

          swal({
              type: "success",
              title: "Elimanado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                    window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                  }
                })

          </script>';
        }

      }


    }

  }


  /*=======================================
  PAGAR SALDO TARJETA
  =======================================*/
  static public function ctrPagarSaldoTarjetaCliente(){

    if(isset($_POST['idClienteSaldoTotalTarjetaCliente'])){

        $id = $_SESSION["id"];

        $idCliente = $_POST["idClienteSaldoTotalTarjetaCliente"];

        $datos = array("idUsuarioTarjeta"=>$id,
                       "idClienteTarjeta"=>$_POST['idClienteSaldoTotalTarjetaCliente'],
                       "pagoClienteTarjeta"=>str_replace(',','',$_POST["tSaldoTarjetaCliente"]),
                       "valorInteresClienteTarjeta"=>0,
                       "fechaPagoClienteTarjeta"=>$_POST["fechaSaldoTarjetaCliente"],
                       "tiempoSaldoTarjetaCliente"=>$_POST["tiempoSaldoTarjetaCliente"]);

      $respuesta = ModeloTarjetaCliente::mdlPagarSaldoTarjetaCliente($datos);

      if($respuesta == "ok"){

        $respuestaAcualizar = ModeloTarjetaCliente::mdlActualizarCuotasSaldo($datos);

        if($respuestaAcualizar == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Saldo pagado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                    window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                  }
                })

          </script>';

        }else{

          echo'<script>

          swal({
              type: "error",
              title: "error Saldo no ha sido pagado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
              }).then(function(result){
                  if (result.value) {

                  window.location = "http://34.206.219.127/index.php?ruta=tarjetaCliente&id='.$idCliente.'";

                  }
                })

          </script>';

        }

      }

    }

  }

  /*=======================================
  ACTUALIZAR ESTADO TARJETA CLIENTE
  =======================================*/
  static public function ctractualizarEstadoTarjeta($idActualizarEstadoTarjeta,$estadoPago){
    $respuesta = ModeloTarjetaCliente::mdlActualizarEstadoTarjeta($idActualizarEstadoTarjeta,$estadoPago);
    return $respuesta;
  }


}

?>
