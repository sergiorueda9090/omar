
$(document).ready(function(){
  $(".dineroBanco").number(true);
  $(".editarDineroBanco").number(true);
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
    $(".fechaBanco").val(ano+"-"+mes+"-"+dia);
})


/*=========
/*=============================================
EDITAR GASTO
=============================================*/
$(".tablas").on("click", ".btnEditarBanco", function(){
var idBanco = $(this).attr("idBanco");
var datos = new FormData();
    datos.append("idBanco", idBanco);

  $.ajax({
    url:"ajax/banco.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $(".idEditarBanco").val(respuesta['idBanco']);
      $(".editarUsuarioBanco").val(respuesta['idUsuarioBanco']);
      $(".editarNombreBanco").val(respuesta['nombreBanco']);
      $(".editarDineroBanco").val(respuesta['valorBanco']);
      $(".editarFechaBanco").val(respuesta['fechaBanco']);
  }

	})

})


$(document).on('click','.btnEliminarBanco',function(){
  var idBanco = $(this).attr("idBanco");
  swal({
        title: '¿Está seguro de borrar banco?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar banco!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=banco&idbanco="+idBanco;
        }

  })

})
