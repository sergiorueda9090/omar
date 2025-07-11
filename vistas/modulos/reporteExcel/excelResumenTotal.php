<?php

/*require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";*/
//require_once "../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";

require_once "../../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";
require_once "../../../controladores/reporte.controlador.php";
require_once "../../../modelos/reporte.modelo.php";

$item = null;
$valor = null;

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $idUsuario = $_GET["usuarioReporteTotal"];

}else{

$fechaInicial = null;
$fechaFinal = null;
$idUsuario = $_GET["usuarioReporteTotal"];

}

$resultadoNumeroGasto = 0;
$resultadoNumeroBanco = 0;

$respuestaTablaUsuarios = ReporteControlador::ctrMostrarUsuario($idUsuario);

if($respuestaTablaUsuarios == "ok"){
  $usuarioEs = "TODOS LOS REGISTROS";
}else{
  $usuarioEs = $respuestaTablaUsuarios[0]["nombre"];
}

$respuestaTablaGastosPost = ReporteControlador::ctrMostrarTablaGastoPost($fechaInicial,$fechaFinal,$idUsuario);
$totalGastosPost = ReporteControlador::ctrGastoPost($fechaInicial,$fechaFinal,$idUsuario);
$pilaGasto = array();
        foreach ($totalGastosPost as $key => $value) {
          array_push($pilaGasto,$value["totalGasto"]);
        }
       number_format(array_sum($pila));

$respuestaTablaEfectivoPost = ReporteControlador::ctrMostrarReporteEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
$totalEfectivoPost = ReporteControlador::ctrEfectivoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
$pilaEfectivo = array();
   foreach ($totalEfectivoPost as $key => $value) {
     array_push($pilaEfectivo,$value["totalEfectivo"]);
   }



$respuestaTablaBancoPost = ReporteControlador::ctrMostrarReporteBancoPost($item,$valor,$fechaInicial,$fechaFinal,$idUsuario);
$totalBancoPost = ReporteControlador::ctrBancoPost($fechaInicial,$fechaFinal,$idUsuario);
$pilaBanco = array();
   foreach ($totalBancoPost as $key => $value) {
     array_push($pilaBanco,$value["totalBanco"]);
   }


$respuestaTablaBilleteraPost = ReporteControlador::ctrMostrarReporteBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
$tablaBilleteraPost = ReporteControlador::ctrBilleteraPost($fechaInicial,$fechaFinal,$idUsuario);
$pilaBilletera = array();
   foreach ($tablaBilleteraPost as $key => $value) {
     array_push($pilaBilletera,$value["totalBilletera"]);
   }


$respuestaPrestamos = ReporteControlador::ctrMostrarTablaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario);
$totalPrestamosPost = ReporteControlador::ctrGraficaPrestamosPost($fechaInicial,$fechaFinal,$idUsuario);


$respuestaTablaCobros = ReporteControlador::ctrMostrarReportePagosPost($fechaInicial,$fechaFinal,$idUsuario);
$tablaCobrosPost = ReporteControlador::ctrGraficaCobradoresPost($fechaInicial,$fechaFinal,$idUsuario);


$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator('Reportes de ventas')
->setDescription('Documento de ventas');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('REPORTE');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:P2");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1",strtoupper($usuarioEs));

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A4:C4");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A4","RESUMEN DE MES");

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E4:G4");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E4","GASTO MES");

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("I4:L4");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I4","PRESTAMO MES");

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A12:C12");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A12","MOVIMENTO BANCO");

$objPHPExcel->setActiveSheetIndex(0)->mergeCells("N4:P4");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("N4","COBROS");

$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);


$objPHPExcel->getActiveSheet()->setCellValue('N5', 'Nombre');
$objPHPExcel->getActiveSheet()->setCellValue('O5', 'Cantidad');
$objPHPExcel->getActiveSheet()->setCellValue('P5', 'Fecha');

