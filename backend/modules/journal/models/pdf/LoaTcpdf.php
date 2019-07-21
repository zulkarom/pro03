<?php

namespace backend\modules\journal\models\pdf;

class LoaTcpdf extends \TCPDF {
	
      //Page header
    public function Header() {
		//$this->myX = $this->getX();
		//$this->myY = $this->getY();
		//$savedX = $this->x;
		//savedY = $this->y;

        $this->SetFont('times', '', 10);
		 $html = '<img src="images/banner.jpg" />';
		$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
	 
		//$this->setX($this->myX);
		//$this->setY($this->myY);
		//$this->setY(100);
		//$this->SetY($savedY);
		//$this->SetX($savedX);
        // Title
       //$this->Cell(0, 2, 'The 5th International Seminar on Entrepreneurship and Business', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	    $this->SetTopMargin($this->GetY() + 2);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-13);
		 $html = '<img src="images/footer.jpg" />';
		$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        // Set font
        //$this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
