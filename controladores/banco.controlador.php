<?php

class ControladorBanco{

  /*=============================================
  AGREGAR BILLETERA
  =============================================*/
  static public function crtAgregarBanco(){

    if(isset($_POST["usuarioBanco"])){

      $valorBanco = str_replace(',','',$_POST["dineroBanco"]);
      if($_POST["signoBanco"] === '-'){
         $valorBanco = ($valorBanco*-1);
      }else{
         $valorBanco = str_replace(',','',$_POST["dineroBanco"]);
      }

      $datos = array("idUsuarioBanco"=>$_POST["usuarioBanco"],
                     "nombreBanco"=>$_POST["nombreBanco"],
                     "valorBanco"=>$valorBanco,
                     "fechaBanco"=>$_POST["fechaBanco"]);

      $respuesta = ModeloBanco::mdlCrearBanco($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Banco ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "banco";

                }
              })

        </script>';
      }else{

        echo'<script>

        swal({
            type: "error",
            title: "Banco no ha sido guardado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "bancp";

                }
              })

        </script>';

      }

    }

  }

  /*=============================================
    MOSTRAR GASTOS
  =============================================*/
  static public function ctrMostrarBanco($item, $valor){
    $respuesta = ModeloBanco::mdlMostrarBanco($item, $valor);
    return $respuesta;
  }


  /*=============================================
  EDITAR GASTOS
  =============================================*/

  static public function crtEditarBanco(){

    if(isset($_POST["idEditarBanco"])){

      $datos = array("idBanco"=>$_POST["idEditarBanco"],
                     "idUsuarioBanco"=>$_POST["editarUsuarioBanco"],
                     "nombreBanco"=>$_POST["editarNombreBanco"],
                     "valorBanco"=>str_replace(',','',$_POST["editarDineroBanco"]),
                     "fechaBanco"=>$_POST["editarFechaBanco"]);

          $respuesta = ModeloBanco::mdlEditarBanco($datos);

          if($respuesta == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Banco ha sido cambiado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "banco";

                  }
                })

          </script>';

        }



    }

  }

  /*=============================================
  ELIMINAR BILLETERA
  =============================================*/

  static public function ctrEliminarBanco(){

    if(isset($_GET["idbanco"])){

      $datos = $_GET["idbanco"];

      $respuesta = ModeloBanco::mdlEliminarBanco($datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "Banco ha sido borrado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then(function(result){
                if (result.value) {

                window.location = "banco";

                }
              })

        </script>';

      }

    }

  }

}

?>
