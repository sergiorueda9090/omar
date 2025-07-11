$(document).ready(function(){
  $(".dineroBilletera").number(true);
  $(".editarDineroBilletera").number(true);
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
    $(".fechaBilletera").val(ano+"-"+mes+"-"+dia);
})

/*=============================================
EDITAR GASTO
=============================================*/
$(".tablas").on("click", ".btnEditarBilletera", function(){
var idBilletera = $(this).attr("idBilletera");
var datos = new FormData();
    datos.append("idBilletera", idBilletera);

  $.ajax({
    url:"ajax/billetera.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $(".idEditarBilletera").val(respuesta['idBilletera']);
      $(".editarUsuarioBilletera").val(respuesta['idUsuarioBilletera']);
      $(".editarNombreBilletera").val(respuesta['nombreBilletera']);
      $(".editarDineroBilletera").val(respuesta['valorBilletera']);
      $(".editarFechaBilletera").val(respuesta['fechaBilletera']);
  }

	})

})


$(document).on('click','.btnEliminarBilletera',function(){
  var idBilletera = $(this).attr("idBilletera");
  swal({
        title: '¿Está seguro de borrar billetera?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar billetera!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=billetera&billetera="+idBilletera;
        }

  })

})
