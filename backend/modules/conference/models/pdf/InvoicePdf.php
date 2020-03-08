<?php

namespace backend\modules\conference\models\pdf;

use Yii;
use common\models\ConvertNumber;


class InvoicePdf
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
		$this->pdf->Output('invoice-'. $this->model->invoice_confly_no .'-'.$this->conf->conf_abbr .'.pdf', 'I');
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
<b>INVOICE</b>
<br />
<br />';


$html .= 'INVOICE NO: '.$this->model->invoice_confly_no .'/'.$this->conf->conf_abbr .'<br />
INVOICE DATE: '.date('F d<\s\up>S</\s\up>, Y', $this->model->invoice_ts).'<br />

<hr />
</div>


<div align="left">
<br />
'.$this->model->user->associate->title .' '.$this->model->user->fullname .'
<br /><br />
'. nl2br($this->model->user->associate->assoc_address) .'


</div>
<br />';

$border = 'style="border:1px solid #000000"';
$border_bottom = 'style="border-bottom:1px solid #000000"';


$html .= '<table border="0" cellpadding="3">
<tr style="background-color:#cccccc">
<td width="5%" align="center" '.$border.'><b>No. </b></td>
<td width="70%" align="center" '.$border.'>
<b>DESCRIPTION</b></td>
<td width="25%" align="center" '.$border.'><b>AMOUNT</b></td>
</tr>

<tr>
<td align="center" '.$border.'>1. </td>
<td '.$border.'>
CONFERENCE FEE: '.$this->conf->conf_name .'<br />
PAPER ID: '.$this->model->paperRef .'<br />
PAPER TITLE: '.$this->model->pap_title .'<br />
USER REGISTRATION: Presenter<br />
USER STATUS: '.$this->model->niceRole .'<br />
PAYMENT TYPE: Bank Transfer<br />
OTHERS: '.$this->model->paperRef .'
</td>
<td align="center" '.$border.'>'.$this->model->niceAmount.'</td>

</tr>

</table>
';

$currency = $this->model->invoice_currency;
$inv = number_format( $this->model->invoice_amount, 2);
$final = number_format( $this->model->invoice_final, 2);
$rounding = '0.00';
if($inv > $final){
	$rounding = '- ' . number_format($inv - $final, 2);
}else if($final - $inv){
	$rounding = '+ ' . number_format($final - $inv, 2);
}

$html .= '<table border="0" cellpadding="3">
<tr>
<td width="5%"></td>
<td width="70%" align="right">

</td>
<td width="10%" align="right">'.$currency .'</td>
<td width="15%" align="center">'.$inv.'</td>
</tr>

<tr>
<td></td>
<td align="right">
Round Adjustment
</td>
<td align="right">'.$currency .'</td>
<td align="center">'.$rounding.'</td>
</tr>

<tr>
<td></td>
<td align="right">
</td>
<td align="right"></td>
<td align="center"></td>
</tr>

<tr>
<td></td>
<td align="right">
<b>Total</b>
</td>
<td align="right"><b>'.$currency .'</b></td>
<td align="center"><b>'.$final.'</b></td>
</tr>

<tr>
<td></td>
<td align="right">
Payment before '. date('F d<\s\up>S</\s\up>, Y', strtotime($this->conf->earlyBirdDate)) .'
</td>
<td align="right">'.$currency .'</td>
<td align="center">'.number_format( $this->model->invoice_early, 2).'</td>
</tr>

<tr>
<td '.$border_bottom.'></td>
<td align="right" '.$border_bottom.'>
</td>
<td align="right" '.$border_bottom.'></td>
<td align="center" '.$border_bottom.'></td>
</tr>

</table>
';


$html .= $this->conf->payment_info_inv;

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
		$this->pdf->SetTitle('INVOICE '.$this->model->id);
		$this->pdf->SetSubject('INVOICE');
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
