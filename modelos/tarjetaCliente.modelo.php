<?php

require_once "conexion.php";

class ModeloTarjetaCliente{

  /*=============================================
  SUMAR COBROS CLIENTE
  =============================================*/
  static public function mdlSumarCobrosCliente($datos){
    $stmt = Conexion::conectar()->prepare("SELECT  SUM(pagoClienteTarjeta) as sumaPagosCliente FROM pagosTarjeta WHERE idClienteTarjeta = :idClienteTarjeta");
    $stmt -> bindParam(":idClienteTarjeta",$datos['idClienteTarjeta'], PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt -> fetch();
  }

  static public function mdlMaximoId($datos){
    $id = $datos['idUsuarioCuota'];
    $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo , COUNT(estado) as cantidad,
                                          (SELECT fechaIngresoCuota FROM cuotas  WHERE idClienteCuota = $id AND estado = 0 ORDER BY fechaIngresoCuota DESC LIMIT 1) as ultimaFecha
                                           FROM cuotas WHERE idClienteCuota = $id AND estado = 0");
    $stmt -> execute();
    return $stmt -> fetch();
  }

  static public function mdlActualizarFecha($datosFecha){

    $fecha = $datosFecha["fechaIngresoCuota"];

    $id = $datosFecha["id"];

    $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET fechaIngresoCuota= '$fecha' WHERE estado = 0 AND fechaIngresoCuota = '0000-00-00'
                                           AND idClienteCuota = $id");


    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

  }

  /*=============================================
  AGREGAR COBROS CLIENTE
  =============================================*/
  static public function mdlAgregarPagoTarjetaCliente($datos){
    $stmt = Conexion::conectar()->prepare("INSERT INTO pagosTarjeta(idUsuarioTarjeta,idClienteTarjeta,pagoClienteTarjeta,valorInteresClienteTarjeta,fechaPagoClienteTarjeta) VALUES (:idUsuarioTarjeta,:idClienteTarjeta,:pagoClienteTarjeta,:valorInteresClienteTarjeta,:fechaPagoClienteTarjeta)");
    $stmt->bindParam(":idUsuarioTarjeta", $datos["idUsuarioTarjeta"], PDO::PARAM_INT);
    $stmt->bindParam(":idClienteTarjeta", $datos["idClienteTarjeta"], PDO::PARAM_INT);
    $stmt->bindParam(":pagoClienteTarjeta", $datos["pagoClienteTarjeta"], PDO::PARAM_STR);
    $stmt->bindParam(":valorInteresClienteTarjeta", $datos["valorInteresTarjetaCliente"], PDO::PARAM_INT);
    $stmt->bindParam(":fechaPagoClienteTarjeta", $datos["fechaPagoClienteTarjeta"], PDO::PARAM_STR);
    if($stmt->execute()){
       return "ok";
    }else{
      return "error en agregar";
    }
    $stmt->close();
    $stmt = null;
  }


  /*=============================================
  SELECIONAR SALDO A LA INVERSION
  =============================================*/
  static public function mdlSeleccionarSaldoAInversion($datos){

    $stmt = Conexion::conectar()->prepare("SELECT  saldoAinversion,saldoTotal FROM clientes WHERE id = :idClienteTarjeta");

    $stmt -> bindParam(":idClienteTarjeta",$datos["idClienteTarjeta"], PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

  }

  /*=============================================
  SELECIONAR SALDO A LA INVERSION
  =============================================*/
  static public function mdlSeleccionarSaldoAInversionDos($datos){

    $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente,saldoAinversion,saldoTotal FROM clientes WHERE id = :idClienteTarjeta");

    $stmt -> bindParam(":idClienteTarjeta",$datos, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

  }


  /*=============================================
    ACTUALIZAR SALDO A LA INVERSION
  =============================================*/
  static public function mdlActualizarSaldoAInversion($datos,$cantidad,$saldoTotal,$pagoSaldoTotalCambio = null){

    if($pagoSaldoTotalCambio == null){

      $stmt = Conexion::conectar()->prepare("UPDATE clientes SET saldoAinversion = :cantidad, saldoTotal = :saldoTotal WHERE id = :idClienteTarjeta");

      $stmt->bindParam(":idClienteTarjeta", $datos["idClienteTarjeta"], PDO::PARAM_INT);

      $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

      $stmt->bindParam(":saldoTotal", $saldoTotal, PDO::PARAM_INT);

      if($stmt->execute()){

        return "ok";

      }else{

        return "error actualizar estado cuota";

      }

    }else{

      $stmt = Conexion::conectar()->prepare("UPDATE clientes SET saldoAinversion = :cantidad, saldoTotal = :saldoTotal, btnPagarSaldo = :btnPagarSaldo WHERE id = :idClienteTarjeta");

      $stmt->bindParam(":idClienteTarjeta", $datos["idClienteTarjeta"], PDO::PARAM_INT);

      $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

      $stmt->bindParam(":saldoTotal", $saldoTotal, PDO::PARAM_INT);

      $stmt->bindParam(":btnPagarSaldo", $pagoSaldoTotalCambio, PDO::PARAM_INT);

      if($stmt->execute()){

        return "ok";

      }else{

        return "error actualizar estado cuota";

      }

    }

    $stmt->close();
    $stmt = null;
  }


  static public function mdlActualizarSaldoAInversionDos($idCliente,$total){

    $stmt = Conexion::conectar()->prepare("UPDATE clientes SET saldoAinversion = :cantidad  WHERE id = :idClienteTarjeta");

    $stmt->bindParam(":idClienteTarjeta", $idCliente, PDO::PARAM_INT);

    $stmt->bindParam(":cantidad", $total, PDO::PARAM_INT);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error actualizar estado cuota";

    }

    $stmt->close();
    $stmt = null;
  }

  static public function mdlActualizarSaldoAInversionSaldoTotal($idCliente,$total){

    $stmt = Conexion::conectar()->prepare("UPDATE clientes SET saldoAinversion = :SaldoAInversion, saldoTotal = :SaldoTotal  WHERE id = :idClienteTarjeta");

    $stmt->bindParam(":idClienteTarjeta", $idCliente, PDO::PARAM_INT);

    $stmt->bindParam(":SaldoAInversion", $total["SaldoAInversion"], PDO::PARAM_INT);

    $stmt->bindParam(":SaldoTotal", $total["SaldoTotal"], PDO::PARAM_INT);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error actualizar estado cuota";

    }

    $stmt->close();
    $stmt = null;
  }


  /*=============================================
  AGREGAR INTERES CLIENTE
  =============================================*/
  static public function mdlAgregarIntesTarjetaCliente($datos){
    $stmt = Conexion::conectar()->prepare("INSERT INTO pagosTarjeta(idUsuarioTarjeta,idClienteTarjeta,pagoClienteTarjeta,valorInteresClienteTarjeta,fechaPagoClienteTarjeta) VALUES (:idUsuarioTarjeta,:idClienteTarjeta,:pagoClienteTarjeta,:valorInteresClienteTarjeta,:fechaPagoClienteTarjeta)");
    $stmt->bindParam(":idUsuarioTarjeta", $datos["idUsuarioTarjeta"], PDO::PARAM_INT);
    $stmt->bindParam(":idClienteTarjeta", $datos["idClienteTarjeta"], PDO::PARAM_INT);
    $stmt->bindParam(":pagoClienteTarjeta", $datos["pagoClienteTarjeta"], PDO::PARAM_STR);
    $stmt->bindParam(":valorInteresClienteTarjeta", $datos["valorInteresTarjetaCliente"], PDO::PARAM_INT);
    $stmt->bindParam(":fechaPagoClienteTarjeta", $datos["fechaInteresTarjetaCliente"], PDO::PARAM_STR);
    if($stmt->execute()){
       return "ok";
    }else{
      return "error en agregar";
    }
    $stmt->close();
    $stmt = null;
  }

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/
  static public function mdlMostrarTarjetaCliente($item, $valor){

    if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT clientes.id as idCliente,numeroTarjetaCliente,nombreCliente,dineroPrestadoCliente,
																										interesPrestamoCliente,tiempoPrestamoCliente,tipoPrestamoCliente,
																										diaPrestamoCliente,diaCobroPrestamoCliente,valorTotalInteresCliente,interesMensualCliente,notaCliente,
																										cuotas.fechaCuota,cuotas.valorCuota,
																										cuotas.estado,tipoPrestamoCliente,numeroCuotasCliente,
																										(SELECT COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor) as cantidadCuotas,
																										(SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor and estado = 1) as cuotasDebe,
																										(SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor and estado = 0) as cuotasPagas,
																										(SELECT  SUM(pagoClienteTarjeta) FROM pagosTarjeta WHERE idClienteTarjeta = $valor) as abonoTotalCliente,
																										(SELECT  SUM(valorCuota) FROM cuotas WHERE idClienteCuota = $valor) as saldoTotalCliente,
                                                    (SELECT  SUM(valorInteresClienteTarjeta) FROM pagosTarjeta WHERE idClienteTarjeta = $valor) as interesTotalCliente
																										FROM clientes INNER JOIN cuotas on clientes.id = cuotas.idClienteCuota
																										WHERE clientes.id = $valor");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

  /*=======================================
    ACTUALIZAR SALDO A LA INVERSION
  ========================================*/
  static public function mdlMostrarTarjetaClienteActualizarInversion($id, $valor){

    $stmt = Conexion::conectar()->prepare("UPDATE clientes SET saldoAinversion = :valor WHERE id = :id");

    $stmt->bindParam(":id",$id, PDO::PARAM_INT);
    $stmt->bindParam(":valor",$valor, PDO::PARAM_INT);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error actualizar estado cuota";

    }

    $stmt->close();
    $stmt = null;
  }
  /*=======================================
    PROXIMA FECHA
  ========================================*/
   static public function mdlMostrarProximaFecha($item, $valor){


     $stmt = Conexion::conectar()->prepare("SELECT id,fechaCuota FROM cuotas WHERE idClienteCuota = $valor AND estado = 1");

     $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

     $stmt -> execute();

     return $stmt -> fetch();

     $stmt->close();
     $stmt = null;

   }

   /*=======================================
     ACTUALIZAR PROXIMA FECHA
   ========================================*/
   /*static public function mdlActualizarProximaFecha($datos){


     $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET fechaCuota = :fecha WHERE id = :id");

     $stmt->bindParam(":id",    $datos["idClienteCuota"], PDO::PARAM_INT);
     $stmt->bindParam(":fecha", $datos["proximaFechaCliente"], PDO::PARAM_STR);

     if($stmt->execute()){

       return "ok";

     }else{

       return "error actualizar estado cuota";

     }

     $stmt->close();
     $stmt = null;
   }*/


   static public function mdlActualizarProximaFecha($datos) {

       // Paso 1: Preparar y ejecutar el SELECT para obtener el ID
       $stmtUno = Conexion::conectar()->prepare("SELECT id FROM cuotas WHERE idClienteCuota = :idClienteCuota AND estado = 1 LIMIT 1");
       $stmtUno->bindParam(":idClienteCuota", $datos["idClienteTarjetaCliente"], PDO::PARAM_INT);
       $stmtUno->execute();

       // Obtener el ID de la fila seleccionada
       $row = $stmtUno->fetch(PDO::FETCH_ASSOC);
       if ($row) {
           $id = $row["id"];

           // Paso 2: Preparar y ejecutar el UPDATE usando el ID obtenido
           $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET fechaCuota = :fecha WHERE id = :id");
           $stmt->bindParam(":id", $id, PDO::PARAM_INT);
           $stmt->bindParam(":fecha", $datos["proximaFechaCliente"], PDO::PARAM_STR);

           if ($stmt->execute()) {
               $resultado = "ok";
           } else {
               $resultado = "error al actualizar la fecha de cuota";
           }
       } else {
           $resultado = "no se encontró la cuota";
       }

       // Liberar recursos
       $stmtUno = null;
       $stmt = null;

       return $resultado;
   }


  /*=============================================
   ACTUALIZAR CUOTAS PAGAS A 0
  =============================================*/
  static public function mdlActualizarCuota($datos){

    $cantidad = $datos["cantidadCuotas"];

    $id = $datos["idClienteTarjeta"];

    $stmt = Conexion::conectar()->prepare("SELECT * FROM utilidad where idCliente = :idClienteTarjeta");

    $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

    $stmt -> execute();

    $datos = $stmt -> fetch();

    if($datos == "" || $datos == null){

      $stmts = Conexion::conectar()->prepare("INSERT INTO utilidad(idCliente,utilidadDos,utilidadTres) VALUES ($id,$cantidad,0)");

      if($stmts->execute()){

        $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 0 WHERE idClienteCuota = :idClienteTarjeta ORDER BY id ASC LIMIT $cantidad");

        $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

        if($stmt->execute()){

          return "ok";

        }else{

          return "error actualizar estado cuota";

        }

      }else{

        var_dump("error al actualizar");

      }

    }else{

      $stmt = Conexion::conectar()->prepare("UPDATE utilidad SET utilidadDos = $cantidad WHERE idCliente = $id");

      if($stmt->execute()){

        $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 0 WHERE idClienteCuota = :idClienteTarjeta ORDER BY id ASC LIMIT $cantidad");

        $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

        if($stmt->execute()){

          return "ok";

        }else{

          return "error actualizar estado cuota";

        }

      }else{

        var_dump("error al actualizar");

      }

    }


    $stmt->close();
    $stmt = null;

  }

  /*=============================================
   ACTUALIZAR CUOTAS PAGAS A 1
  =============================================*/
  static public function mdlActualizarCuotaUno($datos){

    $cantidad = $datos["cantidadCuotas"];

    $id = $datos["idClienteTarjeta"];

    $stmt = Conexion::conectar()->prepare("SELECT * FROM utilidad where idCliente = :idClienteTarjeta");

    $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

    $stmt -> execute();

    $datos = $stmt -> fetch();

    $cantidadUtilidadDos = $datos["utilidadDos"];

    if($datos == "" || $datos == null){

      $stmts = Conexion::conectar()->prepare("INSERT INTO utilidad(idCliente,utilidadDos,utilidadTres) VALUES ($id,$cantidad,0)");

      if($stmts->execute()){

        $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 1 WHERE idClienteCuota = :idClienteTarjeta and estado = 0 ORDER BY id ASC LIMIT $cantidad");

        $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

        if($stmt->execute()){

          return "ok";

        }else{

          return "error actualizar estado cuota";

        }

      }else{

        var_dump("error al actualizar");

      }

    }else{

      $stmt = Conexion::conectar()->prepare("UPDATE utilidad SET utilidadDos = ($cantidadUtilidadDos-$cantidad) WHERE idCliente = $id");

      if($stmt->execute()){

        $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 1 WHERE idClienteCuota = :idClienteTarjeta and estado = 0 ORDER BY id ASC LIMIT $cantidad");

        $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

        if($stmt->execute()){

          return "ok";

        }else{

          return "error actualizar estado cuota";

        }

      }else{

        var_dump("error al actualizar");

      }

    }


    $stmt->close();
    $stmt = null;

  }


  /*=============================================
  MOSTRAR CUOTAS PAGAS CLIENTES
  =============================================*/
  static public function mdlMostrarCuotasPagasTarjetaCliente($item, $valor){

    $stmt = Conexion::conectar()->prepare("SELECT * FROM pagosTarjeta WHERE $item = $valor");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt->close();
    $stmt = null;


  }

  /*=============================================
  ELIMINAR PAGOS TARJETA
  =============================================*/

  static public function mdlEliminarpagosTarjeta($datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM pagosTarjeta WHERE idPagarTarjeta = :id");

    $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  ELIMINAR PAGOS TARJETA INTERES
  =============================================*/

  static public function mdlEliminarpagosTarjetaInteres($datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM pagosTarjeta WHERE idPagarTarjeta = :id");

    $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
    PAGAR SALDO TARJETA
  =============================================*/
    static public function mdlPagarSaldoTarjetaCliente($datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO pagosTarjeta(idUsuarioTarjeta,idClienteTarjeta,pagoClienteTarjeta,valorInteresClienteTarjeta,fechaPagoClienteTarjeta) VALUES (:idUsuarioTarjeta,:idClienteTarjeta,:pagoClienteTarjeta,:valorInteresClienteTarjeta,:fechaPagoClienteTarjeta)");
      $stmt->bindParam(":idUsuarioTarjeta", $datos["idUsuarioTarjeta"], PDO::PARAM_INT);
      $stmt->bindParam(":idClienteTarjeta", $datos["idClienteTarjeta"], PDO::PARAM_INT);
      $stmt->bindParam(":pagoClienteTarjeta", $datos["pagoClienteTarjeta"], PDO::PARAM_STR);
      $stmt->bindParam(":valorInteresClienteTarjeta", $datos["valorInteresClienteTarjeta"], PDO::PARAM_INT);
      $stmt->bindParam(":fechaPagoClienteTarjeta", $datos["fechaPagoClienteTarjeta"], PDO::PARAM_STR);
      if($stmt->execute()){
         return "ok";
      }else{
        return "error en agregar";
      }
      $stmt->close();
      $stmt = null;

    }


    /*=============================================
     ACTUALIZAR CUOTAS AL PAGAR SALGO
    =============================================*/
    static public function mdlActualizarCuotasSaldo($datos){

      $cantidad = $datos["tiempoSaldoTarjetaCliente"];

      $id = $datos["idClienteTarjeta"];

      $stmt = Conexion::conectar()->prepare("SELECT * FROM utilidad where idCliente = :idClienteTarjeta");

      $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

      $stmt -> execute();

      $datos = $stmt -> fetch();

      if($datos == "" || $datos == null){

        $stmts = Conexion::conectar()->prepare("INSERT INTO utilidad(idCliente,utilidadDos,utilidadTres) VALUES ($id,$cantidad,0)");

        if($stmts->execute()){

          $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 0 WHERE idClienteCuota = :idClienteTarjeta");

          $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

          if($stmt->execute()){

            return "ok";

          }else{

            return "error actualizar estado cuota";

          }

        }else{

          var_dump("error al actualizar");

        }

      }else{

        $stmt = Conexion::conectar()->prepare("UPDATE utilidad SET utilidadDos = $cantidad WHERE idCliente = $id");

        if($stmt->execute()){

        $stmt = Conexion::conectar()->prepare("UPDATE cuotas SET estado = 0 WHERE idClienteCuota = :idClienteTarjeta");

          $stmt->bindParam(":idClienteTarjeta", $id, PDO::PARAM_INT);

          if($stmt->execute()){

            return "ok";

          }else{

            return "error actualizar estado cuota";

          }

        }else{

          var_dump("error al actualizar");

        }

      }

      $stmt->close();
      $stmt = null;

    }


    /*=======================================
    ACTUALIZAR ESTADO TARJETA CLIENTE
    ========================================*/
    static public function mdlActualizarEstadoTarjeta($idActualizarEstadoTarjeta,$estadoPago){


      $stmt = Conexion::conectar()->prepare("UPDATE clientes SET estadoCliente = '$estadoPago' WHERE id = $idActualizarEstadoTarjeta");


      if($stmt->execute()){

        return "ok";

      }else{

        return "error actualizar estado tarjeta";

      }

      $stmt->close();
      $stmt = null;
    }


  }




?>
