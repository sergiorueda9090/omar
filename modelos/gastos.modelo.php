<?php
require_once "conexion.php";

class ModeloGasto{

  /*=============================================
	AGREGAR GASTO
	=============================================*/

  static public function mdlCrearGasto($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO gastos(idUsuarioGasto,nombreGasto,valorGasto,fechaGasto) VALUES (:idUsuarioGasto,:nombreGasto,:valorGasto,:fechaGasto)");
    $stmt->bindParam(":idUsuarioGasto", $datos["idUsuarioGasto"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreGasto", $datos["nombreGasto"], PDO::PARAM_STR);
    $stmt->bindParam(":valorGasto", $datos["valorGasto"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaGasto", $datos["fechaGasto"], PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }



  /*=============================================
	MOSTRAR GASTO
	=============================================*/

	static public function mdlMostrarGasto($item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM gastos WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM gastos INNER JOIN usuarios on usuarios.id = gastos.idUsuarioGasto");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

  /*=============================================
  EDITAR CLIENTE
  =============================================*/

  static public function mdlEditarGasto($datos){

    $stmt = Conexion::conectar()->prepare("UPDATE gastos SET idUsuarioGasto = :idUsuarioGasto, nombreGasto = :nombreEditarGasto, valorGasto = :valorEditarGasto, fechaGasto = :fechaGasto WHERE idGastos = :id");

    $stmt->bindParam(":id", $datos["idGastos"], PDO::PARAM_INT);
    $stmt->bindParam(":idUsuarioGasto", $datos["idUsuarioGasto"], PDO::PARAM_INT);
    $stmt->bindParam(":nombreEditarGasto", $datos["nombreGasto"], PDO::PARAM_STR);
    $stmt->bindParam(":valorEditarGasto", $datos["valorGasto"], PDO::PARAM_STR);
    $stmt->bindParam(":fechaGasto", $datos["fechaGasto"], PDO::PARAM_STR);

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

	static public function mdlEliminarGasto($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM gastos WHERE idGastos = :id");

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
