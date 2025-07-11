<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		/*$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario,numeroTarjetaCliente,nombreCliente,zonaPrestamoCliente,dineroPrestadoCliente,interesPrestamoCliente,tiempoPrestamoCliente,tipoPrestamoCliente,diaPrestamoCliente,diaCobroPrestamoCliente,fechaPrestamoCliente,fechaFinPrestamoCliente,interesMensualCliente,numeroCuotasCliente,valorCuotaCliente,valorTotalInteresCliente,saldoTotalPagarCliente)
																				   VALUES (:idUsuario,:numeroTarjetaCliente,:nombreCliente,:zonaPrestamoCliente,:dineroPrestadoCliente,:interesPrestamoCliente,:tiempoPrestamoCliente,:tipoPrestamoCliente,:diaPrestamoCliente,:diaCobroPrestamoCliente,:fechaPrestamoCliente,f:echaFinPrestamoCliente,:interesMensualCliente,:numeroCuotasCliente,:valorCuotaCliente,:valorTotalInteresCliente,:saldoTotalPagarCliente)");

		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":numeroTarjetaCliente", $datos["numeroTarjetaCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":zonaPrestamoCliente", $datos["zonaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":dineroPrestadoCliente", $datos["dineroPrestadoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":interesPrestamoCliente", $datos["interesPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempoPrestamoCliente", $datos["tiempoPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoPrestamoCliente", $datos["tipoPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":diaPrestamoCliente", $datos["diaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":diaCobroPrestamoCliente", $datos["diaCobroPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaPrestamoCliente", $datos["fechaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaFinPrestamoCliente", $datos["fechaFinPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":interesMensualCliente", $datos["interesMensualCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":numeroCuotasCliente", $datos["numeroCuotasCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":valorCuotaCliente", $datos["valorCuotaCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":valorTotalInteresCliente", $datos["valorTotalInteresCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":saldoTotalPagarCliente", $datos["saldoTotalPagarCliente"], PDO::PARAM_STR);*/

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario,numeroTarjetaCliente,nombreCliente,zonaPrestamoCliente,dineroPrestadoCliente,interesPrestamoCliente,tiempoPrestamoCliente,tipoPrestamoCliente,diaPrestamoCliente,diaCobroPrestamoCliente,fechaPrestamoCliente,fechaFinPrestamoCliente,interesMensualCliente,numeroCuotasCliente,valorCuotaCliente,valorTotalInteresCliente,saldoTotalPagarCliente,estadoCliente,saldoAinversion,saldoTotal) VALUES (:idUsuario,:numeroTarjetaCliente,:nombreCliente,:zonaPrestamoCliente,:dineroPrestadoCliente,:interesPrestamoCliente,:tiempoPrestamoCliente,:tipoPrestamoCliente,:diaPrestamoCliente,:diaCobroPrestamoCliente,:fechaPrestamoCliente,:fechaFinPrestamoCliente,:interesMensualCliente,:numeroCuotasCliente,:valorCuotaCliente,:valorTotalInteresCliente,:saldoTotalPagarCliente,'ACTIVO',:saldoAinversion,:saldoTotal)");

		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":numeroTarjetaCliente", $datos["numeroTarjetaCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":zonaPrestamoCliente", $datos["zonaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":dineroPrestadoCliente", $datos["dineroPrestadoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":interesPrestamoCliente", $datos["interesPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempoPrestamoCliente", $datos["tiempoPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoPrestamoCliente", $datos["tipoPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":diaPrestamoCliente", $datos["diaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":diaCobroPrestamoCliente", $datos["diaCobroPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaPrestamoCliente", $datos["fechaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaFinPrestamoCliente", $datos["fechaFinPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":interesMensualCliente", $datos["interesMensualCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":numeroCuotasCliente", $datos["numeroCuotasCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":valorCuotaCliente", $datos["valorCuotaCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":valorTotalInteresCliente", $datos["valorTotalInteresCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":saldoTotalPagarCliente", $datos["saldoTotalPagarCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":saldoAinversion", $datos["dineroPrestadoCliente"], PDO::PARAM_INT);
		$stmt->bindParam(":saldoTotal", $datos["saldoTotalPagarCliente"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor, $estado){

	    if($item != null){

	        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY CAST(numeroTarjetaCliente AS DECIMAL(10,2)) ASC");

	        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	        $stmt -> execute();

	        return $stmt -> fetch();

	    }else{

	        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estadoCliente = '$estado' ORDER BY CAST(numeroTarjetaCliente AS DECIMAL(10,2)) ASC");

	        $stmt -> execute();

	        return $stmt -> fetchAll();

	    }

	    $stmt -> close();

	    $stmt = null;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numeroTarjetaCliente = :numeroTarjetaCliente, nombreCliente = :nombreCliente, zonaPrestamoCliente = :zonaPrestamoCliente, estadoCliente = :estadoCliente WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":numeroTarjetaCliente", $datos["numeroTarjetaCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":zonaPrestamoCliente", $datos["zonaPrestamoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoCliente", $datos["estadoCliente"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	 SELECCIONAR EL MAXIMO ID
	=============================================*/
	static public function mdlMaximoIdCliente($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maxId FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	 AGREGAMOS LAS CUOTAS
	=============================================*/
	static public function mdlIngresarCuota($tablaCuotas,$maximoId,$id,$valorCuota,$fechaCuotas){
		$estado = 1;
		for($i = 0; $i<count($fechaCuotas); $i++){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaCuotas(idUsuarioCuota,idClienteCuota,fechaCuota,valorCuota,estado) VALUES (:idUsuarioCuota, :idClienteCuota, :fechaCuota ,:valorCuota, :estado)");
			$stmt->bindParam(":idUsuarioCuota", $id, PDO::PARAM_INT);
			$stmt->bindParam(":idClienteCuota", $maximoId, PDO::PARAM_INT);
			$stmt->bindParam(":fechaCuota", $fechaCuotas[$i], PDO::PARAM_STR);
			$stmt->bindParam(":valorCuota", $valorCuota, PDO::PARAM_STR);
			$stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
			$stmt->execute();
		}

			return "ok";
		  $stmt->close();
		  $stmt = null;
	}


	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlInformacionCliente($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT clientes.id as idCliente,numeroTarjetaCliente,nombreCliente,dineroPrestadoCliente,
																										interesPrestamoCliente,tiempoPrestamoCliente,tipoPrestamoCliente,
																										diaPrestamoCliente,diaCobroPrestamoCliente,valorTotalInteresCliente,interesMensualCliente,
																										cuotas.fechaCuota,cuotas.valorCuota,
																										cuotas.estado,tipoPrestamoCliente,numeroCuotasCliente,
																										(SELECT COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor) as cantidadCuotas,
																										(SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor and estado = 1) as cuotasDebe,
																										(SELECT  COUNT(idClienteCuota) FROM cuotas WHERE idClienteCuota = $valor and estado = 0) as cuotasPagas,
																										(SELECT  SUM(pagoClienteTarjeta) FROM pagosTarjeta WHERE idClienteTarjeta = $valor) as abonoTotalCliente,
																										(SELECT  SUM(valorCuota) FROM cuotas WHERE idClienteCuota = $valor) as saldoTotalCliente,
                                                    (SELECT  SUM(valorInteresClienteTarjeta) FROM pagosTarjeta WHERE idClienteTarjeta = $valor) as interesTotalCliente
																										FROM clientes INNER JOIN cuotas on clientes.id = cuotas.idClienteCuota
																										WHERE clientes.id = $valor");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlEditarClienteNota($notaCliente, $id, $table){

		$id = intval($id);

		$stmt = Conexion::conectar()->prepare("UPDATE $table SET notaCliente = :nota WHERE id = :id");

    // Vincular los parámetros con sus valores
    $stmt->bindParam(":nota", $notaCliente, PDO::PARAM_STR);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

		// Mostrar la consulta SQL preparada

		//var_dump($stmt->queryString);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

}
