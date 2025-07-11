<?php
require_once "conexion.php";

class ModeloBanco{

  static public function mdlCrearBanco($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO banco(idUsuarioBanco,nombreBanco,valorBanco,fechaBanco) VALUES (:idUsuarioBanco,:nombreBanco,:valorBanco,:fechaBanco)");
    $stmt->bindParam(":idUsuarioBanco", $datos["idUsuarioBanco"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreBanco", $datos["nombreBanco"], PDO::PARAM_STR);
    $stmt->bindParam(":valorBanco", $datos["valorBanco"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaBanco", $datos["fechaBanco"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }


  /*=============================================
    MOSTRAR BANCO
  =============================================*/

  static public function mdlMostrarBanco($item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM banco WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM banco INNER JOIN usuarios on usuarios.id = banco.idUsuarioBanco");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  EDITAR CLIENTE
  =============================================*/

  static public function mdlEditarBanco($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE banco SET idUsuarioBanco = :idUsuarioBanco, nombreBanco = :nombreBanco, valorBanco = :valorBanco, fechaBanco = :fechaBanco WHERE idBanco = :idBanco");

    $stmt->bindParam(":idBanco", $datos["idBanco"], PDO::PARAM_INT);
    $stmt->bindParam(":idUsuarioBanco", $datos["idUsuarioBanco"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreBanco", $datos["nombreBanco"], PDO::PARAM_STR);
    $stmt->bindParam(":valorBanco", $datos["valorBanco"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaBanco", $datos["fechaBanco"], PDO::PARAM_STR);

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

  static public function mdlEliminarBanco($datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM banco WHERE idBanco = :id");

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
