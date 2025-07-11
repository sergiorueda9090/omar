<?php
class ControladorGasto{


  /*=============================================
  AGREGAR GASTOS
  =============================================*/
  static public function ctrCrearGasto(){

    if(isset($_POST["nombreGasto"])){

      $id = $_POST["nombreUsuariogasto"];
      $valorGasto = str_replace(',','',$_POST["valorGasto"]);
      if($_POST["signoGasto"] === '-'){
        $valorGasto = ($valorGasto*-1);
      }else{
        $valorGasto = str_replace(',','',$_POST["valorGasto"]);
      }

      $datos = array("idUsuarioGasto"=>$id,
                     "nombreGasto"=>$_POST["nombreGasto"],
                     "valorGasto"=>$valorGasto,
                     "fechaGasto"=>$_POST["fechaGasto"]);

      $respuesta = ModeloGasto::mdlCrearGasto($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El gasto ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "gastos";

                }
              })

        </script>';
      }else{

        echo'<script>

        swal({
            type: "error",
            title: "El gasto no ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "gastos";

                }
              })

        </script>';

      }

    }

  }


  /*=============================================
    MOSTRAR GASTOS
  =============================================*/
  static public function ctrMostrarGasto($item, $valor){
    $respuesta = ModeloGasto::mdlMostrarGasto($item, $valor);
    return $respuesta;
  }


  /*=============================================
  EDITAR GASTOS
  =============================================*/

	static public function ctrEditarGasto(){

		if(isset($_POST["idEditarGasto"])){

   		$datos = array("idGastos"=>$_POST["idEditarGasto"],
                     "nombreGasto"=>$_POST["nombreEditarGasto"],
			               "valorGasto"=>str_replace(',','',$_POST["valorEditarGasto"]),
                     "idUsuarioGasto"=>$_POST["nombreUsuarioEditarGasto"],
                     "fechaGasto"=>$_POST["fechaGastoEditar"]);

			   	$respuesta = ModeloGasto::mdlEditarGasto($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El gasto ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "gastos";

									}
								})

					</script>';

				}



		}

	}


  /*=============================================
	ELIMINAR GASTO
	=============================================*/

	static public function ctrEliminarGasto(){

		if(isset($_GET["gastos"])){

			$datos = $_GET["gastos"];

			$respuesta = ModeloGasto::mdlEliminarGasto($datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El gasto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "gastos";

								}
							})

				</script>';

			}

		}

	}

}

?>
