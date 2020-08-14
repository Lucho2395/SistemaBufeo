<?php
//Llamamos a la libreria
require_once 'pdf_base.php';
//creamos el objeto
$pdf=new PDF();
//Añadimos una pagina
$pdf->AddPage();

//Define el marcador de posición usado para insertar el número total de páginas en el documento
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',12);
$pdf->Cell(70,6,'Guia de '.$criterio,0,1,'C',0);
$pdf->Ln();
if($criterio=="entrada"){
    $pdf->Cell(30,6,'Fecha: '.$guia->stocklog_date,0,1,'L',0);
    $pdf->Cell(30,6,'Guia: '.$guia->stocklog_guide,0,1,'L',0);
    $pdf->Cell(30,6,'Descripcion: '.$guia->stocklog_description,0,1,'L',0);
    $pdf->Cell(30,6,'Producto: '.$guia->product_name,0,1,'L',0);
    $pdf->Cell(30,6,'Cantidad: '.$guia->stocklog_added,0,1,'L',0);
}elseif($criterio=="salida"){
    $pdf->Cell(30,6,'Fecha: '.$guia->stockout_date,0,1,'L',0);
    $pdf->Cell(30,6,'Guia: '.$guia->stockout_guide,0,1,'L',0);
    $pdf->Cell(30,6,'Descripcion: '.$guia->stockout_description,0,1,'L',0);
    $pdf->Cell(30,6,'Destino: '.$guia->stockout_destiny,0,1,'L',0);
    $pdf->Cell(30,6,'Ruc: '.$guia->stockout_ruc,0,1,'L',0);
    $pdf->Cell(30,6,'Origen: '.$guia->stockout_origin,0,1,'L',0);
    $pdf->Cell(30,6,'Producto: '.$guia->product_name,0,1,'L',0);
    $pdf->Cell(30,6,'Cantidad: '.$guia->stockout_out,0,1,'L',0);
}
$pdf->Ln(30);
$pdf->Cell(30,6,'___________________________________',0,1,'L',0);
$pdf->Cell(30,6,'               Firma',0,1,'C',0);

$pdf->Output();

?>