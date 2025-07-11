$(document).on('click','.cobroDelDiaInfo',function(){
  let fecha = $(this).attr('fecha');
  let idClienteCuota = $(this).attr('idClienteCuota');
  let idClienteCuotaFecha = $(this).attr('idClienteCuotaFecha');
  $(".proximaFechaClienteCobro").val(fecha);
  $(".idClienteCuotaCobro").val(idClienteCuota);
  $(".idClienteCuotaFechaCobro").val(idClienteCuotaFecha);
})
