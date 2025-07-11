$(document).ready(function(){

  $(".dineroPrestadoCliente").number(true);

  $(".interesMensualCliente").number(true);

  $(".valorCuotaCliente").number(true);

  $(".valorTotalInteresCliente").number(true);

  $(".saldoTotalPagarCliente").number(true);



  $(".valorCuotaCalculadora").number(true);

  $(".dieneroPrestadoDosCalculadora").number(true);

  $(".dineroPrestadoCalculadora").number(true);

  $(".resultadoDosCalculadora").number(true);

  //$(".resultadoCalculadora").number(true);

})







$(document).on('click','.calculadora',function(){

  var valorCuotaCalculadora     = $(".valorCuotaCalculadora").val();
  var tiempoCalculadora         = $(".tiempoCalculadora").val();
  var dineroPrestadoCalculadora = $(".dineroPrestadoCalculadora").val();
  
  // Realiza los cálculos
  var resultado = ((Number(valorCuotaCalculadora) * Number(tiempoCalculadora)) - dineroPrestadoCalculadora) * 100;
  var t = Number(resultado) / (dineroPrestadoCalculadora * tiempoCalculadora);
 
 
  
  // Muestra el resultado con dos decimales
  $(".resultadoCalculadora").val(t);
  
  var tiempoDosCalculadora;


  if ($('.mensualChe').prop('checked') ) {

    console.log("mensual");

    tiempoDosCalculadora = $(".tiempoDosCalculadora").val();

    console.log("cantidad ",tiempoDosCalculadora);

    var dieneroPrestadoDosCalculadora = $(".dieneroPrestadoDosCalculadora").val();

    var porcentajeDosCalculadora = $(".porcentajeDosCalculadora").val();

    var dos = ((((Number(dieneroPrestadoDosCalculadora)*Number(porcentajeDosCalculadora))/100)*Number(tiempoDosCalculadora))+Number(dieneroPrestadoDosCalculadora))/Number(tiempoDosCalculadora)

    console.log("dos ",dos);

    $(".resultadoDosCalculadora").val(dos);

  }



  if ($('.quincenalChe').prop('checked') ) {



     console.log("quincenalChe ");



     tiempoDosCalculadora = $(".tiempoDosCalculadora").val();



     console.log("cantidad ",tiempoDosCalculadora);



     var dieneroPrestadoDosCalculadora = $(".dieneroPrestadoDosCalculadora").val();



     var porcentajeDosCalculadora = $(".porcentajeDosCalculadora").val();



     var dos = ((((Number(dieneroPrestadoDosCalculadora)*Number(porcentajeDosCalculadora))/100)*Number(tiempoDosCalculadora))+Number(dieneroPrestadoDosCalculadora))/Number(tiempoDosCalculadora)

     var dos = dos / 2

     $(".resultadoDosCalculadora").val(dos);



  }



  if ($('.semanalChe').prop('checked') ) {

    console.log("semanalChe ");

     tiempoDosCalculadora = $(".tiempoDosCalculadora").val();



    console.log("cantidad ",tiempoDosCalculadora);

    var dieneroPrestadoDosCalculadora = $(".dieneroPrestadoDosCalculadora").val();



    var porcentajeDosCalculadora = $(".porcentajeDosCalculadora").val();



    var dos = ((((Number(dieneroPrestadoDosCalculadora)*Number(porcentajeDosCalculadora))/100)*Number(tiempoDosCalculadora))+Number(dieneroPrestadoDosCalculadora))/Number(tiempoDosCalculadora)

    var dos = dos / 4

    $(".resultadoDosCalculadora").val(dos);

  }



  if ($('.diarioChe').prop('checked') ) {

    console.log("diarioChe ");

     tiempoDosCalculadora = $(".tiempoDosCalculadora").val();

    console.log("cantidad ",tiempoDosCalculadora);

    var dieneroPrestadoDosCalculadora = $(".dieneroPrestadoDosCalculadora").val();



    var porcentajeDosCalculadora = $(".porcentajeDosCalculadora").val();



    var dos = ((((Number(dieneroPrestadoDosCalculadora)*Number(porcentajeDosCalculadora))/100)*Number(tiempoDosCalculadora))+Number(dieneroPrestadoDosCalculadora))/Number(tiempoDosCalculadora)

    var dos = dos / 30

    $(".resultadoDosCalculadora").val(dos);

  }



})



