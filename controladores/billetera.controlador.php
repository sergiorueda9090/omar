<?php
class ControladorBilletera{

  /*=============================================
  AGREGAR BILLETERA
  =============================================*/
  static public function crtAgregarBilletera(){

    if(isset($_POST["dineroBilletera"])){
      $valorBilletera = str_replace(',','',$_POST["dineroBilletera"]);
      if($_POST["signoBilletera"] === '-'){
        $valorBilletera = ($valorBilletera*-1);
      }else{
        $valorBilletera = str_replace(',','',$_POST["dineroBilletera"]);
      }

      $datos = array("idUsuarioBilletera"=>$_POST["usuarioBilletera"],
                     "nombreBilletera"=>$_POST["nombreBilletera"],
                     "valorBilletera"=>$valorBilletera,
                     "fechaBilletera"=>$_POST["fechaBilletera"]);

      $respuesta = ModeloBilletera::mdlCrearBilletera($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Billetera ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "billetera";

                }
              })

        </script>';
      }else{

        echo'<script>

        swal({
            type: "error",
            title: "Billetera no ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "billetera";

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
    $respuesta = ModeloBilletera::mdlMostrarBilletera($item, $valor);
    return $respuesta;
  }


  /*=============================================
  EDITAR GASTOS
  =============================================*/

  static public function crtEditarBilletera(){

    if(isset($_POST["editarUsuarioBilletera"])){

      $datos = array("idBilletera"=>$_POST["idEditarBilletera"],
                     "idUsuarioBilletera"=>$_POST["editarUsuarioBilletera"],
                     "nombreBilletera"=>$_POST["editarNombreBilletera"],
                     "valorBilletera"=>str_replace(',','',$_POST["editarDineroBilletera"]),
                     "fechaBilletera"=>$_POST["editarFechaBilletera"]);

          $respuesta = ModeloBilletera::mdlEditarBilletera($datos);

          if($respuesta == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Billetera ha sido cambiado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "billetera";

                  }
                })

          </script>';

        }



    }

  }

  /*=============================================
  ELIMINAR BILLETERA
  =============================================*/

  static public function ctrEliminarBilletera(){

    if(isset($_GET["billetera"])){

      $datos = $_GET["billetera"];

      $respuesta = ModeloBilletera::mdlEliminarBilletera($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Billetera ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then(function(result){
                if (result.value) {

                window.location = "billetera";

                }
              })

        </script>';

      }

    }

  }

}
