<?php
require_once "conexion.php";

class ModeloCobrosDelDia{

  static public function mdlMostrarCobrosDelDia($hoy){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM cuotas
                                             INNER JOIN clientes ON clientes.id = cuotas.idClienteCuota
                                             WHERE estado = 1
                                             GROUP BY idClienteCuota
                                             ORDER BY CAST(clientes.numeroTarjetaCliente AS DECIMAL(10,2)) ASC");

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

  }

}


?>
