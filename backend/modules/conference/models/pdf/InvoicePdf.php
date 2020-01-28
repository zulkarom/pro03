<?php

namespace backend\modules\conference\models\pdf;

use Yii;
use common\models\ConvertNumber;


class InvoicePdf
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
		
		$this->pdf = new InvoicePdfStart(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$this->writeHeaderFooter();
		$this->startPage();
		$this->writeTop();
		$this->writeDetails();
		
		

		$this->pdf->Output('invoice.pdf', 'I');
	}
	
	public function writeHeaderFooter(){
		$this->pdf->top_margin_first_page = - 4;
		$this->pdf->header_first_page_only = true;
		$this->pdf->header_html ='';
		$this->pdf->footer_first_page_only = true;
		$this->pdf->footer_html ='';
	}

	
	
	
	public function writeTop(){
		
	$tw = 620;
	$col1 = 400;
	$col2 = $tw - $col1;

	$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);


$html = '<table border="0">
<tr><td width="'.$col1.'"><h2>INVOICE</h2></td>
<td width="'.$col2.'" align="right">
LOGO<br />
<b>EDUSAGE NETWORK SDN. BHD.</b><br />
<i>U-XXXXXX</i><br />
1830 - C, Pengkalan Nangka <br />
16100 Kota Bharu, Kelantan<br />
<a href="http://edusage.com" target="_blank">http://edusagenet.com</a>

</td></tr>

</table>';



$this->pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');
		
		
	}
	
	public function writeDetails(){
		$html = '<h3>summary<h3>';

$this->pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');

$border_btm_head = 'style="border-top: 3px solid #CCCCCC"';

$border_bottom = 'style="border-top: 2px solid #CCCCCC"';

$i = 1;
$border = $i == 1 ? $border_btm_head : $border_bottom;


$tw = 620;
$qty = 70;
$rate = 100;
$amt= 100;
$desc = $tw - $qty - $rate - $amt;

$html = '<div><table cellpadding="7">
<tr>
	<td width="'.$desc.'">Description</td>
	<td width="'.$qty.'">Quantity</td>
	<td width="'.$rate.'">Rate</td>
	<td width="'.$amt.'">Amount (RM)</td>
</tr>';

$subtotal = 0;

			
$html .= '<tr nobr="true"><td '.$border.' width="'.$desc.'">
<b>payment for conference</b>
description here...
</td>
<td '.$border.' width="'.$qty.'">1</td>

<td '.$border.' width="'.$rate.'">RM200</td>

<td '.$border.' width="'.$amt.'">RM200</td>
</tr>

';


$border_sub = 'style="border-top: 3px solid #CCCCCC;border-bottom: px solid #CCCCCC; "';

$html .= '<tr>
	<td width="'.$desc.'"></td>
	<td '.$border_btm_head.' width="'.$qty.'"></td>
	<td '.$border_btm_head.' width="'.$rate.'"><b>Sub Total</b></td>
	<td '.$border_btm_head.' width="'.$amt.'"><b>'.number_format($subtotal, 2).'</b></td>
</tr>';
$total = $subtotal;



	$html .= '<tr>
	<td width="'.$desc.'"></td>
	<td '.$border_bottom.' width="'.$qty.'"></td>
	<td '.$border_bottom.' width="'.$rate.'"><b>Discount</b></td>
	<td '.$border_bottom.' width="'.$amt.'">('.number_format(0, 2).')</td>
	</tr>';





///////////////TOTAL/////////////////////

$html .= '<tr>
	<td width="'.$desc.'"></td>
	<td '.$border_bottom.' width="'.$qty.'"></td>
	<td '.$border_bottom.' width="'.$rate.'"><b>Total</b></td>
	<td '.$border_bottom.' width="'.$amt.'"><b>'.number_format($total, 2).'</b></td>
</tr>';

$html .= '</table></div>';



$html_items = $html;


$tw = 640;
$col1 = 250;
$col2 = 150;
$sp= 20;
$col3 = $tw - $col1 - $col2 - $sp;
$html = '<table border="0">
<tr><td width="'.$col1.'"><b>TO</b> <br />

<table cellpadding="5">
<tr> <td style="border: 3px solid #CCCCCC">';

$client = $this->model->user;
$assoc = $client->associate;
$html .= $assoc->title . ' ' . $client->fullname . '<br />';
$html .= $assoc->institution . '<br />';
$html .= $assoc->assoc_address;

$html .= '</td>
</tr>
</table>


</td>
<td width="'.$col2.'" align="right">
<b>INVOICE NO.</b><br />
INV'.$this->model->id .'<br />
<b>DATE</b><br />
'. strtoupper(date('d M Y', $this->model->invoice_ts) ).'<br />
<b>STATUS</b><br />
';

$html.= strtoupper('whata??');



$html .= '

</td>

<td width="'.$sp.'" align=""></td>

<td width="'.$col3.'" align="">';


$params = $this->pdf->serializeTCPDFtagParameters(array("TOTAL", 1, $subtotal));
$html .= '
<tcpdf method="mybox" params="'.$params.'" />';



$html .= '</td>


</tr>

</table>';

$this->pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');

$this->pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
$html_items
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');



$tw = 620;
$col1 = 450;
$col2 = $tw - $col1;

$spell = ConvertNumber::convertNumber($total, true);

$html = '<table align="right" border="0"><tr><td><strong>Total</strong>: Ringgit Malaysia '.ucwords($spell).' Only <br /></td></tr></table>
<table border="0" nobr="true">
<tr>

<td width="'.$col1.'">
<b>NOTE</b><br /><br />';
$note_arr = explode("\n", 'ini adalah note');
if($note_arr){
	$html .= '<table border="0">';
	$i = 1;
	foreach($note_arr as $n){
		$html .= '<tr><td width="3%">'.$i.'. </td><td>' . $n . '</td></tr>';
	$i++;
	}
	$html .= '</table>';
}

$html .= '</td>
<td width="'.$col2.'" align="right">
<br /><br /><b>ISSUED BY</b><br /><br />
Admin<br />
Edusage Network Sdn. Bhd.<br />
 <a href="mailto:edusagenet@gmail.com">edusagenet@gmail.com</a>
</td>

</tr>

</table>';

$this->pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');

	}
	
	
	
	public function startPage(){
		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('Administrator');
		$this->pdf->SetTitle('INVOICE '.$this->model->id .' EDUSAGE NETWORK');
		$this->pdf->SetSubject('INVOICE');
		$this->pdf->SetKeywords('');



		// set header and footer fonts
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->pdf->SetMargins(25, 10, PDF_MARGIN_RIGHT);
		//$this->pdf->SetMargins(0, 0, 0);
		$this->pdf->SetHeaderMargin(10);
		//$this->pdf->SetHeaderMargin(0);

		 //$this->pdf->SetHeaderMargin(0, 0, 0);
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

		// ---------------------------------------------------------



		// add a page
		$this->pdf->AddPage("P");
	}
	
	
}
