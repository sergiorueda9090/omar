<?php
require_once "conexion.php";

class ModeloBilletera{

  /*=============================================
	AGREGAR GASTO
	=============================================*/

  static public function mdlCrearBilletera($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO billetera(idUsuarioBilletera,nombreBilletera,valorBilletera,fechaBilletera) VALUES (:idUsuarioBilletera,:nombreBilletera,:valorBilletera,:fechaBilletera)");
    $stmt->bindParam(":idUsuarioBilletera", $datos["idUsuarioBilletera"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreBilletera", $datos["nombreBilletera"], PDO::PARAM_STR);
    $stmt->bindParam(":valorBilletera", $datos["valorBilletera"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaBilletera", $datos["fechaBilletera"], PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }

  /*=============================================
    MOSTRAR GASTOS
  =============================================*/

  static public function mdlMostrarBilletera($item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM billetera WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM billetera INNER JOIN usuarios on usuarios.id = billetera.idUsuarioBilletera");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  EDITAR CLIENTE
  =============================================*/

  static public function mdlEditarBilletera($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE billetera SET idUsuarioBilletera = :idUsuarioBilletera, nombreBilletera = :nombreBilletera, valorBilletera = :valorBilletera, fechaBilletera = :fechaBilletera WHERE idBilletera = :idBilletera");

    $stmt->bindParam(":idBilletera", $datos["idBilletera"], PDO::PARAM_INT);
    $stmt->bindParam(":idUsuarioBilletera", $datos["idUsuarioBilletera"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreBilletera", $datos["nombreBilletera"], PDO::PARAM_STR);
    $stmt->bindParam(":valorBilletera", $datos["valorBilletera"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaBilletera", $datos["fechaBilletera"], PDO::PARAM_STR);

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

  static public function mdlEliminarBilletera($datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM billetera WHERE idBilletera = :id");

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
