<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Billetera

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Billetera</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">

          <div class="input-group">

            <div class="card shadow mb-4">

            <button type="button" class="btn pull-right claseEstado abrirFechas bg-gradient-primary text-white">

              <span>
                <i class="fa fa-calendar mr-2"></i>Rango de fechas
              </span>

              <div class="contenidoFecha fechaSelecionar mt-5" style="display:none;">

                <div class="form-group pull-left">
                  <label for="" class="pull-left">Fecha Inicial</label>
                   <input type="date" class="form-control input-lg fechaInicial" onKeyPress="return validar(event)" id="datepickerInicial" name="fecha-ingreso" placeholder="aaaa/mm/dd" required>
                </div>
                <br>
                <div class="form-group pull-left">
                  <label for="" class="pull-left">Fecha FInal</label>
                   <input type="date" class="form-control input-lg fechaFinal" onKeyPress="return validar(event)" id="datepickerFinal" name="fecha-ingreso" placeholder="aaaa/mm/dd" required>
                </div>

                <br>
                <div class="form-group pull-left">
                  <input class="btn mr-2 btnAplicar" type="button"  value="Aplicar" autocomplete="off" style="background:#000AFF;color:#ffffff;border-radius: 7px 7px 7px 7px;">
                  <input class="btn btn-primary mf-2 btnCancelar" type="button" value="Cancelar" autocomplete="off" style="background:#FFFFFF;color:#676363;border-radius: 7px 7px 7px 7px;">
                  <br>
                  <div class="pull-right" style="margin-top:10px;">
                      <i class="fa fa-caret-up flechaArriba" aria-hidden="true" style="display:none;cursor:pointer;font-size:30px;"></i>
                  </div>
                </div>

              </div>


            <small id="emailHelp" class="form-text smallFecha mt-5 mb-5" style="color:#ffffff;display:none;">
              Seleccionar Fecha
            </small>



            <i class="fa fa-caret-down flechaAbajo"></i>


      </button>


  </div>

            <br>
              <hr>
            <button class="btn btn-success mt-1" data-toggle="modal" data-target="#modalAgregarBilletera">
              Agregar Billetera
            </button>

          </div>

          <div class="box-tools pull-right">

          <?php

          if(isset($_GET["fechaInicial"])){

            echo '<a href="vistas/modulos/reporteExcel/descargar-reporteExcel.php?reporte=billetera&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

          }else{

             echo '<a href="vistas/modulos/reporteExcel/descargar-reporteExcel.php?reporte=billetera">';

          }

          ?>

             <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

            </a>

          </div>

        </div>



      <div class="box-body">

        <?php
        $item = null;
        $valor = null;
        $respuesta = ControladorBilletera::ctrMostrarGasto($item,$valor);
        ?>

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Nombre Usuario</th>
           <th>Descripcion</th>
           <th>Dinero</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>
          <?php

          foreach ($respuesta as $key => $value) {

            echo '<tr>

                <td>'.($key+1).'</td>

                <td>'.$value["nombre"].'</td>

                <td>'.$value["nombreBilletera"].'</td>

                <td>'.number_format($value["valorBilletera"]).'</td>

                <td>'.$value["fechaBilletera"].'</td>

                <td>

                  <div class="btn-group">

                    <button class="btn btn-warning btnEditarBilletera" idBilletera="'.$value["idBilletera"].'" data-toggle="modal" data-target="#modalEditarBilletera"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btnEliminarBilletera" idBilletera="'.$value["idBilletera"].'"><i class="fa fa-times"></i></button>

                  </div>

                </td>

              </tr>';

          };

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR BILLETERA
======================================-->

