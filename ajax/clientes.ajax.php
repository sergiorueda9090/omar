<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;
		$estado = null;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor,$estado);

		echo json_encode($respuesta);


	}

	public $idInformacionCliente;
	public function ajaxInformacionCliente(){

		$item = "id";
		$valor = $this->idInformacionCliente;

		$respuesta = ControladorClientes::ctrInformacionCliente($item, $valor);

	  $valorCuota = number_format($respuesta['valorCuota'], 0, ".", ".");
		$valorCuota = ceil($valorCuota).'.000';

		$saldoTotalCliente = number_format($respuesta['saldoTotalCliente'], 0, ".", ".");

		 if($respuesta["cuotasDebe"] == 0){
			     $saldoTotalCliente = 0;
		 }else{
		    	 $saldoTotalCliente = number_format($respuesta["saldoTotalCliente"]-$respuesta["abonoTotalCliente"]);
		 }

		$data = array('numeroTarjetaCliente'=>$respuesta['numeroTarjetaCliente'],
									'nombreCliente'=>$respuesta['nombreCliente'],
								  'dineroPrestadoCliente'=>number_format($respuesta['dineroPrestadoCliente']),
								  'interesPrestamoCliente'=>$respuesta['interesPrestamoCliente'],
								  'tiempoPrestamoCliente'=>$respuesta['tiempoPrestamoCliente'],
									'tipoPrestamoCliente'=>$respuesta['tipoPrestamoCliente'],
								  'diaPrestamoCliente'=>$respuesta['diaPrestamoCliente'],
								  'diaCobroPrestamoCliente'=>$respuesta['diaCobroPrestamoCliente'],
							    'fechaCuota'=>$respuesta['fechaCuota'],
								  'valorCuota'=>number_format($respuesta['valorCuota']),
								  'estado'=>$respuesta['estado'],
								  'cantidadCuotas'=>$respuesta['cantidadCuotas'],
								  'cuotasDebe'=>$respuesta['cuotasDebe'],
								  'cuotasPagas'=>$respuesta['cuotasPagas'],
								  'abonoTotalCliente'=>number_format($respuesta['abonoTotalCliente']),
								  'saldoTotalCliente'=>$saldoTotalCliente);

		echo json_encode($data);


	}

	public $notaCliente;
	public $valorId;

	public function ajaxClienteNota(){

		$notaCliente = $this->notaCliente;

		$id = $this->valorId;

		$respuesta = ControladorClientes::ctrCreateUpdateNote($notaCliente, $id);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
INFORMACION CLIENTE
=============================================*/
if(isset($_POST["idInformacionCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idInformacionCliente = $_POST["idInformacionCliente"];
	$cliente -> ajaxInformacionCliente();

}


/*=============================================
INFORMACION CLIENTE
=============================================*/
if(isset($_POST["notaCliente"])){
	$cliente = new AjaxClientes();
	$cliente -> notaCliente = $_POST["notaCliente"];
	$cliente -> valorId = $_POST["valorId"];
	$cliente -> ajaxClienteNota();

}