$(document).on('click','.cerrarCalculadora',function(){

  $(".numeroUno").val("");

  $(".numeroDos").val("");

  $(".numeroTres").val("");

})



/*=============================================

EDITAR CLIENTE

=============================================*/

$(".tablas").on("click", ".btnEditarCliente", function(){



var idCliente = $(this).attr("idCliente");

var datos = new FormData();

    datos.append("idCliente", idCliente);



  $.ajax({



    url:"ajax/clientes.ajax.php",

    method: "POST",

    data: datos,

    cache: false,

    contentType: false,

    processData: false,

    dataType:"json",

    success:function(respuesta){



			$(".editarNumeroTarjetaCliente").val(respuesta["numeroTarjetaCliente"]);

			$(".editarNombreCliente").val(respuesta["nombreCliente"]);

			$(".editarZonaPrestamoCliente").val(respuesta["zonaPrestamoCliente"]);

			$(".editarDineroPrestadoCliente").val(respuesta["dineroPrestadoCliente"]);

			$(".editarInteresPrestamoCliente").val(respuesta["interesPrestamoCliente"]);

			$(".editarTiempoPrestamoCliente").val(respuesta["tiempoPrestamoCliente"]);

			$(".editarTipoPrestamoCliente").val(respuesta["tipoPrestamoCliente"]);

			$(".editarDiaPrestamoCliente").val(respuesta["diaPrestamoCliente"]);

			$(".editarDiaCobroPrestamoCliente").val(respuesta["diaCobroPrestamoCliente"]);

			$(".editarFechaPrestamoCliente").val(respuesta["fechaPrestamoCliente"]);

			$(".editarFechaFinPrestamoCliente").val(respuesta["fechaFinPrestamoCliente"]);

			$(".editarInteresMensualCliente").val(respuesta["interesMensualCliente"]);

			$(".editarNumeroCuotasCliente").val(respuesta["numeroCuotasCliente"]);

			$(".editarValorCuotaCliente").val(respuesta["valorCuotaCliente"]);

			$(".editarValorTotalInteresCliente").val(respuesta["valorTotalInteresCliente"]);

			$(".editarSaldoTotalPagarCliente").val(respuesta["saldoTotalPagarCliente"]);

			$(".idClienteEditar").val(respuesta["id"]);

      $(".editarEstadoCliente").val(respuesta["estadoCliente"]);



  }



	})



})





/*=============================================

ELIMINAR CLIENTE

=============================================*/

$(".tablas").on("click", ".btnEliminarCliente", function(){



var idCliente = $(this).attr("idCliente");



swal({

      title: '¿Está seguro de borrar el cliente?',

      text: "¡Si no lo está puede cancelar la acción!",

      type: 'warning',

      showCancelButton: true,

      confirmButtonColor: '#3085d6',

      cancelButtonColor: '#d33',

      cancelButtonText: 'Cancelar',

      confirmButtonText: 'Si, borrar cliente!'

    }).then(function(result){

      if (result.value) {



          window.location = "index.php?ruta=clientes&idCliente="+idCliente;

      }



})



})



/*=============================================

TIPO DEL PRESTAMO

=============================================*/

function tipoPrestamo(){

alert("Hola mundo");

}



/*============================================

MOSTRAR CAMPOS QUINCENALES

============================================*/