<div id="modalAgregarBilletera" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Billetera</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            ?>

            <div class="form-group">

              <label for="exampleFormControlSelect1">SELECCIONAR USUARIO</label>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control usuarioBilletera" name="usuarioBilletera">
                  <option value="0">Seleccionar....</option>
                  <?php
                  foreach ($usuarios as $key => $value) {
                    echo '<option value='.$value["id"].'>'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>


            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label for="exampleFormControlSelect1">NOMBRE BILLETERA</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg nombreBilletera" name="nombreBilletera" placeholder="Nombre Billetera" required>

              </div>

            </div>

            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">(-)</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-minus"></i></span>
                    <input type="text" class="form-control input-lg" name="signoBilletera">
                  </div>
                </div>
              </div>

              <div class="col-lg-9">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">DINERO BILLETERA</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                    <input type="text" class="form-control input-lg dineroBilletera" name="dineroBilletera" placeholder="Ingresar Dinero" required>
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">

              <label for="exampleFormControlSelect1">FECHA BILLETERA</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="date" class="form-control input-lg fechaBilletera" name="fechaBilletera" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar billetera</button>

        </div>

      </form>

      <?php
      $agregarBilletera = new ControladorBilletera();
      $agregarBilletera -> crtAgregarBilletera();
      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR BILLETERA
======================================-->

<div id="modalEditarBilletera" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Billetera</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            ?>

            <div class="form-group">

              <label for="exampleFormControlSelect1">SELECCIONAR USUARIO</label>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control editarUsuarioBilletera" name="editarUsuarioBilletera">
                  <option value="0">Seleccionar....</option>
                  <?php
                  foreach ($usuarios as $key => $value) {
                    echo '<option value='.$value["id"].'>'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <label for="exampleFormControlSelect1">NOMBRE BILLETERA</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg editarNombreBilletera" name="editarNombreBilletera" placeholder="Nombre Billetera" required>

              </div>

            </div>

            <div class="form-group">

              <label for="exampleFormControlSelect1">DIENERO BILLETERA</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                <input type="text" class="form-control input-lg editarDineroBilletera" name="editarDineroBilletera" placeholder="Ingresar Dinero" required>

              </div>

            </div>


            <div class="form-group">

              <label for="exampleFormControlSelect1">FECHA BILLETERA</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="date" class="form-control input-lg editarFechaBilletera" name="editarFechaBilletera" required>
                <input type="hidden" class="form-control input-lg idEditarBilletera" name="idEditarBilletera" placeholder="Nombre Billetera" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Editar Billetera</button>

        </div>

      </form>


      <?php
      $editarBilletera = new ControladorBilletera();
      $editarBilletera -> crtEditarBilletera();
      ?>

    </div>

  </div>

</div>

<?php
$elimnarBilletera = new ControladorBilletera();
$elimnarBilletera -> ctrEliminarBilletera();
?>

<script>
$(document).ready(function() {

  $('.fechaInicial').on('keydown', function (e){
       try {
           if ((e.keyCode == 8 || e.keyCode == 46))
               return false;
           else
               return true;
       }
       catch (Exception)
       {
           return false;
       }
   });

     $('.fechaFinal').on('keydown', function (e){
        try {
            if ((e.keyCode == 8 || e.keyCode == 46))
                return false;
            else
                return true;
        }
        catch (Exception)
        {
            return false;
        }
    });

    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año

    var hoy = new Date();
    var DIA_EN_MILISEGUNDOS = 24 * 60 * 60 * 1000;
    var manana = new Date(hoy.getTime()+DIA_EN_MILISEGUNDOS);
    var pasado = new Date(hoy.getTime()+DIA_EN_MILISEGUNDOS+DIA_EN_MILISEGUNDOS);

    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10

    $(".fechaInicial").val(ano + "-" + mes + "-" + manana.getDate());
    $(".fechaFinal").val(ano + "-" + mes + "-" + pasado.getDate());


})

function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8) return false; //Tecla de retroceso (para poder borrar)
  if (tecla==44) return false; //Coma ( En este caso para diferenciar los decimales )
  if (tecla==48) return false;
  if (tecla==49) return false;
  if (tecla==50) return false;
  if (tecla==51) return false;
  if (tecla==52) return false;
  if (tecla==53) return false;
  if (tecla==54) return false;
  if (tecla==55) return false;
  if (tecla==56) return false;
  patron = /1/; //ver nota
  te = String.fromCharCode(tecla);
  return patron.test(te);
}

$(document).on('click', '.btnAplicar', function() {

    var fechaInicial = $(".fechaInicial").val();
    var fechaFinal = $(".fechaFinal").val();

    if (fechaInicial == "") {
        $(".smallFecha").show();
        return;
    } else if (fechaFinal == "") {
        fechaFinal = fechaInicial;
    } else if (fechaInicial == "" && fechaFinal == "") {
        $(".smallFecha").show();
        return;
    } else {
        $(".smallFecha").hide();
    }

     window.location = "index.php?ruta=billetera&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

})


$(document).on('click','.abrirFechas',function(){
  $(".fechaSelecionar").show(500);
  $(".flechaArriba").show(500);
  $(".flechaAbajo").hide(500);
  $(".claseEstado").removeClass('abrirFechas');
   $(".claseEstado").css("cursor", "default");
})

$(document).on('click','.flechaArriba',function(){
  $(".flechaAbajo").show(500);
  $(".flechaArriba").hide(500);
  $(".fechaSelecionar").hide(500);
  $(".claseEstado").addClass('abrirFechas');
  $(".claseEstado").css("cursor","pointer");
})

$(document).on('click','.btnCancelar',function(){
  $('.fechaInicial').on('keydown', function (e){
       try {
           if ((e.keyCode == 8 || e.keyCode == 46))
               return false;
           else
               return true;
       }
       catch (Exception)
       {
           return false;
       }
   });

     $('.fechaFinal').on('keydown', function (e){
        try {
            if ((e.keyCode == 8 || e.keyCode == 46))
                return false;
            else
                return true;
        }
        catch (Exception)
        {
            return false;
        }
    });

    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año

    var hoy = new Date();
    var DIA_EN_MILISEGUNDOS = 24 * 60 * 60 * 1000;
    var manana = new Date(hoy.getTime()+DIA_EN_MILISEGUNDOS);
    var pasado = new Date(hoy.getTime()+DIA_EN_MILISEGUNDOS+DIA_EN_MILISEGUNDOS);

    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10

    $(".fechaInicial").val(ano + "-" + mes + "-" + manana.getDate());
    $(".fechaFinal").val(ano + "-" + mes + "-" + pasado.getDate());

    window.location = "https://omarruedaorbe.com/billetera";

})


</script>
