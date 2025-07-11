<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	dineroPrestadoCliente
	interesMensualCliente
	valorCuotaCliente
	valorTotalInteresCliente
	saldoTotalPagarCliente
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["numeroTarjetaCliente"])){

			$id = $_SESSION["id"];

			$tabla = "clientes";

			$datos = array("idUsuario"=>$id,
				             "numeroTarjetaCliente"=>$_POST["numeroTarjetaCliente"],
					           "nombreCliente"=>$_POST["nombreCliente"],
					           "zonaPrestamoCliente"=>$_POST["zonaPrestamoCliente"],
					           "dineroPrestadoCliente"=>str_replace(',','',$_POST["dineroPrestadoCliente"]),
					           "interesPrestamoCliente"=>$_POST["interesPrestamoCliente"],
					           "tiempoPrestamoCliente"=>$_POST["tiempoPrestamoCliente"],
										 "tipoPrestamoCliente"=>$_POST["tipoPrestamoCliente"],
										 "diaPrestamoCliente"=>$_POST["diaPrestamoCliente"],
										 "diaCobroPrestamoCliente"=>$_POST["diaCobroPrestamoCliente"],
										 "fechaPrestamoCliente"=>$_POST["fechaPrestamoCliente"],
										 "fechaFinPrestamoCliente"=>$_POST["fechaFinPrestamoCliente"],
										 "interesMensualCliente"=>str_replace(',','',$_POST["interesMensualCliente"]),
										 "numeroCuotasCliente"=>$_POST["numeroCuotasCliente"],
										 "valorCuotaCliente"=>str_replace(',','',$_POST["valorCuotaCliente"]),
										 "valorTotalInteresCliente"=>str_replace(',','',$_POST["valorTotalInteresCliente"]),
									 	 "saldoTotalPagarCliente"=>str_replace(',','',$_POST["saldoTotalPagarCliente"]));

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					 $respuestaMaxId = ModeloClientes::mdlMaximoIdCliente($tabla);

					 $maximoId = $respuestaMaxId[0]["maxId"];
					 $tablaCuotas = 'cuotas';
					 $valorCuota = str_replace(',','',$_POST["valorCuotaCliente"]);
					 $fechaCuotas = $_POST["fechasTotalesCliente"];
					 $fechaCuotas = explode(",", $fechaCuotas);

					 $respuestaCuotas = ModeloClientes::mdlIngresarCuota($tablaCuotas,$maximoId,$id,$valorCuota,$fechaCuotas);

					 if($respuestaCuotas == "ok"){

						 echo'<script>

						 swal({
								 type: "success",
								 title: "El cliente ha sido guardado correctamente",
								 showConfirmButton: true,
								 confirmButtonText: "Cerrar"
								 }).then(function(result){
										 if (result.value) {

										 window.location = "clientes";

										 }
									 })

						 </script>';
					 }else{

						 echo'<script>

						 swal({
								 type: "error",
								 title: "El cliente no ha sido guardado correctamente",
								 showConfirmButton: true,
								 confirmButtonText: "Cerrar"
								 }).then(function(result){
										 if (result.value) {

										 window.location = "clientes";

										 }
									 })

						 </script>';

					 }



				}



		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor,$estado){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor,$estado);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarNumeroTarjetaCliente"])){

		 $tabla = "clientes";
		 $estado = null;

	 	$datos = array("id"=>$_POST["idClienteEditar"],
			             "numeroTarjetaCliente"=>$_POST["editarNumeroTarjetaCliente"],
			   				   "nombreCliente"=>$_POST["editarNombreCliente"],
					         "zonaPrestamoCliente"=>$_POST["editarZonaPrestamoCliente"],
								 	 "estadoCliente"=>$_POST["editarEstadoCliente"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}



		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	INFORMACION CLIENTE
	=============================================*/
	static public function ctrInformacionCliente($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlInformacionCliente($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrCreateUpdateNote($notaCliente, $id){
		$table = "clientes";
		$respuesta = ModeloClientes::mdlEditarClienteNota($notaCliente, $id, $table);
		return $respuesta;
	}

}
