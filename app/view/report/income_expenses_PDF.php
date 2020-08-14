<?php
//Llamamos a la libreria
require_once 'pdf_base.php';
//creamos el objeto
$pdf=new PDF();


//Añadimos una pagina
$pdf->AddPage();

//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AliasNbPages();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Reporte de Ingresos y Egresos '.$fecha,0,1,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Ingresos',0,1,'L',0);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,6,'DOC',1,0,'C',1);
$pdf->Cell(18,6,'Número',1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(30,6,'Monto',1,0,'C',1);
$pdf->Cell(50,6,'Fecha',1,0,'C',1);
$pdf->Ln();
$ingresos_productos = 0;
$pdf->SetFont('Arial','',8);
foreach ($sales as $p){
    $pdf->Cell(30,6,$p->saleproduct_type,1,0,'C',0);
    $pdf->Cell(18,6,$p->saleproduct_correlative,1,0,'C',0);
    $pdf->Cell(70,6,$p->client_name,1,0,'C',0);
    $pdf->Cell(30,6,'S/. '.$p->saleproduct_total,1,0,'R',0);
    $pdf->Cell(50,6,$p->saleproduct_date,1,1,'C',0);
    $ingresos_productos = $ingresos_productos +$p->saleproduct_total;
}
$pdf->SetFont('Arial','',12);
$pdf->Cell(118,10,'TOTAL VENTA',0,0,'C',0);
$pdf->Cell(30,10,'S/. '.$ingresos_productos,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Egresos',0,1,'L',0);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->Cell(18,6,'Número',1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(30,6,'Importe',1, 1,'C',1);
$expense = $this->report->all_expense($turn);
$egresos = 0;
foreach ($expense as $p){
    $pdf->Cell(30,6,$fecha,1,0,'C',0);
    $pdf->Cell(18,6,$p->id_expense,1,0,'C',0);
    $pdf->Cell(70,6,$p->expense_description,1,0,'C',0);
    $pdf->Cell(30,6,'S/. '.$p->expense_mont,1,1,'R',0);
    $egresos = $egresos +$p->expense_mont;
}
$balance_final = $ingresos_productos - $egresos;
$pdf->Cell(118,10,'TOTAL EGRESOS',0,0,'C',0);
$pdf->Cell(30,10,'S/. '.$egresos,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Balance General',0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(100,6,'TOTAL VENTAS',0,0,'L',0);
$pdf->Cell(18,6,$ingresos_productos,0,1,'C',0);
$pdf->Cell(100,6,'TOTAL EGRESOS',0,0,'L',0);
$pdf->Cell(18,6,$egresos,0,1,'C',0);
$pdf->Cell(100,6,'SALDO TOTAL DEL DIA',0,0,'L',0);
$pdf->Cell(18,6,$balance_final,0,1,'C',0);
$pdf->Cell(100,6,'MONTO DE APERTURA DE CAJA',0,0,'L',0);
$pdf->Cell(18,6,$turn->turn_inicialcash ?? 0,0,1,'C',0);
$pdf->Cell(100,6,'TOTAL EN CAJA',0,0,'L',0);
$pdf->Cell(18,6,$balance_final + $turn->turn_inicialcash,0,1,'C',1);

$pdf->Output();

?>