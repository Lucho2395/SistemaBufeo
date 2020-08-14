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
$pdf->Cell(180,6,'Kardex Por producto entre '.$fecha_i.' y '.$fecha_f,0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(180,6,'Ingresos',0,1,'L',0);
$pdf->Ln();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->Cell(60,6,'Doc',1,0,'C',1);
$pdf->Cell(20,6,'Num',1,0,'C',1);
$pdf->Cell(20,6,'ENTRADA',1,0,'C',1);
$pdf->Cell(20,6,'SALIDA',1,0,'C',1);
$pdf->Cell(20,6,'VENDIDO',1,0,'C',1);
$pdf->Ln();
$ingresos_productos = 0;
$pdf->SetFont('Arial','',8);
foreach ($stock_added as $sa){
    $pdf->Cell(30,6,$sa->stocklog_date,1,0,'C',0);
    $pdf->Cell(60,6,$sa->stocklog_guide,1,0,'C',0);
    $pdf->Cell(20,6,$sa->id_stocklog,1,0,'C',0);
    $pdf->Cell(20,6,$sa->stocklog_added,1,0,'C',0);
    $pdf->Cell(20,6,'',1,0,'C',0);
    $pdf->Cell(20,6,'',1,1,'C',0);
    $total_added = $total_added +$sa->stocklog_added;
}foreach ($ventas as $p){
    $pdf->Cell(30,6,$p->saleproduct_date,1,0,'C',0);
    $pdf->Cell(60,6,$p->saleproduct_type,1,0,'C',0);
    $pdf->Cell(20,6,$p->saleproduct_correlative,1,0,'C',0);
    $pdf->Cell(20,6,'',1,0,'C',0);
    $pdf->Cell(20,6,'',1,0,'C',0);
    $pdf->Cell(20,6,$p->sale_productstotalselled,1,1,'C',0);
    $total_selled = $total_selled +$p->sale_productstotalselled;
}
foreach ($salidas as $s){
    $pdf->Cell(30,6,$s->stockout_date,1,0,'C',0);
    $pdf->Cell(60,6,$s->stockout_guide,1,0,'C',0);
    $pdf->Cell(20,6,$s->id_stockout,1,0,'C',0);
    $pdf->Cell(20,6,'',1,0,'C',0);
    $pdf->Cell(20,6,$s->stockout_out,1,0,'C',0);
    $pdf->Cell(20,6,'',1,1,'C',0);
    $total_salidas = $total_salidas +$s->stockout_out;
}
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,6,'TOTAL',0,0,'R',0);
$pdf->Cell(20,6,$total_added ?? 0,1,0,'C',0);
$pdf->Cell(20,6,$total_salidas ?? 0,1,0,'C',0);
$pdf->Cell(20,6,$total_selled ?? 0,1,0,'C',0);
$pdf->Ln();
$pdf->Output();

?>