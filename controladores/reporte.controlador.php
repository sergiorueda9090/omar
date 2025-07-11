<?php
session_start();
  class ReporteControlador{

    static public function ctrMostrarUsuario($idUsuario){
      $respuesta = ReporteModelo::mdlMostrarUsuario($idUsuario);
      return $respuesta;
    }
    /*====================================
    TABLA DE COBROS
    ====================================*/
    static public function ctrMostrarReportePagos($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarReportePagos($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    static public function ctrMostrarReportePagosUnique($fechaInicial,$fechaFinal,$idUserUnique){
      $respuesta = ReporteModelo::mdlMostrarReportePagosUnique($fechaInicial,$fechaFinal,$idUserUnique);
      return $respuesta;
    }

    static public function ctrMostrarReportePagosPost($fechaInicial,$fechaFinal,$idUsuario){
      $respuesta = ReporteModelo::mdlMostrarReportePagosPost($fechaInicial,$fechaFinal,$idUsuario);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE COBRADORES
    ====================================*/
    static public function ctrGraficaCobradores($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlGraficaCobradores($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE COBRADORES
    ====================================*/
    static public function ctrRangoFechasCobros($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasCobro($fechaInicial, $fechaFinal);
      return $respuesta;
    }


    /*====================================
    TABLA DE PRESTAMOS
    ====================================*/
    static public function ctrMostrarTablaPrestamos($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarTablaPrestamos($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    static public function ctrMostrarTablaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario){
      $respuesta = ReporteModelo::mdlMostrarTablaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE PRESTAMOS
    ====================================*/
    static public function ctrGraficaPrestamos($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlGraficaPrestamos($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE PRESTAMOS
    ====================================*/
    static public function ctrRangoFechasPrestamos($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasPrestamos($fechaInicial, $fechaFinal);
      return $respuesta;
    }


    /*====================================
    TABLA DE GASTOS
    ====================================*/
    static public function ctrMostrarTablaGasto($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarTablaGasto($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE GASTO
    ====================================*/
    static public function ctrGasto($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlGasto($fechaInicial,$fechaFinal);
      return $respuesta;
    }


    /*====================================
    ESTADISTICA DE GASTOS
    ====================================*/
    static public function ctrRangoFechasGastos($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasGastos($fechaInicial, $fechaFinal);
      return $respuesta;
    }

    /*====================================
    TABLA BILLETERA
    ====================================*/
    static public function ctrMostrarReporteBilletera($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarReporteBilletera($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE BILLETERA
    ====================================*/
    static public function ctrBilletera($fechaInicial,$fechaFinal ){
      $respuesta = ReporteModelo::mdlBilletera($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE BILLETERA
    ====================================*/
    static public function ctrRangoFechasBilletera($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasBilletera($fechaInicial, $fechaFinal);
      return $respuesta;
    }

    /*====================================
    TABLA BANCO
    ====================================*/
    static public function ctrMostrarReporteBanco($item,$valor,$fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarReporteBanco($item,$valor,$fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE BILLETERA
    ====================================*/
    static public function ctrBanco($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlBanco($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE BANCO
    ====================================*/
    static public function ctrRangoFechasBanco($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasBanco($fechaInicial, $fechaFinal);
      return $respuesta;
    }

    /*====================================
    TABLA EFECTIVO
    ====================================*/
    static public function ctrMostrarReporteEfectivo($item,$valor,$fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarReporteEfectivo($item,$valor,$fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    GRAFICA DE EFECTIVO
    ====================================*/
    static public function ctrEfectivo($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlEfectivo($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE EFECTIVO
    ====================================*/
    static public function ctrRangoFechasEfectivo($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlRangoFechasEfectivo($fechaInicial, $fechaFinal);
      return $respuesta;
    }


    /*====================================
    DESCARGAR EXCEL PRESTAMOS
    ====================================*/
    public function ctrDescargarReporteExcel(){
      /*====================================
      TABLA DE PRESTAMOS
      ====================================*/
      $respuesta = ReporteModelo::mdlMostrarReposteExcel($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    public function ctrDescargarReporteExcelGobal($fechaInicial,$fechaFinal,$nombreTabla){
      $respuesta = ReporteModelo::mdlMostrarReposteExcelGobal($fechaInicial,$fechaFinal,$nombreTabla);
      return $respuesta;
    }


    /*====================================
    TOTAL COBROS POR PRESTAMISTA
    ====================================*/
    static public function ctrGraficaCobradoresPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
          $idUsuario = $_POST["usuarioReporte"];
          $_SESSION["idUsuarioSession"] = $idUsuario;
          $respuesta = ReporteModelo::mdlGraficaCobradoresPost($fechaInicial,$fechaFinal,$idUsuario);
          return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlGraficaCobradoresPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL PRESTAMOS POR PRESTAMISTA
    ====================================*/
    static public function ctrGraficaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlGraficaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlGraficaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }

    }

    /*====================================
    TOTAL GASTO TABLA
    ====================================*/
    static public function ctrMostrarTablaGastoPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlMostrarTablaGastoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlMostrarTablaGastoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL GASTO PRESTAMISTA
    ====================================*/
    static public function ctrGastoPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlGastoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlGastoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL PAGOS EN EFECTIVO
    ====================================*/
    static public function ctrEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlEfectivoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlEfectivoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL TABLA PAGOS EN EFECTIVO
    ====================================*/
    static public function ctrMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }

    }

    /*====================================
    TOTAL TABLA PAGOS EN BANCO
    ====================================*/
    static public function ctrMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL PRESTAMISTAS PAGOS EN BANCO
    ====================================*/
    static public function ctrBancoPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlBancoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlBancoPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL TABLA BILLETERA
    ====================================*/
    static public function ctrMostrarReporteBilleteraPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlMostrarReporteBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlMostrarReporteBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }

    /*====================================
    TOTAL RESTAMISTAS PAGOS BILLETERA
    ====================================*/
    static public function ctrBilleteraPost($fechaInicial,$fechaFinal,$idUsuario = null){
      if(isset($_POST["usuarioReporte"])){
        $idUsuario = $_POST["usuarioReporte"];
        $respuesta = ReporteModelo::mdlBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }else{
        $respuesta = ReporteModelo::mdlBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
        return $respuesta;
      }
    }


    /*====================================
    UTILIDAD UNO
    ====================================*/
    static public function ctrUtilidadUno($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlUtilidadUno($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    /*====================================
    ESTADISTICA DE UTILIDAD UNO
    ====================================*/
    static public function ctrEstadisticaUtilidadUno($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlEstadisticaUtilidadUno($fechaInicial, $fechaFinal);
      return $respuesta;
    }

    /*====================================
    UTILIDAD DOS
    ====================================*/
    static public function ctrUtilidadDos($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlUtilidadDos($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    static public function ctrUtilidadDosDos($fechaInicial,$fechaFinal,$id){
      $respuesta = ReporteModelo::mdlUtilidadDosDos($fechaInicial,$fechaFinal,$id);
      return $respuesta;
    }



    /*static public function ctrUtilidadDosInteres($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlUtilidadDosInteres($fechaInicial,$fechaFinal);
      return $respuesta;
    }*/



    /*====================================
    ESTADISTICA DE UTILIDAD DOS
    ====================================*/
    static public function ctrEstadisticaUtilidadDos($fechaInicial, $fechaFinal){
      $respuesta = ReporteModelo::mdlEstadisticaUtilidadDos($fechaInicial, $fechaFinal);
      return $respuesta;
    }


    /*====================================
    DESCARGAR EXCEL UTILIDAD
    ====================================*/
    public function ctrDescargarReporteExcelUtilidad($fechaInicial,$fechaFinal){
      /*====================================
      TABLA DE PRESTAMOS
      ====================================*/
      $respuesta = ReporteModelo::mdlMostrarReposteExcelUtilidad($fechaInicial,$fechaFinal);
      return $respuesta;
    }

    public function ctrDescargarReporteInteres($fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlDescargarReporteInteres($fechaInicial,$fechaFinal);
      return $respuesta;
    }


    /*====================================
    TABLA UTILIDAD TRES
    ====================================*/
    static public function ctrMostrarTablaUtilidadTres($item,$valor,$fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarTablaUtilidadTres($item,$valor,$fechaInicial,$fechaFinal);
      return $respuesta;
    }

    static public function ctrMostrarTablaUtilidadTresPagos($item,$valor,$fechaInicial,$fechaFinal){
      $respuesta = ReporteModelo::mdlMostrarTablaUtilidadTresPagos($item,$valor,$fechaInicial,$fechaFinal);
      return $respuesta;
    }


  }

?>
