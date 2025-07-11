<?php

/*require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";*/
//require_once "../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";

require_once "../../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";
require_once "../../../controladores/cobrosDelDia.controlador.php";
require_once "../../../modelos/cobrosDelDia.modelo.php";
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d");

error_reporting(0);

$respuesta = ControladorCobrosDelDia::crtMostrarCobrosDelDia();

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator('Reportes de cobros')
->setDescription('Documento de cobros');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("cobros");
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);


$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMERO TARJETA');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'FECHA COBRO');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'NOMBRE CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'VALOR CUOTA');


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

$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloColumnas);

foreach ($respuesta as $key => $value) {
  $fecha_formateada = date("Y-m-d", strtotime($value['fechaCuota']));
  if($fecha_formateada <= $hoy){
    $objPHPExcel->getActiveSheet()->setCellValue('A'.($key+2), $value["numeroTarjetaCliente"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.($key+2), $value['fechaCuota']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.($key+2), $value['nombreCliente']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.($key+2), number_format($value['valorCuota']));
  }

}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
