<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF{
    //Cabecera de pagina
    protected $FontSpacingPt;
    function Header(){
        //Arial bold 15
        $this->SetFont('Arial','B',16);
    }
    function SetFontSpacing( $size ) {
        if ( $this->FontSpacingPt == $size ) return;

        $this->FontSpacingPt = $size;
        $this->FontSpacing = $size / $this->k;

        if ( $this->page > 0 )
            $this->_out( sprintf( 'BT %.3f Tc ET', $size ) );
    }
    //Pie de pagina
    function Footer(){
    }
}
?>