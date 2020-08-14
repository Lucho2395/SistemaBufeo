<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF{

    //Cabecera de pagina
    function Header(){
        //Arial bold 15
        $this->SetFont('Arial','B',16);
        //Mover
        $this->Cell(30);
        //Titulo
        $this->Cell(130,10,'DISTRIB. DE LAMINADO Y ACERO MYS EIRL',0,1,'C');
        $this->SetFont('Arial','B',14);
        $this->Cell(190,10,'LYMASAC LORETO',0,0,'C');
        //Salto de linea
        $this->Ln(20);
    }

    //Pie de pagina
    function Footer(){
        //Posicion: a 1.5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Numero de Ipagina
        $this->Cell(0,10,'Pagina ' . $this->PageNo().'/{nb}',0,0,'C');
    }
}
?>