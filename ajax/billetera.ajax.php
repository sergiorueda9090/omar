<?php

require_once "../controladores/billetera.controlador.php";
require_once "../modelos/billetera.modelo.php";

class AjaxBilletera{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/
	public $idBilletera;
	public function ajaxEditarBilletera(){
		$item = "idBilletera";
		$valor = $this->idBilletera;
		$respuesta = ControladorBilletera::ctrMostrarGasto($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/
if(isset($_POST["idBilletera"])){
	$cliente = new AjaxBilletera();
	$cliente -> idBilletera = $_POST["idBilletera"];
	$cliente -> ajaxEditarBilletera();
}
