<?php

require_once "../controladores/banco.controlador.php";
require_once "../modelos/banco.modelo.php";

class AjaxBanco{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/
	public $idBanco;
	public function ajaxEditarBanco(){
		$item = "idBanco";
		$valor = $this->idBanco;
		$respuesta = ControladorBanco::ctrMostrarBanco($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/
if(isset($_POST["idBanco"])){
	$cliente = new AjaxBanco();
	$cliente -> idBanco = $_POST["idBanco"];
	$cliente -> ajaxEditarBanco();
}
