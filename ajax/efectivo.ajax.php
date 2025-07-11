<?php

require_once "../controladores/efectivo.controlador.php";
require_once "../modelos/efectivo.modelo.php";

class AjaxEfectivo{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/
	public $idEfectivo;
	public function ajaxEditarEfectivo(){
		$item = "idEfectivo";
		$valor = $this->idEfectivo;
		$respuesta = ControladorEfectivo::ctrMostrarEfectivo($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/
if(isset($_POST["idEfectivo"])){
	$cliente = new AjaxEfectivo();
	$cliente -> idEfectivo = $_POST["idEfectivo"];
	$cliente -> ajaxEditarEfectivo();
}
