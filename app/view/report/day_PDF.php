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
$pdf->Cell(180,6,'Reporte del dia '.$turn->turn_datestart,0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(180,6,'Ingresos',0,1,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','',7);
$pdf->Cell(70,6,'II = Inventario Inicial, SA = Stock Agregado, CV = Cant Vendida, CS = Cant Salida, CA = Cant Anulada, TS = Total Salida, SF = Stock Final, SS = Stock Sistema, G = Ganancias',0,1,'L',0);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Producto',1,0,'C',1);
$pdf->Cell(18,6,'II',1,0,'C',1);
$pdf->Cell(15,6,'SA',1,0,'C',1);
$pdf->Cell(15,6,'CV',1,0,'C',1);
$pdf->Cell(15,6,'CS',1,0,'C',1);
$pdf->Cell(15,6,'CA',1,0,'C',1);
$pdf->Cell(15,6,'TS',1,0,'C',1);
$pdf->Cell(15,6,'SF',1,0,'C',1);
$pdf->Cell(15,6,'SS',1,0,'C',1);
$pdf->Cell(23,6,'G',1,0,'C',1);
$pdf->Ln();
$ingresos_productos = 0;
$pdf->SetFont('Arial','',8);

    foreach ($products as $p){
        $inventario_inicial = $this->report->initial_inventory($turn, $p->id_product);
        $stock_added = $this->report->stockadded($turn, $p->id_product);
        $stock_out = $this->report->stockout($turn, $p->id_product);
        $products_selled = $this->report->products_selled($turn, $p->id_product);
        $products_revoke = $this->report->products_revoke($turn, $p->id_product);
        $total_products = $products_selled;
        //Calcular Ganancia Por Producto
        $total_per_product = $this->report->total_per_product($turn, $p->id_product);

        $stock_final = $inventario_inicial + $stock_added - $total_products - $stock_out - $products_revoke;
        $stock_now = $this->report->total_products_now($p->id_product);
        $ingresos_productos = $ingresos_productos + $total_per_product;

        $pdf->CellFitSpace(50,6,$p->product_name,1,0,'C',0);
        $pdf->Cell(18,6,$inventario_inicial,1,0,'C',0);
        $pdf->Cell(15,6,$stock_added,1,0,'C',0);
        $pdf->Cell(15,6,$products_selled,1,0,'C',0);
        $pdf->Cell(15,6,$stock_out,1,0,'C',0);
        $pdf->Cell(15,6,$products_revoke,1,0,'C',0);
        $pdf->Cell(15,6,$total_products,1,0,'C',0);
        $pdf->Cell(15,6,$stock_final,1,0,'C',0);
        $pdf->Cell(15,6,$stock_now,1,0,'C',0);
        $pdf->Cell(23,6,$total_per_product ?? 0,1,1,'C',0);
        $ingresos_productos = $ingresos_productos +$p->saleproduct_total;
}
$pdf->Cell(173,10,'TOTAL VENTA',0,0,'R',0);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(232,232,232);
$pdf->CellFitSpace(23,10,'S/. '.$ingresos_productos,1,0,'C',1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(180,6,'Egresos',0,1,'L',0);
$expense = $this->report->all_expense($turn);
$egresos = 0;
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(15,6,'Cod',1,0,'C',1);
$pdf->Cell(70,6,'Descripcion',1,0,'C',1);
$pdf->Cell(23,6,'Monto',1,1,'C',1);
foreach ($expense as $ex) {
    $pdf->CellFitSpace(15,6,$ex->id_expense,1,0,'C',0);
    $pdf->CellFitSpace(70,6,$ex->expense_description,1,0,'C',0);
    $pdf->Cell(18,6,$ex->expense_mont,1,1,'C',0);
}
$pdf->Cell(85,10,'TOTAL EGRESOS',0,0,'R',0);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(232,232,232);
$pdf->CellFitSpace(23,10,'S/. '.$egresos,1,1,'C',1);
$balance_final = $ingresos_productos - $egresos;
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,6,'TOTAL INGRESOS VENTAS',1,0,'L',1);
$pdf->Cell(30,6,'S/. '.$ingresos_productos ?? 0,1,1,'C',0);
$pdf->Cell(70,6,'TOTAL EGRESOS',1,0,'L',1);
$pdf->Cell(30,6,'S/. '.$egresos ?? 0,1,1,'C',0);
$pdf->Cell(70,6,'SALDO TOTAL DEL DIA',1,0,'L',1);
$pdf->Cell(30,6,'S/. '.$balance_final ?? 0,1,1,'C',0);
$pdf->Cell(70,6,'MONTO DE APERTURA DE CAJA',1,0,'L',1);
$pdf->Cell(30,6,'S/. '.$turn->turn_inicialcash ?? 0,1,1,'C',0);
$pdf->Cell(70,6,'TOTAL EN CAJA',1,0,'L',1);
$suma = $balance_final + $turn->turn_inicialcash;
$pdf->Cell(30,6,'S/. ' . $suma,1,1,'C',1);

$pdf->Ln();
$pdf->Output();

?>