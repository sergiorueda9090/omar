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

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$item = null;
$valor = null;

$respuesta = ReporteControlador::ctrDescargarReporteExcelUtilidad($fechaInicial,$fechaFinal);
$respuestaInteres = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);

$respuestaUtilidadDos = ReporteControlador::ctrUtilidadDos($fechaInicial,$fechaFinal);
$respuestaUtilidadTres = ReporteControlador::ctrMostrarTablaUtilidadTres($item,$valor,$fechaInicial,$fechaFinal);


$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator('Reportes de ventas')
->setDescription('Documento de ventas');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('REPORTE');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(1);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12);




$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NOMBRE USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'NOMBRE CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'UTILIDAD UNO');
//$objPHPExcel->getActiveSheet()->setCellValue('D1', 'INTERES');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'FECHA');
$objPHPExcel->getActiveSheet()->setCellValue('F1', '');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'NOMBRE USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'NOMBRE CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'UTILIDAD DOS');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'FECHA');
$objPHPExcel->getActiveSheet()->setCellValue('K1', '');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'NOMBRE USUARIO');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'NOMBRE CLIENTE');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'UTILIDAD TRES');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'FECHA');





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

$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($estiloTituloColumnas);

foreach ($respuesta as $key => $value) {
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($key+2), $value["nombre"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($key+2), $value["nombreCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($key+2), number_format($value["valorTotalInteresCliente"]));
  $objPHPExcel->getActiveSheet()->setCellValue('E'.($key+2), $value["fechaPrestamoCliente"]);
}

foreach ($respuestaInteres as $keyDos => $value) {
  $objPHPExcel->getActiveSheet()->setCellValue('A'.($keyDos+($key+3)), $value["nombre"]);
  $objPHPExcel->getActiveSheet()->setCellValue('B'.($keyDos+($key+3)), $value["nombreCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('C'.($keyDos+($key+3)), number_format($value["interes"]));
  $objPHPExcel->getActiveSheet()->setCellValue('E'.($keyDos+($key+3)), $value["fechaPagoClienteTarjeta"]);
}

  /**/
  $respuesta = ReporteControlador::ctrUtilidadDos($fechaInicial,$fechaFinal);
  $n = 1;
    foreach ($respuesta as $key => $value) {

      $respuestaDos = ReporteControlador::ctrUtilidadDosDos($fechaInicial,$fechaFinal,$value["id"]);

      $fecha = $fecha[0]["fechaIngresoCuota"];

      foreach ($respuestaDos as $keyDos => $values) {

        if($values["fechaIngresoCuota"] == '0000-00-00'){

        }else{

          $fecha = $values["fechaIngresoCuota"];

        }

        $n++;
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$n, $values["nombre"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$n, $values["nombreCliente"]);
        if($value["tipoPrestamoCliente"] == 'diario'){
             $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, number_format($value["interesMensualCliente"]/30));
        }else if($value["tipoPrestamoCliente"] == 'semanal'){
             $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, number_format($value["interesMensualCliente"]/4));
        }else if($value["tipoPrestamoCliente"] == 'quincenal'){
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, number_format($value["interesMensualCliente"]/2));
        }
        else{
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, number_format($value["interesMensualCliente"]));
        }
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$n, $fecha);
      }
  }
  /**/


$respuestaInteresDos = ReporteControlador::ctrDescargarReporteInteres($fechaInicial,$fechaFinal);
foreach ($respuestaInteresDos as $key => $values) {
  $n++;
  $objPHPExcel->getActiveSheet()->setCellValue('G'.$n, $values["nombre"]);
  $objPHPExcel->getActiveSheet()->setCellValue('H'.$n, $values["nombreCliente"]);
  $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, number_format($values["interes"]));
  $objPHPExcel->getActiveSheet()->setCellValue('J'.$n, $values["fechaPagoClienteTarjeta"]);
  };


  $guardar = array();
  $guardarCobros = array();
  $n = 0;
  $o = 0;

  foreach($respuestaInteresDos as $key => $values) {
    $o++;
    $objPHPExcel->getActiveSheet()->setCellValue('L'.($o+1), $values["nombre"]);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.($o+1), $values["nombreCliente"]);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.($o+1), number_format($values["interes"]));
    $objPHPExcel->getActiveSheet()->setCellValue('O'.($o+1), $values["fechaPagoClienteTarjeta"]);
    };

  foreach ($respuestaUtilidadTres as $key => $value) {
    $dineroPrestado = $value["dineroPrestadoCliente"];
    $pagos = ReporteControlador::ctrMostrarTablaUtilidadTresPagos($value["id"],$valor,$fechaInicial,$fechaFinal);
   foreach ($pagos as $keys => $p) {
     array_push($guardar,$p["pagoClienteTarjeta"]);
     $total = array_sum($guardar);
     if($total > $dineroPrestado){
        $res = verifica_rangoOme($fechaInicial, $fechaFinal, $p["fechaPagoClienteTarjeta"]);
       if($n == 0){
         if($res == "ok"){
           $o++;
           $objPHPExcel->getActiveSheet()->setCellValue('L'.($o+1), $value["nombre"]);
           $objPHPExcel->getActiveSheet()->setCellValue('M'.($o+1), $value["nombreCliente"]);
           $objPHPExcel->getActiveSheet()->setCellValue('N'.($o+1), number_format($total - $dineroPrestado));
           $objPHPExcel->getActiveSheet()->setCellValue('O'.($o+1), $p["fechaPagoClienteTarjeta"]);
            $n = 1;
         }
       }else{
         if($res == "ok"){
           $o++;
           $objPHPExcel->getActiveSheet()->setCellValue('L'.($o+1), $value["nombre"]);
           $objPHPExcel->getActiveSheet()->setCellValue('M'.($o+1), $value["nombreCliente"]);
           $objPHPExcel->getActiveSheet()->setCellValue('N'.($o+1), number_format($p["pagoClienteTarjeta"]));
           $objPHPExcel->getActiveSheet()->setCellValue('O'.($o+1), $p["fechaPagoClienteTarjeta"]);
           $n = 1;
         }
       }
     }
   }

   $n = 0;
   $guardar = array();
   $guardarCobros = array();
  };



  function verifica_rangoOme($date_inicio, $date_fin, $date_nueva) {
     $date_inicio = strtotime($date_inicio);
     $date_fin = strtotime($date_fin);
     $date_nueva = strtotime($date_nueva);
     if (($date_nueva >= $date_inicio) && ($date_nueva <= $date_fin)){
       return "ok";
     }else{
       return "error";
     }
   }


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
