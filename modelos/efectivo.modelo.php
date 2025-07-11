<?php

require_once "conexion.php";

class ModeloEfectivo{

  /*=============================================
  AGREGAR EFECTIVO
  =============================================*/
  static public function mdlCrearEfectivo($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO efectivo(idUsuarioEfectivo,nombreEfectivo,valorEfectivo,fechaEfectivo) VALUES (:idUsuarioEfectivo,:nombreEfectivo,:valorEfectivo,:fechaEfectivo)");
    $stmt->bindParam(":idUsuarioEfectivo", $datos["idUsuarioEfectivo"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreEfectivo", $datos["nombreEfectivo"], PDO::PARAM_STR);
    $stmt->bindParam(":valorEfectivo", $datos["valorEfectivo"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaEfectivo", $datos["fechaEfectivo"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  /*=============================================
    MOSTRAR Efectivo
  =============================================*/

  static public function mdlMostrarEfectivo($item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM efectivo WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM efectivo INNER JOIN usuarios on usuarios.id = efectivo.idUsuarioEfectivo");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  EDITAR CLIENTE
  =============================================*/

  static public function mdlEditarEfectivo($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE efectivo SET idUsuarioEfectivo = :idUsuarioEfectivo, nombreEfectivo = :nombreEfectivo, valorEfectivo = :valorEfectivo, fechaEfectivo = :fechaEfectivo WHERE idEfectivo = :idEfectivo");

    $stmt->bindParam(":idEfectivo", $datos["idEfectivo"], PDO::PARAM_INT);
    $stmt->bindParam(":idUsuarioEfectivo", $datos["idUsuarioEfectivo"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreEfectivo", $datos["nombreEfectivo"], PDO::PARAM_STR);
    $stmt->bindParam(":valorEfectivo", $datos["valorEfectivo"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaEfectivo", $datos["fechaEfectivo"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }


  /*=============================================
  ELIMINAR GASTO
  =============================================*/

  static public function mdlEliminarEfectivo($datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM efectivo WHERE idEfectivo = :id");

    $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}

?>
