<?php

/*require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";*/
//require_once "../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";

require_once "../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";
require_once "../../controladores/reporte.controlador.php";
require_once "../../modelos/reporte.modelo.php";

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ReporteControlador::ctrDescargarReporteExcel($fechaInicial,$fechaFinal);
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator('Reportes de ventas')
->setDescription('Documento de ventas');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('REPORTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(26);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(26);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('o')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(27);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMERO TARJETA');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NOMBRE PRESTAMISTA');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NOMBRE DEL CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'DINERO PRESTADO');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'INTERES');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'TIEMPO DEL PRESTAMO');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'TIPO DEL PRESTAMO');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'FECHA PRESTAMO');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'INTERES MENSUAL');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'VALOR DE LA CUOTA');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'VALOR TOTAL INTERES');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'SALDO TOTAL A PAGAR');;
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ESTADO CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'CUOTAS PAGAS');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'CUOTAS PENDIENTES');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ABONO TOTAL');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'SALDO TOTAL');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'SALDO A LA INVERSION');

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
  'color' => array('rgb' => '538DD5')
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

$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloColumnas);

foreach ($respuesta as $key => $value) {
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($key+2), $value["numeroTarjetaCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($key+2), $value["nombre"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($key+2), $value["nombreCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('D'.($key+2), number_format($value["dineroPrestadoCliente"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('E'.($key+2), $value["interesPrestamoCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('F'.($key+2), $value["tiempoPrestamoCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('G'.($key+2), $value["tipoPrestamoCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('H'.($key+2), $value["diaPrestamoCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('I'.($key+2), number_format($value["interesMensualCliente"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('J'.($key+2), number_format($value["valorCuotaCliente"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('K'.($key+2), number_format($value["valorTotalInteresCliente"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('L'.($key+2), number_format($value["saldoTotalPagarCliente"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('M'.($key+2), $value["estadoCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('N'.($key+2), $value["cuotasPagas"]);
  $objPHPExcel->getActiveSheet()->setCellValue('O'.($key+2), $value["cuotasDebe"]);
  $objPHPExcel->getActiveSheet()->setCellValue('P'.($key+2), number_format($value["saldoTotalPagarCliente"] - $value["saldoTotal"]));
  $objPHPExcel->getActiveSheet()->setCellValue('Q'.($key+2), number_format($value["saldoTotal"], 0, ',', ''));
  $objPHPExcel->getActiveSheet()->setCellValue('R'.($key+2), number_format($value["saldoAinversion"], 0, ',', ''));
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
