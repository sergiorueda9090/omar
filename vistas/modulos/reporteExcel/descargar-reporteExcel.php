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

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $nombreTabla = $_GET["reporte"];

}else{

$fechaInicial = null;
$fechaFinal = null;
$nombreTabla = $_GET["reporte"];

}


$respuesta = ReporteControlador::ctrDescargarReporteExcelGobal($fechaInicial,$fechaFinal,$nombreTabla);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator('Reportes de ventas')
->setDescription('Documento de ventas');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle($nombreTabla);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);


$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NOMBRE USAURIO');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'DINERO');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FECHA');


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
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($key+2), $value["nombreUsuario"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($key+2), $value["nombreGasto"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($key+2), $value["valor"]);
  $objPHPExcel->getActiveSheet()->setCellValue('D'.($key+2), $value["fecha"]);
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
