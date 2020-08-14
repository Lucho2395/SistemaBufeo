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
$pdf->Cell(180,6,'Reporte de Inventario Permanente en Unidades Físicas '.$fecha,0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','U',12);
$pdf->Cell(70,6,'Productos',0,1,'L',0);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,'Cod',1,0,'C',1);
$pdf->Cell(60,6,'Producto',1,0,'C',1);
$pdf->Cell(18,6,'Saldo Ant',1,0,'C',1);
$pdf->Cell(15,6,'Entrada',1,0,'C',1);
$pdf->Cell(15,6,'Salida',1,0,'C',1);
$pdf->Cell(15,6,'Vendido',1,0,'C',1);
$pdf->Cell(20,6,'Precio Unit',1,0,'C',1);
$pdf->Cell(20,6,'Total',1,0,'C',1);
$pdf->Cell(15,6,'Saldo',1,0,'C',1);
$pdf->Ln();
$ingresos_productos = 0;
$pdf->SetFont('Arial','',8);
foreach ($products as $p){
    $inventario_inicial = $this->report->initial_inventory($turn, $p->id_product);
    $stock_added = $this->report->stockadded($turn, $p->id_product);
    $products_selled = $this->report->products_selled($turn, $p->id_product);
    $stock_out = $this->report->stockout($turn, $p->id_product);
    //Calcular Ganancia Por Producto
    $total_per_product = $this->report->total_per_product($turn, $p->id_product);
    $stock_final = $inventario_inicial + $stock_added - $products_selled;
    $stock_now = $this->report->total_products_now($p->id_product);
    $ingresos_productos = $ingresos_productos + $total_per_product;
    $pdf->Cell(10,6,$p->id_product,1,0,'C',0);
    $pdf->CellFitSpace(60,6,$p->product_name,1,0,'C',0);
    $pdf->Cell(18,6,$inventario_inicial ?? 0,1,0,'C',0);
    $pdf->Cell(15,6,$stock_added ?? 0,1,0,'C',0);
    $pdf->Cell(15,6,$stock_out ?? 0,1,0,'C',0);
    $pdf->Cell(15,6,$products_selled ?? 0,1,0,'C',0);
    $pdf->Cell(20,6,$p->product_price,1,0,'C',0);
    $pdf->Cell(20,6,$total_per_product ?? 0,1,0,'C',0);
    $pdf->Cell(15,6,$stock_final ?? 0,1,1,'C',0);
    $ingresos_productos = $ingresos_productos +$p->saleproduct_total;
}
$pdf->Cell(153,10,'TOTAL VENTA',0,0,'R',0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'S/. '.$ingresos_productos,0,0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Output();

?>