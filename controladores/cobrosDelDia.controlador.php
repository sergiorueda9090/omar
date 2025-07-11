<?php
date_default_timezone_set('America/Bogota');
class ControladorCobrosDelDia{

  static public function crtMostrarCobrosDelDia(){
    $hoy = date("Y-m-d");
    $antes = '2000-01-01';
    $respuesta = ModeloCobrosDelDia::mdlMostrarCobrosDelDia($hoy,$antes);
    return $respuesta;
  }

}


?>
