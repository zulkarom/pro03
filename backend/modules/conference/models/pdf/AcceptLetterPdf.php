<?php

namespace backend\modules\conference\models\pdf;

use Yii;
use common\models\ConvertNumber;


class AcceptLetterPdf
{
	public $model;
	public $pdf;
	public $directoryAsset;
	public $bhg_a_Y;
	public $bhg_b_Y;
	public $bhg_bstart_Y;
	public $bhg_bstart_Y_data;
	
	public $sum_begin_y;
	
	public $total_lec = 0;
	public $total_tut = 0;
	public $total_prac = 0;
	public $total_hour = 0;
	
	public function generatePdf(){

		$this->directoryAsset = Yii::$app->assetManager->getPublishedUrl('@frontend/views/myasset');
		
		$this->pdf = new AcceptLetterPdfStart(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$this->writeHeaderFooter();
		$this->startPage();
		$this->writeLetter();
		
		//$this->writeTop();
		//$this->writeDetails();
		
		$this->pdf->Output('letter-of-acceptance-.pdf', 'I');
	}
	
	public function writeHeaderFooter(){
		
	}

	public function writeLetter(){
		
	$this->pdf->SetFont('helvetica', '', 11);
	//$hari = date("jS \of F Y");
	$hari = date("F j, Y");
	
	$authors = $this->model->authors;
	$str = '';
		if($authors){
			$i = 1;
			$total = count($authors);
			foreach($authors as $au){
				$br = $i == $total ? '' : '<br />';
				$str .= $au->fullname . $br;
			$i++;
			}
	}
	$assoc = $this->model->user->associate;
	
	$html = '
	<table border="0"><tr><td><div align="right"><strong>Ref: '.$this->model->id.'</strong></div></td></tr></table>
	<p><b>'.$str.' </b><br/>
	';

	$html .= $assoc->institution
	. '<br />' . 
	$assoc->assoc_address . '<br/>
	</p>

	<table border="0"><tr><td><div align="right"><strong>Dated: '.$hari.'</strong></div></td></tr></table>

	<strong><u>NOTIFICATION OF PAPER ACCEPTANCE </u>
	<p>
	Dear Sir (s)/Madam (s)</strong></p>

	<table border="0"><tr><td><p style="text-align:justify">Congratulations! We are pleased to inform you that based on peer review process your submission entitled: <strong>'.$this->model->pap_title.'</strong> has been <strong>ACCEPTED</strong> for journal publication volume x issue x 20xx. </p></td></tr></table>

	<p>Please complete the following steps at your earliest.</p> 
	<ul>

	<li>xxx. </li>
	<li>xxx. </li>
	</ul>

	<p>Please feel free to contact us if you have any query through email by quoting your manuscript number. We are looking forward to welcome you in UMK.</p>


	<p>

	<p>Thank you for your submission.</p>

	<strong>Sincerely yours,</strong><br />
	<br />
	<strong>Editorial Committees </strong><br />
	IJOEB<br />
	Email: ijeobofficial@umk.edu.my
	</p>


	';


$tbl = <<<EOD
$html

EOD;

	$this->pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
	$this->pdf->writeHTML($tbl, true, false, false, false, '');


	}
	
	
	
	
	
	
	public function startPage(){
		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('Administrator');
		$this->pdf->SetTitle('LETTER OF ACCEPTANCE');
		$this->pdf->SetSubject('LETTER OF ACCEPTANCE');
		$this->pdf->SetKeywords('');



		// set header and footer fonts
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->pdf->SetMargins(0, 0, 0);
		
		$this->pdf->SetHeaderMargin(0);

		 //$this->pdf->SetHeaderMargin(0, 0, 0);
		 
		$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, -13); //margin bottom

		// set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------



		// add a page
		$this->pdf->AddPage("P");
	}
	
	
}
