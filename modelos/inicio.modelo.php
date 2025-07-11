<?php
require_once "conexion.php";

class InicioModel{

  static public function mdlInicioDatos(){

    $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as cantidadUsuarioReporte,(SELECT COUNT(id) FROM clientes WHERE tipoPrestamoCliente = 'mensual' AND estadoCliente = 'ACTIVO') AS mensual,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE estadoCliente = 'ACTIVO') AS saldoAInversionCasita,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE tipoPrestamoCliente = 'mensual' AND estadoCliente = 'ACTIVO') AS saldoAInversionCasitaMensual,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE tipoPrestamoCliente = 'quincenal' AND estadoCliente = 'ACTIVO') AS saldoAInversionCasitaQuincenal,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE tipoPrestamoCliente = 'semanal' AND estadoCliente = 'ACTIVO') AS saldoAInversionCasitaSemanal,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE tipoPrestamoCliente = 'diario' AND estadoCliente = 'ACTIVO') AS saldoAInversionCasitaDiario,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE estadoCliente = 'ACTIVO' ) AS saldoTotalCasita,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE tipoPrestamoCliente = 'mensual' AND estadoCliente = 'ACTIVO') AS saldoTotalCasitaMensual,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE tipoPrestamoCliente = 'quincenal' AND estadoCliente = 'ACTIVO') AS saldoTotalCasitaQuincenal,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE tipoPrestamoCliente = 'semanal' AND estadoCliente = 'ACTIVO') AS saldoTotalCasitaSemanal,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE tipoPrestamoCliente = 'diario' AND estadoCliente = 'ACTIVO') AS saldoTotalCasitaDiario,
                                          (SELECT COUNT(id) FROM clientes WHERE tipoPrestamoCliente = 'quincenal' AND estadoCliente = 'ACTIVO') AS quincenal,
                                          (SELECT COUNT(id) FROM clientes WHERE tipoPrestamoCliente = 'semanal' AND estadoCliente = 'ACTIVO') AS semanal,
                                          (SELECT COUNT(id) FROM clientes WHERE tipoPrestamoCliente = 'diario' AND estadoCliente = 'ACTIVO') AS diario,
                                          (SELECT SUM(dineroPrestadoCliente) FROM clientes WHERE tipoPrestamoCliente = 'mensual' AND estadoCliente = 'ACTIVO') AS dineromensual,
                                          (SELECT SUM(dineroPrestadoCliente) FROM clientes WHERE tipoPrestamoCliente = 'quincenal' AND estadoCliente = 'ACTIVO') AS dineroquincenal,
                                          (SELECT SUM(dineroPrestadoCliente) FROM clientes WHERE tipoPrestamoCliente = 'semanal' AND estadoCliente = 'ACTIVO') AS dinerosemanal,
                                          (SELECT SUM(dineroPrestadoCliente) FROM clientes WHERE tipoPrestamoCliente = 'diario' AND estadoCliente = 'ACTIVO') AS dinerodiario,
                                          (SELECT SUM(saldoTotalPagarCliente) FROM clientes WHERE tipoPrestamoCliente = 'diario' AND estadoCliente = 'ACTIVO') AS dineroTotaldiario,
                                          (SELECT SUM(saldoTotalPagarCliente) FROM clientes WHERE tipoPrestamoCliente = 'semanal' AND estadoCliente = 'ACTIVO') AS dineroTotalsemanal,
                                          (SELECT SUM(saldoTotalPagarCliente) FROM clientes WHERE tipoPrestamoCliente = 'quincenal' AND estadoCliente = 'ACTIVO') AS dineroTotalquincenal,
                                          (SELECT SUM(saldoTotalPagarCliente) FROM clientes WHERE tipoPrestamoCliente = 'mensual' AND estadoCliente = 'ACTIVO') AS dineroTotalmensual,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE estadoCliente = 'MOROSO') AS dineroMoroso,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE estadoCliente = 'MOROSO') AS saldoTotalMoroso,
                                          (SELECT COUNT(id) FROM clientes WHERE estadoCliente = 'MOROSO') AS cantidadMoroso,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE estadoCliente = 'PERDIDO') AS dineroPerdido,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE estadoCliente = 'PERDIDO') AS saldoTotalPerdido,
                                          (SELECT COUNT(id) FROM clientes WHERE estadoCliente = 'PERDIDO') AS cantidadPerdido,
                                          (SELECT SUM(saldoAinversion) FROM clientes WHERE estadoCliente = 'PAGO') AS dineroPAGO,
                                          (SELECT SUM(saldoTotal) FROM clientes WHERE estadoCliente = 'PAGO') AS saldoTotalPAGO,
                                          (SELECT COUNT(id) FROM clientes WHERE estadoCliente = 'PAGO') AS cantidadPAGO
                                          FROM clientes WHERE estadoCliente = 'ACTIVO'");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;


  }

  static public function mdlInicioDatosSaldoAInversion(){

    /*$stmt = Conexion::conectar()->prepare("SELECT clientes.id,clientes.dineroPrestadoCliente,clientes.saldoTotalPagarCliente,
                                          SUM(pagosTarjeta.pagoClienteTarjeta) AS pagoClienteTarjeta,
                                          SUM(pagosTarjeta.valorInteresClienteTarjeta) AS valorInteresClienteTarjeta,
                                          clientes.dineroPrestadoCliente - sum(pagosTarjeta.pagoClienteTarjeta) - SUM(pagosTarjeta.valorInteresClienteTarjeta) AS DINEROPRESTADOCLIENTE,
                                          clientes.saldoTotalPagarCliente - SUM(pagosTarjeta.pagoClienteTarjeta) AS SALDOAINVERSION
                                          FROM `clientes`
                                          INNER JOIN pagosTarjeta ON clientes.id = pagosTarjeta.idClienteTarjeta
                                          GROUP BY clientes.id");*/
    $stmt = Conexion::conectar()->prepare("SELECT dineroPrestadoCliente,saldoAinversion,saldoTotal FROM clientes");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  static public function mdlInicioDatosCobros(){

    $stmt = Conexion::conectar()->prepare("SELECT SUM(pagoClienteTarjeta)+SUM(valorInteresClienteTarjeta) as total, SUM(pagoClienteTarjeta) as pago  FROM pagosTarjeta
                                           INNER JOIN usuarios on usuarios.id = pagosTarjeta.idUsuarioTarjeta");

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;


  }

  static public function mdlPorcentajeActivos(){

    $stmt = Conexion::conectar()->prepare("SELECT AVG(interesPrestamoCliente) as promedio FROM clientes WHERE estadoCliente = 'ACTIVO'");

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  }

}


?>
