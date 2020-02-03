<?php

namespace backend\modules\conference\models\pdf;

use Yii;
use common\models\ConvertNumber;


class ReceiptPdf
{
	public $model;
	public $pdf;
	public $conf;
	public $directoryAsset;
	public $upload_dir;
	public $logo;
	
	
	public function generatePdf(){

		$this->pdf = new InvoicePdfStart(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->startPage();
		$this->writeReceipt();
		$this->pdf->Output('receipt.pdf', 'I');
	}
	
	public function writeReceipt(){
		$this->pdf->setY(15);
 $this->pdf->setImageScale(1.53);
 
$html = '
<div align="center">
<img src="'.$this->logo .'" /><br />
<b style="font-size:11pt">'.$this->conf->conf_name .'</b>
<br /><b style="font-size:8pt">'.nl2br($this->conf->conf_address).'</b>


<br />

<hr />
</div>


<div align="left">
<b>PAYMENT RECEIPT</b>
<br />
<br />
RECEIPT NO: '.$this->model->receipt_confly_no .'/'.$this->conf->conf_abbr .'<br />
RECEIPT DATE: '.date('F d<\s\up>S</\s\up>, Y', $this->model->receipt_ts).'<br />
REFERENCE: '.$this->model->paperRef .'<br />

<hr />
</div>


<div align="left">
<b>RECEIVED FROM</b>
<br />
<br />
'.$this->model->user->associate->title .' '.$this->model->user->fullname .'
<br /><br />
'. nl2br($this->model->user->associate->assoc_address) .'


</div>
<br />

<table border="1" cellpadding="3">

<tr style="background-color:#cccccc">
<td width="75%" align="center"><b>PAYMENT FOR</b></td><td width="25%" align="center"><b>AMOUNT</b></td>

</tr>

<tr>
<td>

CONFERENCE FEE: '.$this->conf->conf_name .'<br />
PAPER ID: '.$this->model->paperRef .'<br />
PAPER TITLE: '.$this->model->pap_title .'<br />
USER REGISTRATION: Presenter<br />
USER STATUS: '.$this->model->niceRole .'<br />
PAYMENT TYPE: Bank Transfer<br />
OTHERS: '.$this->model->paperRef .'

</td><td align="center">'.$this->model->niceAmount.'</td>

</tr>

</table>
<br /><br />
Thank you for the payment.


';

$this->pdf->SetFont('times', '', 9.5);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');
		
		
	}

	public function startPage(){
		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('Administrator');
		$this->pdf->SetTitle('RECEIPT '.$this->model->id);
		$this->pdf->SetSubject('RECEIPT');
		$this->pdf->SetKeywords('');
		// set header and footer fonts
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$this->pdf->SetMargins(20, 0, 17);
		//$this->pdf->SetHeaderMargin(10);
		$this->pdf->SetFooterMargin(20);

		// set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, 20); //margin bottom

		// set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->pdf->setLanguageArray($l);
		}

		$this->pdf->AddPage("P");
	}
	
	
}
