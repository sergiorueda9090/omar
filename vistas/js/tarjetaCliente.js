
$(document).ready(function(){

  $(".valorPagarTarjetaCliente").number(true);
  $(".valorInteresTarjetaCliente").number(true);
  $(".valorSaldoTarjetaCliente").number(true);

  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
    $(".fechaTarjetaCliente").val(ano+"-"+mes+"-"+dia);
    $(".fechaInteresTarjetaCliente").val(ano+"-"+mes+"-"+dia);
    $(".fechaSaldoTarjetaCliente").val(ano+"-"+mes+"-"+dia);
})

$(document).ready(function() {
  // Cuando se haga clic en el botón "Ocultar", ocultar el div nuevamente
  $("#mostrarBtn").click(function() {
    $("#divNota").show();
  });
});


function PagarMontoCliente(){
  var valorPagarTarjetaCliente = $(".valorPagarTarjetaCliente").val();
  var fechaTarjetaCliente = $(".fechaTarjetaCliente").val();
  var idClienteTarjetaCliente = $(".idClienteTarjetaCliente").val();
}


$(document).on('click','.pagarMotonTarjetaCliente',function(){
  PagarMontoCliente();
})

/*======================================
ELIMINAR CUOTA
========================================*/
$(document).on('click','.btnEliminarPagoCuota',function(){
  var URLactual = window.location;
  var idPagoCuota = $(this).attr("idPagoCuota");
  var valorCuota = $(this).attr('valorCuota');
  var valorPagado = $(this).attr('valorPagado');
  var cantidadCuotas = $(this).attr('cantidadCuotas');
  swal({
        title: '¿Está seguro de borrar el pago?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar pago!'
      }).then(function(result){
        if (result.value) {

            window.location = URLactual+"&idPagoCuota="+idPagoCuota+"&valorCuota="+valorCuota+"&valorPagado="+valorPagado+"&cantidadCuotas="+cantidadCuotas;
        }

  })

})


/*======================================
ELIMINAR INTERES
========================================*/

$(document).on('click','.btnEliminarPagoInteres',function(){
  var URLactual = window.location;
  var idPagoCuotaInteres = $(this).attr("idPagoCuotaInteres");
  var valorInteresSaldoInversion = $(this).attr("valorInteresSaldoInversion");

  swal({
        title: '¿Está seguro de borrar el pago?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar pago!'
      }).then(function(result){
        if (result.value) {

            window.location = URLactual+"&idPagoCuotaInteres="+idPagoCuotaInteres+"&valorInteresSaldoInversion="+valorInteresSaldoInversion;
        }

  })

})

$(document).on('click','.btnPagarInteresTarjeta',function(){

})


/*============================================
CALCULAR SALDO A HOY
========================================*/
$(document).on('change','.tiempoSaldoTarjetaCliente',function(){

var prestamo = $(".dineroPrestadoSaldoTarjetaClienteOculto").val();
var interes = $(".interesSaldoTarjetaCliente").val();
var tiempo = $(".tiempoSaldoTarjetaCliente").val();
var abono = $(".abonoSaldoTarjetaClienteOculto").val();

var tInteres = Number(interes)/100;
var t = Number(prestamo) * Number(tInteres);
var tTiempo = (Number(t)*Number(tiempo))+Number(prestamo);
var abonoTiempo = (Number(tTiempo)-Number(abono));

$(".tSaldoTarjetaCliente").number(true);
$(".tSaldoTarjetaCliente").val(Number(abonoTiempo));


})


$(document).on('click','.ocultarBtnAgregarNota',function(){

  var notaCliente = $('.notaCliente').val();

    // Obtiene la URL actual del navegador
  var url = window.location.href;

  // Analiza la URL para obtener los parámetros
  var parametros = url.split("?")[1];

  // Divide los parámetros en pares clave=valor
  var pares = parametros.split("&");

  // Inicializa una variable para almacenar el valor de "id"
  var valorId = "";

  // Recorre los pares clave=valor para encontrar el valor de "id"
  for (var i = 0; i < pares.length; i++) {
    var par = pares[i].split("=");
    if (par[0] === "id") {
      valorId = par[1];
      break; // Sale del bucle una vez que se encuentra "id"
    }
  }

  if(notaCliente.trim() !== "" && valorId !== ""){

    var datos = new FormData();
        datos.append("notaCliente", notaCliente);
        datos.append("valorId", valorId);

        $.ajax({
          url: "ajax/clientes.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(respuesta) {
            if (respuesta === "ok") {
              // Si la respuesta es "ok", mostrar una alerta de éxito
              swal({
                title: "Éxito",
                text: "NOTA AGREGADA CORRECTAMENTE",
                icon: "success"
              });


                $("#divNota").hide();


            } else {
              // Si la respuesta no es "ok", mostrar una alerta de error
              swal({
                title: "Error",
                text: "Ocurrió un error al agregar la nota",
                icon: "error"
              });
            }
          }
        });
  }else{
    alert("Por favor, complete todos los campos antes de enviar la solicitud.");
  }
})
