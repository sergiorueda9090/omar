<?php

class InicioControlador{

  static public function ctrInicioDatos(){

    $respuesta = InicioModel::mdlInicioDatos();
    return $respuesta;

  }

  static public function ctrInicioDatosSaldoAInversion(){

    $respuesta = InicioModel::mdlInicioDatosSaldoAInversion();
    return $respuesta;

  }

  static public function ctrInicioDatosCobros(){
    $respuesta = InicioModel::mdlInicioDatosCobros();
    return $respuesta;
  }

  static public function ctrPorcentajeActivos(){
    $respuesta = InicioModel::mdlPorcentajeActivos();
    return $respuesta;
  }

}

?>
