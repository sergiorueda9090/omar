<?php
class ControladorEfectivo{

  /*=============================================
  AGREGAR EFECTIVO
  =============================================*/
  static public function crtAgregarEfectivo(){

    if(isset($_POST["usuarioEfectivo"])){

      $valorEfectivo = str_replace(',','',$_POST["dineroEfectivo"]);

      if($_POST["signoEfectivo"] === '-'){
        $valorEfectivo = ($valorEfectivo*-1);
      }else{
        $valorEfectivo = str_replace(',','',$_POST["dineroEfectivo"]);
      }

      $datos = array("idUsuarioEfectivo"=>$_POST["usuarioEfectivo"],
                     "nombreEfectivo"=>$_POST["nombreEfectivo"],
                     "valorEfectivo"=>$valorEfectivo,
                     "fechaEfectivo"=>$_POST["fechaEfectivo"]);

      $respuesta = ModeloEfectivo::mdlCrearEfectivo($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Efectivo ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "efectivo";

                }
              })

        </script>';
      }else{

        echo'<script>

        swal({
            type: "error",
            title: "Efectivo no ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "efectivo";

                }
              })

        </script>';

      }

    }

  }

  /*=============================================
    MOSTRAR EFECTIVO
  =============================================*/
  static public function ctrMostrarEfectivo($item, $valor){
    $respuesta = ModeloEfectivo::mdlMostrarEfectivo($item, $valor);
    return $respuesta;
  }

  /*=============================================
  EDITAR EFECTIVO
  =============================================*/

  static public function crtEditarEfectivo(){

    if(isset($_POST["idEditarEfectivo"])){

      $datos = array("idEfectivo"=>$_POST["idEditarEfectivo"],
                     "idUsuarioEfectivo"=>$_POST["editarUsuarioEfectivo"],
                     "nombreEfectivo"=>$_POST["editarNombreEfectivo"],
                     "valorEfectivo"=>str_replace(',','',$_POST["editarDineroEfectivo"]),
                     "fechaEfectivo"=>$_POST["editarFechaEfectivo"]);

          $respuesta = ModeloEfectivo::mdlEditarEfectivo($datos);

          if($respuesta == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Efectivo ha sido cambiado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "efectivo";

                  }
                })

          </script>';

        }



    }

  }


  /*=============================================
  ELIMINAR EFECTIVO
  =============================================*/

  static public function ctrEliminarEfectivo(){

    if(isset($_GET["idEfectivo"])){

      $datos = $_GET["idEfectivo"];

      $respuesta = ModeloEfectivo::mdlEliminarEfectivo($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Efectivo ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then(function(result){
                if (result.value) {

                window.location = "efectivo";

                }
              })

        </script>';

      }

    }

  }


}

?>
