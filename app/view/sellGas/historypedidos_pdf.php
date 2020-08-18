<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 16/08/2020
 * Time: 14:59
 */
//require_once 'pdf_base.php';

//LLAMAMOS A LA LIBRERIA que está en la vista de report
//require 'app/view/report/pdf_base.php';
//llamamos a la clase pdf_base.php que esta en la vista sellgas
require_once 'pdf_base.php';
// creamos el objeto
$pdf = new PDF();
//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AddPage();
$pdf->SetFont('Arial','U','12');
$pdf->Cell(180,6, 'Lista de pedidos en estado '.$estadopedido.' entre las fechas '.$fecha_i.' y '.$fecha_f,0,1,'L',0);
//$pdf->Cell(180,6, 'Usuario: '.$usuariopedido,0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(180,6,'Lista',0,1,'L',0);
$pdf->Ln();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(35,6,'Fecha',1,0,'C',1);
$pdf->Cell(50,6,'Cliente',1,0,'C',1);
$pdf->Cell(40,6,'Dirección',1,0,'C',1);
$pdf->Cell(30,6,'Telefono',1,0,'C',1);
$pdf->Cell(30,6,'Total de Venta',1,0,'C',1);
//$pdf->Cell(20,6,'VENDIDO',1,0,'C',1);
$pdf->Ln();
foreach ($filtrousuario as $f){
    $pdf->Cell(35,6,$f->saleproductgas_date,1,0,'C',0);
    $pdf->Cell(50,6,$f->client_name,1,0,'C',0);
    $pdf->Cell(40,6,$f->saleproductgas_direccion,1,0,'C',0);
    $pdf->Cell(30,6,$f->saleproductgas_telefono,1,0,'C',0);
    $pdf->Cell(30,6,$f->saleproductgas_total,1,1,'C',0);
}
$pdf->Output();