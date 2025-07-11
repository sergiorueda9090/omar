$(document).ready(function(){
  $(".valorGasto").number(true);
  $(".valorEditarGasto").number(true);

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
    $(".fechaGasto").val(ano+"-"+mes+"-"+dia);
})

/*=============================================
EDITAR GASTO
=============================================*/
$(".tablas").on("click", ".btnEditarGasto", function(){
var idGasto = $(this).attr("idGasto");
var datos = new FormData();
    datos.append("idGasto", idGasto);

  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $(".nombreEditarGasto").val(respuesta['nombreGasto']);
      $(".valorEditarGasto").val(respuesta['valorGasto']);
      $(".idEditarGasto").val(respuesta['idGastos']);
      //$(".nombreUsuariogasto")
      $(".nombreUsuarioEditarGasto").val(respuesta['idUsuarioGasto']);
      $(".fechaGastoEditar").val(respuesta['fechaGasto']);
  }

	})

})


$(document).on('click','.btnEliminarGasto',function(){
  var idGasto = $(this).attr("idGasto");
  swal({
        title: '¿Está seguro de borrar el gasto?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar gasto!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=gastos&gastos="+idGasto;
        }

  })

})