foreach ($respuestaTablaCobros as $keyCobros => $valueCobros) {
  $objPHPExcel->getActiveSheet()->setCellValue('N'.($keyCobros+6), $valueCobros["nombreCliente"]);
  if($valueCobros["pagoClienteTarjeta"] == 0){
    $objPHPExcel->getActiveSheet()->setCellValue('O'.($keyCobros+6), number_format($valueCobros["valorInteresClienteTarjeta"]));
  }else{
    $objPHPExcel->getActiveSheet()->setCellValue('O'.($keyCobros+6), number_format($valueCobros["pagoClienteTarjeta"]));
  }

  $objPHPExcel->getActiveSheet()->setCellValue('P'.($keyCobros+6), $valueCobros["fechaPagoClienteTarjeta"]);
}


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('REPORTE');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);

$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(2);

$objPHPExcel->getActiveSheet()->setCellValue('A5', 'PRESTAMOS');
$objPHPExcel->getActiveSheet()->setCellValue('B5', number_format($totalPrestamosPost[0]["totalPrestamo"]));
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'COBRO');
$objPHPExcel->getActiveSheet()->setCellValue('B6', number_format($tablaCobrosPost[0]["totalCobrado"]));
$objPHPExcel->getActiveSheet()->setCellValue('A7', 'GASTOS');
$objPHPExcel->getActiveSheet()->setCellValue('B7', number_format(array_sum($pilaGasto)));
$objPHPExcel->getActiveSheet()->setCellValue('A8', 'BANCO');
$objPHPExcel->getActiveSheet()->setCellValue('B8', number_format(array_sum($pilaBanco)));
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'EFECTIVO');
$objPHPExcel->getActiveSheet()->setCellValue('B9', number_format(array_sum($pilaEfectivo)));
$objPHPExcel->getActiveSheet()->setCellValue('A10', 'BILLETERA');
$objPHPExcel->getActiveSheet()->setCellValue('B10', number_format(array_sum($pilaBilletera)));
$objPHPExcel->getActiveSheet()->setCellValue('A11', 'TOTAL');
$objPHPExcel->getActiveSheet()->setCellValue('B11', number_format((array_sum($pilaBilletera)
                                                                   +$totalPrestamosPost[0]["totalPrestamo"]
                                                                   +array_sum($pilaBanco)
                                                                   +array_sum($pilaEfectivo)
                                                                   +array_sum($pilaGasto))-$tablaCobrosPost[0]["totalCobrado"]));

/*GASTOS COMIENZA*/
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Fecha');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Descripcion');
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Valor');
  foreach ($respuestaTablaGastosPost as $keyGastos => $value) {
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($keyGastos+6), $value["fechaGasto"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($keyGastos+6), $value["nombreGasto"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.($keyGastos+6), number_format($value["valorGasto"]));
  }
  $resultadoNumeroGasto = ($keyGastos+7);
  /*GASTOS TERMINA*/

  /*EFECTIVO COMIENZA*/
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$resultadoNumeroGasto.':'.'G'.$resultadoNumeroGasto);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$resultadoNumeroGasto,"EFECTIVO");
  $objPHPExcel->getActiveSheet()->setCellValue('E'.($resultadoNumeroGasto+1), 'Fecha');
  $objPHPExcel->getActiveSheet()->setCellValue('F'.($resultadoNumeroGasto+1), 'Descripcion');
  $objPHPExcel->getActiveSheet()->setCellValue('G'.($resultadoNumeroGasto+1), 'Valor');
  foreach ($respuestaTablaEfectivoPost as $keyFectivo => $valueEfectivo) {
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($resultadoNumeroGasto+($keyFectivo+2)), $valueEfectivo["fechaEfectivo"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($resultadoNumeroGasto+($keyFectivo+2)), $valueEfectivo["nombreEfectivo"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.($resultadoNumeroGasto+($keyFectivo+2)), number_format($valueEfectivo["valorEfectivo"]));
  }
  /*EFECTIVO TERMINA*/


$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18);

