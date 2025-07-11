<?php
  require_once "conexion.php";

  /*====================================
  TABLA DE COBROS
  ====================================*/
  class ReporteModelo{

    static public function mdlMostrarUsuario($idUsuario = null){
        if($idUsuario == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre FROM usuarios");

          $stmt -> execute();

          return "ok";

        }else{
          $stmt = Conexion::conectar()->prepare("SELECT nombre FROM usuarios WHERE id = $idUsuario");

          $stmt -> execute();

          return $stmt -> fetchAll();
        }

        $stmt -> close();

        $stmt = null;
    }

    static public function mdlMostrarReportePagos($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                              INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                              INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                              WHERE fechaPagoClienteTarjeta like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    static public function mdlMostrarReportePagosUnique($fechaInicial,$fechaFinal,$idUserUnique){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idUsuarioTarjeta = usuarios.id
                                              INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idUsuarioTarjeta = usuarios.id
                                              INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                              WHERE fechaPagoClienteTarjeta like '%$fechaFinal%' AND usuarios.id = $idUserUnique");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idUsuarioTarjeta = usuarios.id
                                                INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $idUserUnique");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idUsuarioTarjeta = usuarios.id
                                                INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $idUserUnique");


        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    static public function mdlMostrarReportePagosPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPagoClienteTarjeta like '%$fechaFinal%'");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id WHERE usuarios.id = $id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPagoClienteTarjeta like '%$fechaFinal%' AND usuarios.id = $id");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,pagoClienteTarjeta,fechaPagoClienteTarjeta,valorInteresClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");


          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    GRAFICA DE COBRADORES
    ====================================*/
    static public function mdlGraficaCobradores($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE fechaPagoClienteTarjeta like '%$fechaFinal%'
                                                  GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){


            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                    INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                    INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                    WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                    GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                    INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                    INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                    WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                    GROUP BY nombre;");


          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }


          $stmt -> close();

          $stmt = null;

    }



    /*=============================================
    RANGO FECHAS
    =============================================*/
    static public function mdlRangoFechasCobro($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT (pagoClienteTarjeta+valorInteresClienteTarjeta) as total, fechaPagoClienteTarjeta as fecha FROM pagosTarjeta ORDER BY idPagarTarjeta ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT (pagoClienteTarjeta+valorInteresClienteTarjeta) as total, fechaPagoClienteTarjeta as fecha FROM pagosTarjeta WHERE fechaPagoClienteTarjeta like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT (pagoClienteTarjeta+valorInteresClienteTarjeta) as total, fechaPagoClienteTarjeta as fecha FROM pagosTarjeta WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT (pagoClienteTarjeta+valorInteresClienteTarjeta) as total, fechaPagoClienteTarjeta as fecha FROM pagosTarjeta WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinal'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

    }

    /*====================================
    TABLA DE PRESTAMOS
    ====================================*/

    static public function mdlMostrarTablaPrestamos($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaPrestamoCliente FROM usuarios
                                               INNER JOIN clientes on clientes.idUsuario = usuarios.id");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaPrestamoCliente FROM usuarios
                                                INNER JOIN clientes on clientes.idUsuario = usuarios.id
                                                WHERE fechaPrestamoCliente like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaPrestamoCliente FROM usuarios
                                                  INNER JOIN clientes on clientes.idUsuario = usuarios.id
                                                  WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{


           $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaPrestamoCliente FROM usuarios
                                                  INNER JOIN clientes on clientes.idUsuario = usuarios.id
                                                  WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;

    }

    static public function mdlMostrarTablaPrestamosPost($fechaInicial,$fechaFinal,$id){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario");

          $stmt -> execute();

          return $stmt -> fetchAll();

         }else if($fechaInicial == $fechaFinal){

           $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente like '%$fechaFinal%'");

           $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

           $stmt -> execute();

           return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }else{


             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }

           $stmt -> execute();

           return $stmt -> fetchAll();


         }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios
                                                 INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE clientes.idUsuario = $id");

          $stmt -> execute();

          return $stmt -> fetchAll();

         }else if($fechaInicial == $fechaFinal){

           $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios
                                                  INNER JOIN clientes on clientes.idUsuario = usuarios.id WHERE fechaPrestamoCliente like '%$fechaFinal%' AND clientes.idUsuario = $id");

           $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

           $stmt -> execute();

           return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente
                                                  BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND clientes.idUsuario = $id");

           }else{


             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,dineroPrestadoCliente,fechaCliente
                                                    FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                    WHERE fechaPrestamoCliente  BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

           }

           $stmt -> execute();

           return $stmt -> fetchAll();


         }

      }

      $stmt -> close();

      $stmt = null;

    }


    /*====================================
    GRAFICA DE PRESTAMOS
    ====================================*/

    static public function mdlGraficaPrestamos($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente like '%$fechaFinal%' GROUP BY nombre;");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");


        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }


    /*=============================================
    RANGO FECHAS ESTADISTICA DE PRESTAMOS
    =============================================*/
    static public function mdlRangoFechasPrestamos($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente as total, fechaPrestamoCliente as fecha FROM clientes ORDER BY id ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente as total, fechaPrestamoCliente as fecha FROM clientes WHERE fechaPrestamoCliente like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente as total, fechaPrestamoCliente as fecha FROM clientes WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente as total, fechaPrestamoCliente as fecha FROM clientes WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TABLA DE GASTOS
    ====================================*/

    static public function mdlMostrarTablaGasto($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){


         $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{

           $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;

    }


    /*====================================
    GRAFICA DE GASTOS
    ====================================*/

    static public function mdlGasto($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto like '%$fechaFinal%' GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");


        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }
        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*=============================================
    RANGO FECHAS ESTADISTICA DE GASTOS
    =============================================*/
    static public function mdlRangoFechasGastos($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT valorGasto as total, fechaGasto as fecha FROM gastos ORDER BY idGastos ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT valorGasto as total, fechaGasto as fecha FROM gastos WHERE fechaGasto like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT valorGasto as total, fechaGasto as fecha FROM gastos WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT valorGasto as total, fechaGasto as fecha FROM gastos WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinal'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TABLA DE BILLETERA
    ====================================*/
    static public function mdlMostrarReporteBilletera($fechaInicial,$fechaFinal ){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera like '%$fechaFinal%'");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;


    }

    /*====================================
    GRAFICA DE BILLETERA
    ====================================*/

    static public function mdlBilletera($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera like '%$fechaFinal%' GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }


      $stmt -> close();

      $stmt = null;

    }

    /*=============================================
    RANGO FECHAS ESTADISTICA DE BILLETERA
    =============================================*/
    static public function mdlRangoFechasBilletera($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT valorBilletera as total, fechaBilletera as fecha FROM billetera ORDER BY idBilletera ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT valorBilletera as total, fechaBilletera as fecha FROM billetera WHERE fechaBilletera like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT valorBilletera as total, fechaBilletera as fecha FROM billetera WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT valorBilletera as total, fechaBilletera as fecha FROM billetera WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinal'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TABLA DE BANCO
    ====================================*/
    static public function mdlMostrarReporteBanco($item,$valor,$fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    GRAFICA DE BILLETERA
    ====================================*/

    static public function mdlBanco($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco like '%$fechaFinal%' GROUP BY nombre;");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();


      }

      $stmt -> close();

      $stmt = null;

    }

    /*=============================================
    RANGO FECHAS ESTADISTICA DE BANCO
    =============================================*/
    static public function mdlRangoFechasBanco($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT valorBanco as total, fechaBanco as fecha FROM banco ORDER BY idBanco ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT valorBanco as total, fechaBanco as fecha FROM banco WHERE fechaBanco like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT valorBanco as total, fechaBanco as fecha FROM banco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT valorBanco as total, fechaBanco as fecha FROM banco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinal'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TABLA DE EFECTIVO
    ====================================*/
    static public function mdlMostrarReporteEfectivo($item,$valor,$fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }


    /*====================================
    GRAFICA DE EFECTIVO
    ====================================*/

    static public function mdlEfectivo($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo GROUP BY nombre;");

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo like '%$fechaFinal%' GROUP BY nombre;");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

      $stmt -> close();

      $stmt = null;

    }

    /*=============================================
    RANGO FECHAS ESTADISTICA DE EFECTIVO
    =============================================*/
    static public function mdlRangoFechasEfectivo($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT valorEfectivo as total, fechaEfectivo as fecha FROM efectivo ORDER BY idEfectivo ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT valorEfectivo as total, fechaEfectivo as fecha FROM efectivo WHERE fechaEfectivo like '%$fechaFinal%'");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT valorEfectivo as total, fechaEfectivo as fecha FROM efectivo WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT valorEfectivo as total, fechaEfectivo as fecha FROM efectivo WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinal'");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

      }

    }


    /*====================================
    TABLA DE PRESTAMOS
    ====================================*/

    static public function mdlMostrarReposteExcel($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT *,
                                            (SELECT COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = clientes.id) as cantidadCuotas,
                                            (SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = clientes.id and estado = 1) as cuotasDebe,
                                            (SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = clientes.id and estado = 0) as cuotasPagas,
                                            (SELECT  (clientes.dineroPrestadoCliente - SUM(pagoClienteTarjeta)) - SUM(valorInteresClienteTarjeta) FROM pagosTarjeta WHERE idClienteTarjeta = clientes.id) as abonoTotalClienteRESULTADO
                                            FROM usuarios
                                            INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                            INNER JOIN cuotas on clientes.id = cuotas.idClienteCuota
                                            GROUP by clientes.id");

        //antigua consulta 4-12-2022
        //$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{


           $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;

    }



    /*====================================
    REPORTES GLOBALES
    ====================================*/

    static public function mdlMostrarReposteExcelGobal($fechaInicial,$fechaFinal,$nombreTabla){

      $mayuscula = ucfirst($nombreTabla);

      $lastChar = $nombreTabla[-1];
      if($lastChar == 's' || $lastChar == 'S'){
         //$nombreTabla = trim($nombreTabla, 's');
         $nombreTabla = $nombreTabla;
      }


      $nombre = 'nombre';
      $valor = 'valor';
      $fecha = 'fecha';
      $punto = '.';
      $idUsuarioNom = 'idUsuario';
      $idUsuario = $nombreTabla.$punto.$idUsuarioNom.$mayuscula;

      $lastChar = $idUsuario[-1];
      if($lastChar == 's' || $lastChar == 'S'){
         $idUsuario = trim($idUsuario, 's');
      }

      $nombres = $nombreTabla.$punto.$nombre.$mayuscula;
      $lastChar = $nombres[-1];
      if($lastChar == 's' || $lastChar == 'S'){
         $nombres = trim($nombres, 's');
      }


      $valors =  $nombreTabla.$punto.$valor.$mayuscula;
      $lastChar = $valors[-1];
      if($lastChar == 's' || $lastChar == 'S'){
         $valors = trim($valors, 's');
      }


      $fechas =  $nombreTabla.$punto.$fecha.$mayuscula;
      $lastChar = $fechas[-1];
      if($lastChar == 's' || $lastChar == 'S'){
         $fechas = trim($fechas, 's');
      }


      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre AS nombreUsuario,
                                               $nombres AS nombreGasto,
                                               $valors AS valor,
                                               $fechas AS fecha FROM usuarios
                                               INNER JOIN $nombreTabla on usuarios.id = $idUsuario");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre AS nombreUsuario,
                                                $nombres AS nombreGasto,
                                                $valors AS valor,
                                                $fechas AS fecha FROM usuarios
                                                INNER JOIN $nombreTabla on usuarios.id = $idUsuario WHERE $fechas like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre AS nombreUsuario,
                                                  $nombres AS nombreGasto,
                                                  $valors AS valor,
                                                  $fechas AS fecha FROM usuarios
                                                  INNER JOIN $nombreTabla on usuarios.id = $idUsuario WHERE $fechas BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{


           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre AS nombreUsuario,
                                                  $nombres AS nombreGasto,
                                                  $valors AS valor,
                                                  $fechas AS fecha FROM usuarios
                                                  INNER JOIN $nombreTabla on usuarios.id = $idUsuario WHERE $fechas BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;

    }


    /*====================================
    TOTAL COBROS POR PRESTAMISTA
    ====================================*/
    static public function mdlGraficaCobradoresPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                    INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                    INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                    WHERE fechaPagoClienteTarjeta like '%$fechaFinal%'
                                                    GROUP BY nombre;");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else{

            $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){


              $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                      INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                      INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                      WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                      GROUP BY nombre;");

            }else{

              $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                      INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                      INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                      WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                      GROUP BY nombre;");


            }

            $stmt -> execute();

            return $stmt -> fetchAll();

          }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                  INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                  INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                  WHERE /*BEFORE usuarios.id*/ pagosTarjeta.idUsuarioTarjeta = $id
                                                  GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                    INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                    INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                    WHERE fechaPagoClienteTarjeta like '%$fechaFinal%' AND /*BEFORE usuarios.id*/ pagosTarjeta.idUsuarioTarjeta = $id
                                                    GROUP BY nombre;");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else{

            $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){


              $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                      INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                      INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                      WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                      AND /*BEFORE usuarios.id*/ pagosTarjeta.idUsuarioTarjeta = $id
                                                      GROUP BY nombre;");

            }else{

              $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as totalCobrado,fechaPagoClienteTarjeta FROM usuarios
                                                      INNER JOIN clientes on usuarios.id = clientes.idUsuario
                                                      INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                      WHERE fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                      AND /*BEFORE usuarios.id*/ pagosTarjeta.idUsuarioTarjeta = $id
                                                      GROUP BY nombre;");


            }

            $stmt -> execute();

            return $stmt -> fetchAll();

          }

      }


          $stmt -> close();

          $stmt = null;

    }

    /*====================================
    TOTAL PRESTAMOS POR PRESTAMISTA
    ====================================*/
    static public function mdlGraficaPrestamosPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente like '%$fechaFinal%' GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");


          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario where usuarios.id = $id GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente like '%$fechaFinal%' AND usuarios.id = $id GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreCliente,sUM(dineroPrestadoCliente) as totalPrestamo,fechaPrestamoCliente FROM usuarios INNER JOIN clientes on usuarios.id = clientes.idUsuario WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");


          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }

        $stmt -> close();

        $stmt = null;


    }


    /*====================================
    TOTAL GASTO TABLA
    ====================================*/
    static public function mdlMostrarTablaGastoPost($fechaInicial,$fechaFinal,$id = null){
      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto");

          $stmt -> execute();

          return $stmt -> fetchAll();

         }else if($fechaInicial == $fechaFinal){


           $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto like '%$fechaFinal%'");

           $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

           $stmt -> execute();

           return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }else{

             $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
           }

           $stmt -> execute();

           return $stmt -> fetchAll();


         }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto WHERE usuarios.id = $id");

          $stmt -> execute();

          return $stmt -> fetchAll();

         }else if($fechaInicial == $fechaFinal){


           $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto like '%$fechaFinal%' AND usuarios.id = $id");

           $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

           $stmt -> execute();

           return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

           }else{

             $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto  WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");
           }

           $stmt -> execute();

           return $stmt -> fetchAll();


         }

      }

      $stmt -> close();

      $stmt = null;

    }



    /*====================================
    TOTAL GASTO PRESTAMISTA
    ====================================*/

    static public function mdlGastoPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto like '%$fechaFinal%' GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");


          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }
          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE usuarios.id = $id GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto like '%$fechaFinal%' AND usuarios.id = $id GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");


          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreGasto,SUM(valorGasto) as totalGasto,fechaGasto FROM usuarios INNER JOIN gastos on usuarios.id = gastos.idUsuarioGasto WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }
          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }


      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TOTAL PAGOS EN EFECTIVO
    ====================================*/
    static public function mdlEfectivoPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo like '%$fechaFinal%' GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo where usuarios.id = $id GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo like '%$fechaFinal%' AND usuarios.id = $id GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,SUM(valorEfectivo) as totalEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on usuarios.id = efectivo.idUsuarioEfectivo  WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TOTAL TABLA PAGOS EN EFECTIVO
    ====================================*/
    static public function mdlMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo like '%$fechaFinal%'");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE usuarios.id = $id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo like '%$fechaFinal%' AND usuarios.id = $id");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreEfectivo,valorEfectivo,fechaEfectivo FROM usuarios INNER JOIN efectivo on efectivo.idUsuarioEfectivo= usuarios.id WHERE fechaEfectivo BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TOTAL TABLA PAGOS EN BANCO
    ====================================*/
    static public function mdlMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco like '%$fechaFinal%'");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE usuarios.id = $id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco like '%$fechaFinal%' AND usuarios.id = $id");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,valorBanco,fechaBanco FROM usuarios INNER JOIN banco on banco.idUsuarioBanco = usuarios.id WHERE fechaBanco lBETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");
          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TOTAL PRESTAMISTAS PAGOS EN BANCO
    ====================================*/
    static public function mdlBancoPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco like '%$fechaFinal%' GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY nombre;");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();


        }

      }else{

        if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE usuarios.id = $id  GROUP BY nombre;");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco like '%$fechaFinal%' AND usuarios.id = $id GROUP BY nombre;");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBanco,SUM(valorBanco) as totalBanco,fechaBanco FROM usuarios INNER JOIN banco on usuarios.id = banco.idUsuarioBanco WHERE fechaBanco BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id GROUP BY nombre;");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();


        }

      }

      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    TOTAL TABLA BILLETERA
    ====================================*/
    static public function mdlMostrarReporteBilleteraPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera like '%$fechaFinal%'");

            $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }

           $stmt -> execute();

           return $stmt -> fetchAll();

          }


      }else{

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE usuarios.id = $id");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera like '%$fechaFinal%' AND usuarios.id = $id");

            $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

         }else{

           $fechaActual = new DateTime();
           $fechaActual ->add(new DateInterval("P1D"));
           $fechaActualMasUno = $fechaActual->format("Y-m-d");

           $fechaFinal2 = new DateTime($fechaFinal);
           $fechaFinal2 ->add(new DateInterval("P1D"));
           $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

           if($fechaFinalMasUno == $fechaActualMasUno){

             $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

           }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,valorBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on billetera.idUsuarioBilletera = usuarios.id WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

           }

           $stmt -> execute();

           return $stmt -> fetchAll();

          }


      }

        $stmt -> close();

        $stmt = null;

    }

    /*====================================
    TOTAL RESTAMISTAS PAGOS BILLETERA
    ====================================*/
    static public function mdlBilleteraPost($fechaInicial,$fechaFinal,$id = null){

      if($id == null){

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera GROUP BY nombre;");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera like '%$fechaFinal%' GROUP BY nombre;");

            $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }else{

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera WHERE usuarios.id = $id GROUP BY nombre;");

            $stmt -> execute();

            return $stmt -> fetchAll();

          }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera like '%$fechaFinal%' AND usuarios.id = $id GROUP BY nombre;");

            $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

          $fechaActual = new DateTime();
          $fechaActual ->add(new DateInterval("P1D"));
          $fechaActualMasUno = $fechaActual->format("Y-m-d");

          $fechaFinal2 = new DateTime($fechaFinal);
          $fechaFinal2 ->add(new DateInterval("P1D"));
          $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

          if($fechaFinalMasUno == $fechaActualMasUno){

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }else{

            $stmt = Conexion::conectar()->prepare("SELECT nombre,nombreBilletera,SUM(valorBilletera) as totalBilletera,fechaBilletera FROM usuarios INNER JOIN billetera on usuarios.id = billetera.idUsuarioBilletera  WHERE fechaBilletera BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND usuarios.id = $id");

          }

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

      }


      $stmt -> close();

      $stmt = null;

    }

    /*====================================
    UTILIDAD UNO
    ====================================*/
    static public function mdlUtilidadUno($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,
                                                valorTotalInteresCliente + pagosTarjeta.valorInteresClienteTarjeta AS totalUtilidadUno,
                                                fechaPrestamoCliente
                                                FROM clientes
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                GROUP BY pagosTarjeta.idClienteTarjeta");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,
                                                valorTotalInteresCliente + pagosTarjeta.valorInteresClienteTarjeta AS totalUtilidadUno,
                                                fechaPrestamoCliente
                                                FROM clientes
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPrestamoCliente like '%$fechaFinal%'
                                                GROUP BY pagosTarjeta.idClienteTarjeta");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,
                                                 valorTotalInteresCliente + pagosTarjeta.valorInteresClienteTarjeta AS totalUtilidadUno,
                                                 fechaPrestamoCliente
                                                 FROM clientes
                                                 INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                 INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                 WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                 GROUP BY pagosTarjeta.idClienteTarjeta");

         }else{

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,
                                                valorTotalInteresCliente + pagosTarjeta.valorInteresClienteTarjeta AS totalUtilidadUno,
                                                fechaPrestamoCliente
                                                FROM clientes
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                GROUP BY pagosTarjeta.idClienteTarjeta");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }

    /*====================================
    ESTADISTICA DE UTILIDAD UNO
    ====================================*/
    static public function mdlEstadisticaUtilidadUno($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT (clientes.valorTotalInteresCliente + SUM(pagosTarjeta.valorInteresClienteTarjeta)) AS total,
                                              clientes.fechaPrestamoCliente as fecha
                                              FROM clientes
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                              GROUP BY pagosTarjeta.idClienteTarjeta");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT (clientes.valorTotalInteresCliente + SUM(pagosTarjeta.valorInteresClienteTarjeta)) AS total,
                                              clientes.fechaPrestamoCliente as fecha
                                              FROM clientes
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = clientes.id
                                              WHERE fechaPrestamoCliente like '%$fechaFinal%'
                                              GROUP BY pagosTarjeta.idClienteTarjeta");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT (clientes.valorTotalInteresCliente + SUM(pagosTarjeta.valorInteresClienteTarjeta)) AS total,
                                                clientes.fechaPrestamoCliente as fecha
                                                FROM clientes
                                                INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                LEFT JOIN pagosTarjeta ON pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE clientes.fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                GROUP BY clientes.id");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT (clientes.valorTotalInteresCliente + SUM(pagosTarjeta.valorInteresClienteTarjeta)) AS total,
                                                clientes.fechaPrestamoCliente as fecha
                                                FROM clientes
                                                INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                LEFT JOIN pagosTarjeta ON pagosTarjeta.idClienteTarjeta = clientes.id
                                                WHERE clientes.fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                GROUP BY clientes.id");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

      }

    }


    /*====================================
    TABLA UTILIDAD DOS
    ====================================*/
    static public function mdlUtilidadDos($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT DISTINCT clientes.id,clientes.tipoPrestamoCliente,clientes.numeroCuotasCliente,
                                                 count(cuotas.estado) as cuotasPagas,clientes.interesMensualCliente
                                                 FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                 INNER JOIN cuotas on cuotas.idClienteCuota = clientes.id
                                                 WHERE cuotas.estado = 0 GROUP BY clientes.id");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT DISTINCT clientes.id,clientes.tipoPrestamoCliente,clientes.numeroCuotasCliente,
                                                 count(cuotas.estado) as cuotasPagas,clientes.interesMensualCliente
                                                 FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                 INNER JOIN cuotas on cuotas.idClienteCuota = clientes.id
                                                 WHERE cuotas.estado = 0 GROUP BY clientes.id");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT DISTINCT clientes.id,clientes.tipoPrestamoCliente,clientes.numeroCuotasCliente,
                                                  count(cuotas.estado) as cuotasPagas,clientes.interesMensualCliente
                                                  FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                  INNER JOIN cuotas on cuotas.idClienteCuota = clientes.id
                                                  WHERE cuotas.estado = 0 GROUP BY clientes.id");

         }else{

          $stmt = Conexion::conectar()->prepare("SELECT DISTINCT clientes.id,clientes.tipoPrestamoCliente,clientes.numeroCuotasCliente,
                                                 count(cuotas.estado) as cuotasPagas,clientes.interesMensualCliente
                                                 FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                 INNER JOIN cuotas on cuotas.idClienteCuota = clientes.id
                                                 WHERE cuotas.estado = 0 GROUP BY clientes.id");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlUtilidadDosDos($fechaInicial,$fechaFinal,$id){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                clientes.nombreCliente,clientes.interesMensualCliente,
                                                cuotas.estado,cuotas.fechaIngresoCuota
                                                FROM clientes
                                                INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                INNER JOIN cuotas ON cuotas.idClienteCuota = clientes.id
                                                WHERE cuotas.estado = 0
                                                AND clientes.id = $id ORDER BY cuotas.id DESC");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                clientes.nombreCliente,clientes.interesMensualCliente,
                                                cuotas.estado,cuotas.fechaIngresoCuota
                                                FROM clientes
                                                INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                INNER JOIN cuotas ON cuotas.idClienteCuota = clientes.id
                                                WHERE cuotas.estado = 0
                                                AND clientes.id = $id
                                                AND cuotas.fechaIngresoCuota like '%$fechaFinal%' ORDER BY cuotas.id DESC");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                 clientes.nombreCliente,clientes.interesMensualCliente,
                                                 cuotas.estado,cuotas.fechaIngresoCuota
                                                 FROM clientes
                                                 INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                 INNER JOIN cuotas ON cuotas.idClienteCuota = clientes.id
                                                 WHERE cuotas.estado = 0
                                                 AND clientes.id = $id
                                                 AND cuotas.fechaIngresoCuota BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY cuotas.id DESC");

         }else{

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                clientes.nombreCliente,clientes.interesMensualCliente,
                                                cuotas.estado,cuotas.fechaIngresoCuota
                                                FROM clientes
                                                INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                INNER JOIN cuotas ON cuotas.idClienteCuota = clientes.id
                                                WHERE cuotas.estado = 0
                                                AND clientes.id = $id
                                                AND cuotas.fechaIngresoCuota BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY cuotas.id DESC");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }


    /*static public function mdlUtilidadDosInteres($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,pagosTarjeta.idClienteTarjeta,clientes.nombreCliente,
                                                SUM(pagosTarjeta.valorInteresClienteTarjeta) AS totalInteres,pagosTarjeta.fechaPagoClienteTarjeta
                                                FROM `pagosTarjeta`
                                                INNER JOIN clientes ON clientes.id = pagosTarjeta.idClienteTarjeta
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                GROUP BY pagosTarjeta.idClienteTarjeta");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else if($fechaInicial == $fechaFinal){

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,valorTotalInteresCliente,fechaCliente FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario WHERE fechaCliente like '%$fechaFinal%'");

          $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,valorTotalInteresCliente,fechaCliente FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{

          $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,nombreCliente,valorTotalInteresCliente,fechaCliente FROM clientes INNER JOIN usuarios on usuarios.id = clientes.idUsuario WHERE fechaCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }*/

    /*====================================
    ESTADISTICA DE UTILIDAD DOS
    ====================================*/
    static public function mdlEstadisticaUtilidadDos($fechaInicial, $fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT clientes.id,usuarios.nombre,clientes.nombreCliente,
                                                     (clientes.interesMensualCliente*utilidad.utilidadDos)+
                                                      SUM(pagosTarjeta.valorInteresClienteTarjeta) AS utilidadTotalDos,
                                                      utilidad.fechaUtilidad
                                              FROM clientes
                                              INNER JOIN utilidad on utilidad.idCliente = clientes.id
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = utilidad.idCliente
                                              INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                              GROUP BY utilidad.idCliente");

        $stmt -> execute();

        return $stmt -> fetchAll();


      }else if($fechaInicial == $fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT clientes.id,usuarios.nombre,clientes.nombreCliente,
                                                     (clientes.interesMensualCliente*utilidad.utilidadDos)+
                                                      SUM(pagosTarjeta.valorInteresClienteTarjeta) AS utilidadTotalDos,
                                                      utilidad.fechaUtilidad
                                              FROM clientes
                                              INNER JOIN utilidad on utilidad.idCliente = clientes.id
                                              INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = utilidad.idCliente
                                              INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                              WHERE utilidad.fechaUtilidad like '%$fechaFinal%' GROUP BY utilidad.idCliente");

        $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      }else{

        $fechaActual = new DateTime();
        $fechaActual ->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");

        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2 ->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

        if($fechaFinalMasUno == $fechaActualMasUno){

          $stmt = Conexion::conectar()->prepare("SELECT clientes.id,usuarios.nombre,clientes.nombreCliente,
                                                       (clientes.interesMensualCliente*utilidad.utilidadDos)+
                                                        SUM(pagosTarjeta.valorInteresClienteTarjeta) AS utilidadTotalDos,
                                                        utilidad.fechaUtilidad
                                                FROM clientes
                                                INNER JOIN utilidad on utilidad.idCliente = clientes.id
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = utilidad.idCliente
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                WHERE utilidad.fechaUtilidad BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY utilidad.idCliente");

        }else{


          $stmt = Conexion::conectar()->prepare("SELECT clientes.id,usuarios.nombre,clientes.nombreCliente,
                                                       (clientes.interesMensualCliente*utilidad.utilidadDos)+
                                                        SUM(pagosTarjeta.valorInteresClienteTarjeta) AS utilidadTotalDos,
                                                        utilidad.fechaUtilidad
                                                FROM clientes
                                                INNER JOIN utilidad on utilidad.idCliente = clientes.id
                                                INNER JOIN pagosTarjeta on pagosTarjeta.idClienteTarjeta = utilidad.idCliente
                                                INNER JOIN usuarios on usuarios.id = clientes.idUsuario
                                                WHERE utilidad.fechaUtilidad BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY utilidad.idCliente");

        }

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

      }

    }


    /*====================================
    TABLA DE PRESTAMOS
    ====================================*/

    static public function mdlMostrarReposteExcelUtilidad($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,clientes.nombreCliente,clientes.valorTotalInteresCliente,
                                              clientes.fechaPrestamoCliente
                                              FROM clientes
                                              INNER JOIN usuarios ON usuarios.id = clientes.idUsuario");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,clientes.nombreCliente,clientes.valorTotalInteresCliente,
                                               clientes.fechaPrestamoCliente
                                               FROM clientes
                                               INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                               WHERE clientes.fechaPrestamoCliente like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,clientes.nombreCliente,clientes.valorTotalInteresCliente,
                                                 clientes.fechaPrestamoCliente
                                                 FROM clientes
                                                 INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                 WHERE clientes.fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{


           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,clientes.nombreCliente,clientes.valorTotalInteresCliente,
                                                 clientes.fechaPrestamoCliente
                                                 FROM clientes
                                                 INNER JOIN usuarios ON usuarios.id = clientes.idUsuario
                                                 WHERE clientes.fechaPrestamoCliente BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;

    }

    static public function mdlDescargarReporteInteres($fechaInicial,$fechaFinal){

      if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                clientes.nombreCliente,pagosTarjeta.valorInteresClienteTarjeta AS interes,
                                                pagosTarjeta.fechaPagoClienteTarjeta FROM pagosTarjeta
                                                INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                INNER JOIN usuarios ON usuarios.id = pagosTarjeta.idUsuarioTarjeta
                                                WHERE pagosTarjeta.valorInteresClienteTarjeta <> 0");

        $stmt -> execute();

        return $stmt -> fetchAll();

       }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                 clientes.nombreCliente,pagosTarjeta.valorInteresClienteTarjeta AS interes,
                                                 pagosTarjeta.fechaPagoClienteTarjeta FROM pagosTarjeta
                                                 INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                 INNER JOIN usuarios ON usuarios.id = pagosTarjeta.idUsuarioTarjeta
                                                 WHERE pagosTarjeta.valorInteresClienteTarjeta <> 0
                                                 AND pagosTarjeta.fechaPagoClienteTarjeta like '%$fechaFinal%'");

         $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

         $stmt -> execute();

         return $stmt -> fetchAll();

       }else{

         $fechaActual = new DateTime();
         $fechaActual ->add(new DateInterval("P1D"));
         $fechaActualMasUno = $fechaActual->format("Y-m-d");

         $fechaFinal2 = new DateTime($fechaFinal);
         $fechaFinal2 ->add(new DateInterval("P1D"));
         $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

         if($fechaFinalMasUno == $fechaActualMasUno){

           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                   clientes.nombreCliente,pagosTarjeta.valorInteresClienteTarjeta AS interes,
                                                   pagosTarjeta.fechaPagoClienteTarjeta FROM pagosTarjeta
                                                   INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                   INNER JOIN usuarios ON usuarios.id = pagosTarjeta.idUsuarioTarjeta
                                                   WHERE pagosTarjeta.valorInteresClienteTarjeta <> 0
                                                   AND pagosTarjeta.fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }else{


           $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre,
                                                   clientes.nombreCliente,pagosTarjeta.valorInteresClienteTarjeta AS interes,
                                                   pagosTarjeta.fechaPagoClienteTarjeta FROM pagosTarjeta
                                                   INNER JOIN clientes on clientes.id = pagosTarjeta.idClienteTarjeta
                                                   INNER JOIN usuarios ON usuarios.id = pagosTarjeta.idUsuarioTarjeta
                                                   WHERE pagosTarjeta.valorInteresClienteTarjeta <> 0
                                                   AND pagosTarjeta.fechaPagoClienteTarjeta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

         $stmt -> execute();

         return $stmt -> fetchAll();


       }

      $stmt -> close();

      $stmt = null;
    }


    /*====================================
    TABLA DE EFECTIVO
    ====================================*/
    static public function mdlMostrarTablaUtilidadTres($item,$valor,$fechaInicial,$fechaFinal){

        $stmt = Conexion::conectar()->prepare("SELECT clientes.id,usuarios.nombre,clientes.nombreCliente,clientes.dineroPrestadoCliente FROM clientes
                                               INNER JOIN usuarios ON usuarios.id = clientes.idUsuario");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlMostrarTablaUtilidadTresPagos($item,$valor,$fechaInicial,$fechaFinal){

              if($fechaInicial == null){

                $stmt = Conexion::conectar()->prepare("SELECT pagoClienteTarjeta,fechaPagoClienteTarjeta
                                                       FROM pagosTarjeta where idClienteTarjeta = $item AND pagoClienteTarjeta <> 0");

                $stmt -> execute();

                return $stmt -> fetchAll();

               }else if($fechaInicial == $fechaFinal){

                 $stmt = Conexion::conectar()->prepare("SELECT pagoClienteTarjeta,fechaPagoClienteTarjeta
                                                        FROM pagosTarjeta where idClienteTarjeta = $item AND pagoClienteTarjeta <> 0");

                 $stmt -> execute();

                 return $stmt -> fetchAll();

               }else{

                 $fechaActual = new DateTime();
                 $fechaActual ->add(new DateInterval("P1D"));
                 $fechaActualMasUno = $fechaActual->format("Y-m-d");

                 $fechaFinal2 = new DateTime($fechaFinal);
                 $fechaFinal2 ->add(new DateInterval("P1D"));
                 $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

                 if($fechaFinalMasUno == $fechaActualMasUno){

                   $stmt = Conexion::conectar()->prepare("SELECT pagoClienteTarjeta,fechaPagoClienteTarjeta
                                                          FROM pagosTarjeta where idClienteTarjeta = $item AND pagoClienteTarjeta <> 0");

                   $stmt -> execute();

                   return $stmt -> fetchAll();

                 }else{


                   $stmt = Conexion::conectar()->prepare("SELECT pagoClienteTarjeta,fechaPagoClienteTarjeta
                                                          FROM pagosTarjeta where idClienteTarjeta = $item AND pagoClienteTarjeta <> 0");

                   $stmt -> execute();

                   return $stmt -> fetchAll();

                 }


               }

              $stmt -> close();

              $stmt = null;

    }




  }

?>