$(document).on('change','.tipoPrestamoCliente',function(){

	var tipoPrestamoCliente = $(".tipoPrestamoCliente").val();

	if(tipoPrestamoCliente === 'quincenal'){

		$(".mostrarPrimerQuincena").show();

		$(".mostrarSundaQuincena").show();

    $(".mostrarCobroSemanal").hide();

	}else if(tipoPrestamoCliente === 'semanal'){

    $(".mostrarPrimerQuincena").hide();

    $(".mostrarSundaQuincena").hide();

    $(".mostrarCobroSemanal").show();

  }else{

    $(".mostrarPrimerQuincena").hide();

    $(".mostrarSundaQuincena").hide();

    $(".mostrarCobroSemanal").hide();

  }

})



$(document).on('change','.diaCobroPrestamoCliente',function(){



var dineroPrestadoCliente = $(".dineroPrestadoCliente").val();

var interesPrestamoCliente = $(".interesPrestamoCliente").val();

var tiempoPrestamoCliente = $(".tiempoPrestamoCliente").val();

var tipoPrestamoCliente = $(".tipoPrestamoCliente").val();

var diaPrestamoCliente = $(".diaPrestamoCliente").val();

var diaCobroPrestamoCliente = $(".diaCobroPrestamoCliente").val();

var diaCobroPrestamoCliente = $(".diaCobroPrestamoCliente").val();

var fechaFinPrestamoCliente = $(".fechaFinPrestamoCliente").val();

var divisionesPunto = interesPrestamoCliente.split(".", 1);



$(".fechaPrestamoCliente").val(diaPrestamoCliente);



console.log("dineroPrestadoCliente ",dineroPrestadoCliente);

console.log("interesPrestamoCliente ",interesPrestamoCliente);

console.log("tiempoPrestamoCliente ",tiempoPrestamoCliente);

console.log("tipoPrestamoCliente ",tipoPrestamoCliente);

console.log("diaPrestamoCliente ",diaPrestamoCliente);

console.log("diaCobroPrestamoCliente ",diaCobroPrestamoCliente);

console.log("diaPrestamoCliente ",diaPrestamoCliente);

console.log("diaCobroPrestamoCliente ",diaCobroPrestamoCliente);

console.log("fechaPrestamoCliente ",diaCobroPrestamoCliente);

console.log("fechaFinPrestamoCliente ",diaCobroPrestamoCliente);



var divisiones = diaCobroPrestamoCliente.split("-",3);

var ano = divisiones[0];

var mes = divisiones[1];

var dia = divisiones[2];

var tMes;

var tAno;

var arrayFecha = [];





/*=============================================

FECHAS MENSUALES

============================================*/

if(tipoPrestamoCliente === 'mensual'){



		for(var i = 0; i<Number(tiempoPrestamoCliente); i++){



				tMes = (Number(mes)+Number(i));



				if(tMes <= 12){



						if(tMes <= 9){

							fechaTotal = ano+'-'+0+tMes+'-'+dia;

							arrayFecha.push(fechaTotal)

						}else{

							fechaTotal = ano+'-'+tMes+'-'+dia;

							arrayFecha.push(fechaTotal)

						}



				}



				if(tMes > 12 && tMes <= 24){

						tAno = (Number(ano)+Number(1));

						if((Number(tMes)-Number(12)) <= 9){

							fechaTotal = tAno+'-'+0+(Number(tMes)-Number(12))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}else{

							fechaTotal = tAno+'-'+(Number(tMes)-Number(12))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}



				}



				if(tMes > 24 && tMes <= 36){

					  tAno =(Number(ano)+Number(2));

						if((Number(tMes)-Number(24)) <= 9){

							fechaTotal = tAno+'-'+0+(Number(tMes)-Number(24))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}else{

							fechaTotal = tAno+'-'+(Number(tMes)-Number(24))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}



				}



				if(tMes > 36){

					  tAno =(Number(ano)+Number(3));

						if((Number(tMes)-Number(36)) <= 9){

							fechaTotal = tAno+'-'+0+(Number(tMes)-Number(36))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}else{

							fechaTotal = tAno+'-'+(Number(tMes)-Number(36))+'-'+dia;

							arrayFecha.push(fechaTotal)

						}



				}



		}



    console.log("arrayFecha ",arrayFecha);

    console.log("cantidadCuotas ",arrayFecha.length-1);

    var interesMensual = (Number(dineroPrestadoCliente)*Number(interesPrestamoCliente)/100);

    console.log("interesMensual ",interesMensual);

    var interesTotal = (Number(interesMensual)*Number(tiempoPrestamoCliente));

    console.log("interesTotal ",interesTotal);

    var cantidadCuotas = arrayFecha.length-1;

    var valorCuota = (Number(dineroPrestadoCliente)+Number(interesTotal))/Number(cantidadCuotas);

    console.log("valorCuota ",valorCuota);

    var totalPagar = (Number(interesTotal)+Number(dineroPrestadoCliente));

    console.log("totalPagar ",totalPagar);



    $(".fechaFinPrestamoCliente").val(arrayFecha[arrayFecha.length-1]);

    console.log("ULTIMA FECHA ",arrayFecha[arrayFecha.length-1]);

    $(".interesMensualCliente").val(Math.round(interesMensual));

    $(".numeroCuotasCliente").val(cantidadCuotas);

    $(".valorCuotaCliente").val(Math.round(valorCuota));

    $(".valorTotalInteresCliente").val(Math.round(interesTotal));

    $(".saldoTotalPagarCliente").val(Math.round(totalPagar));

    $(".fechasTotalesCliente").val(arrayFecha);



}

/*=============================================

FIN FECHAS MENSUALES

============================================*/





/*=============================================

FECHAS QUINCENAL

============================================*/

else if(tipoPrestamoCliente === 'quincenal'){



	$(".mostrarPrimerQuincena").show();

  $(".mostrarSundaQuincena").show();



	var totalCuotasQuincenales = Number(tiempoPrestamoCliente)*2;

	var primerCobroQuincenalCliente = $(".primerCobroQuincenalCliente").val();

  var segundoCobroQuincenalCliente = $(".segundoCobroQuincenalCliente").val();



	var divisionesQuincenalUno = primerCobroQuincenalCliente.split("-",3);

	var anoQuincenalUno = divisionesQuincenalUno[0];

	var mesQuincenalUno = divisionesQuincenalUno[1];

	var diaQuincenalUno = divisionesQuincenalUno[2];



	var divisionesQuincenalDos = segundoCobroQuincenalCliente.split("-",3);

	var anoQuincenalDos = divisionesQuincenalDos[0];

	var mesQuincenalDos = divisionesQuincenalDos[1];

	var diaQuincenalDos = divisionesQuincenalDos[2];



	var tMesUno;

	var tMesDos;



/*for(var i = 0; i<Number(tiempoPrestamoCliente); i++){



	tMesUno = (Number(mesQuincenalUno)+Number(i));

	tMesDos = (Number(mesQuincenalDos)+Number(i));



  if(tMesUno <= 12){



  			if(tMesUno <= 9 && tMesDos <= 10){



  					fechaUno = ano+'-'+0+tMesUno+'-'+diaQuincenalUno;

						arrayFecha.push(fechaUno)

						fechaDos = ano+'-'+0+tMesDos+'-'+diaQuincenalDos;

						arrayFecha.push(fechaDos)



  			}else{



  					fechaUno = ano+'-'+tMesUno+'-'+diaQuincenalUno;

					  arrayFecha.push(fechaUno)



  			 if(tMesDos == 13){



  				  fechaDos = (Number(ano)+1)+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

					  arrayFecha.push(fechaDos)



  			 }else{



  				  fechaDos = ano+'-'+tMesDos+'-'+diaQuincenalDos;

					  arrayFecha.push(fechaDos)



  		    }



  		  }



  }else{



  			tMesUno = (Number(mesQuincenalUno)+Number(i)-12);

				tMesDos = (Number(mesQuincenalDos)+Number(i)-12);



  if(tMesUno <= 12){



  		if(tMesUno <= 9 && tMesDos <= 10){



  				fechaUno = (Number(ano)+Number(1))+'-'+0+tMesUno+'-'+diaQuincenalUno;

					arrayFecha.push(fechaUno)

					fechaDos = (Number(ano)+Number(1))+'-'+0+tMesDos+'-'+diaQuincenalDos;

					arrayFecha.push(fechaDos)



  		 }else{



  					fechaUno = (Number(ano)+Number(1))+'-'+tMesUno+'-'+diaQuincenalUno;

						arrayFecha.push(fechaUno)



  			if(tMesDos == 13){



  					fechaDos = (Number(ano)+2)+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

						arrayFecha.push(fechaDos)



  		 }else{



  					fechaDos = (Number(ano)+Number(1))+'-'+tMesDos+'-'+diaQuincenalDos;

						arrayFecha.push(fechaDos)



          }

       }



    }else{



    	   tMesUno = (Number(mesQuincenalUno)+Number(i)-12);

			   tMesDos = (Number(mesQuincenalDos)+Number(i)-12);



    		if(tMesUno <= 12){



    				if(tMesUno <= 9 && tMesDos <= 10){



    						fechaUno = (Number(ano)+Number(2))+'-'+0+tMesUno+'-'+diaQuincenalUno;

								arrayFecha.push(fechaUno)

								fechaDos = (Number(ano)+Number(2))+'-'+0+tMesDos+'-'+diaQuincenalDos;

								arrayFecha.push(fechaDos)



    				}else{



    							 fechaUno = (Number(ano)+Number(2))+'-'+tMesUno+'-'+diaQuincenalUno;

									 arrayFecha.push(fechaUno)



    		          if(tMesDos == 13){



    									fechaDos = (Number(ano)+3)+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

											arrayFecha.push(fechaDos)



    		          }else{



    									fechaDos = (Number(ano)+Number(3))+'-'+tMesDos+'-'+diaQuincenalDos;

											arrayFecha.push(fechaDos)



    			      }



    			    }



    			  }else{



       					fechaUno = (Number(ano)+Number(2))+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalUno;

     						arrayFecha.push(fechaUno)



       			if(tMesDos == 13){



       					fechaDos = (Number(ano)+2)+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

     						arrayFecha.push(fechaDos)



       		 }else{



             fechaDos = (Number(ano)+2)+'-'+0+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

             arrayFecha.push(fechaDos)



               }

            }



          }



        }



      }*/



      for(var i = 0; i<Number(tiempoPrestamoCliente); i++){



      	tMesUno = (Number(mesQuincenalUno)+Number(i));

      	tMesDos = (Number(mesQuincenalDos)+Number(i));



        if(tMesUno <= 12){



        			if(tMesUno <= 9 && tMesDos <= 10){



        					fechaUno = ano+'-'+0+tMesUno+'-'+diaQuincenalUno;

      						arrayFecha.push(fechaUno)

      						fechaDos = ano+'-'+tMesDos+'-'+diaQuincenalDos;

      						arrayFecha.push(fechaDos)



        			}else{



        					fechaUno = ano+'-'+tMesUno+'-'+diaQuincenalUno;

      					  arrayFecha.push(fechaUno)



        			 if(tMesDos == 13){



        				  fechaDos = (Number(ano)+1)+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

      					  arrayFecha.push(fechaDos)



        			 }else{



        				  fechaDos = ano+'-'+tMesDos+'-'+diaQuincenalDos;

      					  arrayFecha.push(fechaDos)



        		    }



        		  }



        }else{



        			tMesUno = (Number(mesQuincenalUno)+Number(i)-12);

      				tMesDos = (Number(mesQuincenalDos)+Number(i)-12);



        if(tMesUno <= 12){



        		if(tMesUno <= 9 && tMesDos <= 10){



        				fechaUno = (Number(ano)+Number(1))+'-'+tMesUno+'-'+diaQuincenalUno;

      					arrayFecha.push(fechaUno)

      					fechaDos = (Number(ano)+Number(1))+'-'+tMesDos+'-'+diaQuincenalDos;

      					arrayFecha.push(fechaDos)



        		 }else{



        					fechaUno = (Number(ano)+Number(1))+'-'+tMesUno+'-'+diaQuincenalUno;

      						arrayFecha.push(fechaUno)



        			if(tMesDos == 13){



        					fechaDos = (Number(ano)+2)+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

      						arrayFecha.push(fechaDos)



        		 }else{



        					fechaDos = (Number(ano)+Number(1))+'-'+tMesDos+'-'+diaQuincenalDos;

      						arrayFecha.push(fechaDos)



                }

             }



          }else{



          	   tMesUno = (Number(mesQuincenalUno)+Number(i)-12);

      			   tMesDos = (Number(mesQuincenalDos)+Number(i)-12);



          		if(tMesUno <= 12){



          				if(tMesUno <= 9 && tMesDos <= 10){



          						fechaUno = (Number(ano)+Number(2))+'-'+tMesUno+'-'+diaQuincenalUno;

      								arrayFecha.push(fechaUno)

      								fechaDos = (Number(ano)+Number(2))+'-'+tMesDos+'-'+diaQuincenalDos;

      								arrayFecha.push(fechaDos)



          				}else{



          							 fechaUno = (Number(ano)+Number(2))+'-'+tMesUno+'-'+diaQuincenalUno;

      									 arrayFecha.push(fechaUno)



          		          if(tMesDos == 13){



          									fechaDos = (Number(ano)+3)+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

      											arrayFecha.push(fechaDos)



          		          }else{



          									fechaDos = (Number(ano)+Number(3))+'-'+tMesDos+'-'+diaQuincenalDos;

      											arrayFecha.push(fechaDos)



          			      }



          			    }



          			  }else{



             					fechaUno = (Number(ano)+Number(2))+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalUno;

           						arrayFecha.push(fechaUno)



             			if(tMesDos == 13){



             					fechaDos = (Number(ano)+2)+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

           						arrayFecha.push(fechaDos)



             		 }else{



                   fechaDos = (Number(ano)+2)+'-'+(Number(tMesDos)-12)+'-'+diaQuincenalDos;

                   arrayFecha.push(fechaDos)



                     }

                  }



                }



              }



            }



      /*for(var f = 0; f < arrayFecha.length-1; f++){

          console.log("algo ",arrayFecha[f]);

      }*/



      console.log("arrayFecha ",arrayFecha);

      console.log("cantidadCuotas ",arrayFecha.length-1);

      console.log("interesMensual ",interesMensual);

      console.log("interesTotal ",interesTotal);

      console.log("valorCuota ",valorCuota);

      console.log("totalPagar ",totalPagar);

      console.log("ULTIMA FECHA ",arrayFecha[arrayFecha.length-1]);



    }

/*=============================================

FIN FECHAS QUINCENALES

============================================*/







/*=============================================

FECHAS DIARIAS

============================================*/

else if(tipoPrestamoCliente === 'diario'){

    var contador = 0;

		for(var i = 0; i<Number(tiempoPrestamoCliente*30); i++){



      var unDia = contador++;

      var unDiaMas = Number(unDia)+Number(dia);



      if(unDiaMas >= 30){



          if(unDiaMas <= 9){

              unDiaMas = '0'+unDiaMas;

              arrayFecha.push(ano+'-'+mes+'-'+unDiaMas);

          }else{

              arrayFecha.push(ano+'-'+mes+'-'+unDiaMas);

          }



          contador = 0;

          dia = 1;



          mes = Number(mes)+Number(1);

          if(mes <= 9){

              mes = '0'+mes;



          }else{



            if(mes > 12){

                ano = Number(ano)+Number(1);

                mes = Number(mes)-Number(12);

            }else{



            }

          }



      }else{



        if(unDiaMas <= 9){

            unDiaMas = '0'+unDiaMas;

            arrayFecha.push(ano+'-'+mes+'-'+unDiaMas);

        }else{

            arrayFecha.push(ano+'-'+mes+'-'+unDiaMas);

        }

      }





		}



    console.log("arrayFecha ",arrayFecha);

    console.log("cantidadCuotas ",arrayFecha.length-1);

    var interesMensual = (Number(dineroPrestadoCliente)*Number(interesPrestamoCliente)/100);

    console.log("interesMensual ",interesMensual);

    var interesTotal = (Number(interesMensual)*Number(tiempoPrestamoCliente));

    console.log("interesTotal ",interesTotal);

    var cantidadCuotas = arrayFecha.length-1;

    var valorCuota = (Number(dineroPrestadoCliente)+Number(interesTotal))/Number(cantidadCuotas);

    console.log("valorCuota ",valorCuota);

    var totalPagar = (Number(interesTotal)+Number(dineroPrestadoCliente));

    console.log("totalPagar ",totalPagar);



    $(".fechaFinPrestamoCliente").val(arrayFecha[arrayFecha.length-1]);

    console.log("ULTIMA FECHA ",arrayFecha[arrayFecha.length-1]);

    $(".interesMensualCliente").val(Math.round(interesMensual));

    $(".numeroCuotasCliente").val(cantidadCuotas);

    $(".valorCuotaCliente").val(Math.round(valorCuota));

    $(".valorTotalInteresCliente").val(Math.round(interesTotal));

    $(".saldoTotalPagarCliente").val(Math.round(totalPagar));

    $(".fechasTotalesCliente").val(arrayFecha);



}

/*=============================================

FIN FECHAS DIARIAS

============================================*/

else if(tipoPrestamoCliente === 'semanal'){

  var tiempoPrestamoCliente = $(".tiempoPrestamoCliente").val();

  var primerCobroSemanal = $(".primerCobroSemanal").val();

  var segundaCobroSemanal = $(".segundaCobroSemanal").val();

  var terceroCobroSemanal = $(".terceroCobroSemanal").val();

  var cuartoCobroSemanal = $(".cuartoCobroSemanal").val();



  var cantidad = -1;

  var semanaUno = diaCobroPrestamoCliente.split("-",3);

  var semanaUano = semanaUno[0];

  var semanaUmes = semanaUno[1];

  var semanaUdia = semanaUno[2];



  var semanaDos = segundaCobroSemanal.split("-",3);

  var semanaDano = semanaDos[0];

  var semanaDmes = semanaDos[1];

  var semanaDdia = semanaDos[2];



  var semanaTres = terceroCobroSemanal.split("-",3);

  var semanaTano = semanaTres[0];

  var semanaTmes = semanaTres[1];

  var semanaTdia = semanaTres[2];



  var semanaCuatro = cuartoCobroSemanal.split("-",3);

  var semanaCano = semanaCuatro[0];

  var semanaCmes = semanaCuatro[1];

  var semanaCdia = semanaCuatro[2];



  for(var i = 0; i<Number(tiempoPrestamoCliente);i++){

    cantidad += 1;



    mesU = Number(semanaUmes)+Number(cantidad);

    mesD = Number(semanaDmes)+Number(cantidad);

    mesT = Number(semanaTmes)+Number(cantidad);

    medC = Number(semanaCmes)+Number(cantidad);



    if(mesU > 12){

       mesU = 1

       semanaUano = Number(semanaUano)+1;

       cantidad = 0;

    }



    if(mesD > 12){

       mesD = 1

       semanaDano = Number(semanaDano)+1;

    }



    if(mesT > 12){

       mesT = 1

       semanaTano = Number(semanaTano)+1;

    }



    if(medC > 12){

       medC = 1

       semanaCano = Number(semanaCano)+1;

    }

    if(mesU < 10){

      mesU = '0'+mesU;

    }

    if(mesD < 10){

      mesD = '0'+mesD;

    }

    if(mesT < 10){

      mesT = '0'+mesT;

    }

    if(medC < 10){

      medC = '0'+medC;

    }

    arrayFecha.push(semanaUano+'-'+mesU+'-'+semanaUdia);

    arrayFecha.push(semanaDano+'-'+mesD+'-'+semanaDdia);

    arrayFecha.push(semanaTano+'-'+mesT+'-'+semanaTdia);

    arrayFecha.push(semanaCano+'-'+medC+'-'+semanaCdia);

  }



  console.log("arrayFecha ",arrayFecha);

  console.log("cantidadCuotas ",arrayFecha.length-1);

  var interesMensual = (Number(dineroPrestadoCliente)*Number(interesPrestamoCliente)/100);

  console.log("interesMensual ",interesMensual);

  var interesTotal = (Number(interesMensual)*Number(tiempoPrestamoCliente));

  console.log("interesTotal ",interesTotal);

  var cantidadCuotas = arrayFecha.length-1;

  var valorCuota = (Number(dineroPrestadoCliente)+Number(interesTotal))/Number(cantidadCuotas);

  console.log("valorCuota ",valorCuota);

  var totalPagar = (Number(interesTotal)+Number(dineroPrestadoCliente));

  console.log("totalPagar ",totalPagar);



  $(".fechaFinPrestamoCliente").val(arrayFecha[arrayFecha.length-1]);

  console.log("ULTIMA FECHA ",arrayFecha[arrayFecha.length-1]);

  $(".interesMensualCliente").val(Math.round(interesMensual));

  $(".numeroCuotasCliente").val(cantidadCuotas);

  $(".valorCuotaCliente").val(Math.round(valorCuota));

  $(".valorTotalInteresCliente").val(Math.round(interesTotal));

  $(".saldoTotalPagarCliente").val(Math.round(totalPagar));

  $(".fechasTotalesCliente").val(arrayFecha);



}





var interesMensual = (Number(dineroPrestadoCliente)*Number(interesPrestamoCliente)/100);

var interesTotal = (Number(interesMensual)*Number(tiempoPrestamoCliente));

var cantidadCuotas = arrayFecha.length;

var valorCuota = (Number(dineroPrestadoCliente)+Number(interesTotal))/Number(cantidadCuotas);

var totalPagar = (Number(interesTotal)+Number(dineroPrestadoCliente));





$(".fechaFinPrestamoCliente").val(arrayFecha[arrayFecha.length]);

$(".interesMensualCliente").val(Math.round(interesMensual));

$(".numeroCuotasCliente").val(cantidadCuotas);

$(".valorCuotaCliente").val(Math.round(valorCuota));

$(".valorTotalInteresCliente").val(Math.round(interesTotal));

$(".saldoTotalPagarCliente").val(Math.round(totalPagar));

$(".fechasTotalesCliente").val(arrayFecha);

$(".interesPrestamoCliente").val(Number(divisionesPunto));

})





/*=============================================

INFORMACION DEL CLIENTE

=============================================*/

$(".tablas").on("click", ".btnInformeCliente", function(){



var idCliente = $(this).attr("idCliente");

var datos = new FormData();

    datos.append("idInformacionCliente", idCliente);



  $.ajax({



    url:"ajax/clientes.ajax.php",

    method: "POST",

    data: datos,

    cache: false,

    contentType: false,

    processData: false,

    dataType:"json",

    success:function(respuesta){



			$(".infoClienteTarjeta").html(respuesta['numeroTarjetaCliente'])

			$(".infoClienteNombre").html(respuesta['nombreCliente'])

			$(".infoClienteFechaPrestamo").html(respuesta['diaPrestamoCliente'])

			$(".infoClienteCuotasTotales").html(respuesta['cantidadCuotas'])

			$(".infoClienteValorCuota").html(respuesta['valorCuota'])

			$(".infoClienteCuotasPagas").html(respuesta['cuotasPagas'])

			$(".infoClienteCuotasPendientes").html(respuesta['cuotasDebe'])

			$(".infoClienteAbonoTotal").html(respuesta['abonoTotalCliente'])

			$(".infoClienteSaldoTotal").html(respuesta['saldoTotalCliente'])



  }



	})



})