$objPHPExcel->getActiveSheet()->setCellValue('I5', '#');
$objPHPExcel->getActiveSheet()->setCellValue('J5', 'Nombre');
$objPHPExcel->getActiveSheet()->setCellValue('K5', 'Cantidad');
$objPHPExcel->getActiveSheet()->setCellValue('L5', 'Fecha');

foreach ($respuestaPrestamos as $keyPrestamo => $valuePrestamo) {
  $objPHPExcel->getActiveSheet()->setCellValue('I'.($keyPrestamo+6), ($keyPrestamo+1));
  $objPHPExcel->getActiveSheet()->setCellValue('J'.($keyPrestamo+6), $valuePrestamo["nombreCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('K'.($keyPrestamo+6), number_format($valuePrestamo["dineroPrestadoCliente"]));
  $objPHPExcel->getActiveSheet()->setCellValue('L'.($keyPrestamo+6), $valuePrestamo["fechaCliente"]);
}


/*BANCO COMIENZO*/
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->setCellValue('A13', 'Fecha');
$objPHPExcel->getActiveSheet()->setCellValue('B13', 'Descripcion');
$objPHPExcel->getActiveSheet()->setCellValue('C13', 'Valor');
foreach ($respuestaTablaBancoPost as $keyBanco => $valueBanco) {
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($keyBanco+14), $valueBanco["fechaBanco"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($keyBanco+14), $valueBanco["nombreBanco"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($keyBanco+14), number_format($valueBanco["valorBanco"]));
}
$resultadoNumeroBanco = ($keyBanco+14);
/*BANCO FIN*/

/*BILLETERA COMIENZO*/
$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$resultadoNumeroBanco.':'."C".$resultadoNumeroBanco);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$resultadoNumeroBanco,"BILLETERA");
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);

$objPHPExcel->getActiveSheet()->setCellValue('A'.($resultadoNumeroBanco+1), 'Fecha');
$objPHPExcel->getActiveSheet()->setCellValue('B'.($resultadoNumeroBanco+1), 'Descripcion');
$objPHPExcel->getActiveSheet()->setCellValue('C'.($resultadoNumeroBanco+1), 'Valor');
foreach ($respuestaTablaBilleteraPost as $key => $valueBilletera) {
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($resultadoNumeroBanco+($key+2)), $valueBilletera["fechaBilletera"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($resultadoNumeroBanco+($key+2)), $valueBilletera["nombreBilletera"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($resultadoNumeroBanco+($key+2)), number_format($valueBilletera["valorBilletera"]));
}
/*BILLETERA FIN*/


$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);

$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(2);


$estiloTituloColumnas = array(
  'font' => array(
  'name'  => 'Arial',
  'bold'  => true,
  'size' =>10,
  'color' => array(
  'rgb' => 'FFFFFF'
)
  ),
  'fill' => array(
  'type' => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array('rgb' => '6e861b')
  ),
  'borders' => array(
  'allborders' => array(
  'style' => PHPExcel_Style_Border::BORDER_THIN
)
  ),
  'alignment' =>  array(
  'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
  )
);

$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
  'font' => array(
'name'  => 'Arial',
'color' => array(
'rgb' => '000000'
)
  ),
  'fill' => array(
'type'  => PHPExcel_Style_Fill::FILL_SOLID
),
  'borders' => array(
'allborders' => array(
'style' => PHPExcel_Style_Border::BORDER_THIN
)
  ),
'alignment' =>  array(
'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
  )
));

$objPHPExcel->getActiveSheet()->getStyle(
 'A1:' .
 $objPHPExcel->getActiveSheet()->getHighestColumn() .
 $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


$objPHPExcel->getActiveSheet()->getStyle('A1:P2')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A4:C4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('E4:G4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('I4:L4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A12:C12')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('N4:P4')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('E'.$resultadoNumeroGasto.':'.'G'.$resultadoNumeroGasto)->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('A'.$resultadoNumeroBanco.':'.'B'.$resultadoNumeroBanco)->applyFromArray($estiloTituloColumnas);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
