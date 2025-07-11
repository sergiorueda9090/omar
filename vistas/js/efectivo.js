
window.onload = function(){
  $(".dineroEfectivo").number(true);
  $(".editarDineroEfectivo").number(true);
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
    $(".fechaEfectivo").val(ano+"-"+mes+"-"+dia);
}


/*=============================================
EDITAR GASTO
=============================================*/
$(".tablas").on("click", ".btnEditarEfectivo", function(){
var idEfectivo = $(this).attr("idEfectivo");
var datos = new FormData();
    datos.append("idEfectivo", idEfectivo);

  $.ajax({
    url:"ajax/efectivo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $(".idEditarEfectivo").val(respuesta['idEfectivo']);
      $(".editarUsuarioEfectivo").val(respuesta['idUsuarioEfectivo']);
      $(".editarNombreEfectivo").val(respuesta['nombreEfectivo']);
      $(".editarDineroEfectivo").val(respuesta['valorEfectivo']);
      $(".editarFechaEfectivo").val(respuesta['fechaEfectivo']);
  }

	})

})


$(document).on('click','.btnEliminarEfectivo',function(){
  var idEfectivo = $(this).attr("idEfectivo");
  swal({
        title: '¿Está seguro de borrar Efectivo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Efectivo!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=efectivo&idEfectivo="+idEfectivo;
        }

  })

})
