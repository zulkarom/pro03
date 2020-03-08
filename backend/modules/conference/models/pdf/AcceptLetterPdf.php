<?php

namespace backend\modules\conference\models\pdf;

use Yii;
use common\models\ConvertNumber;


class AcceptLetterPdf
{
	public $model;
	public $pdf;
	public $conf;
	public $directoryAsset;
	public $upload_dir;
	public $logo;
	
	
	public function generatePdf(){

		$this->pdf = new AcceptLetterPdfStart(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->startPage();
		$this->writeReceipt();
		$this->pdf->Output('acceptance-letter-'. $this->model->invoice_confly_no .'-'.$this->conf->conf_abbr .'.pdf', 'I');
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

<table border="0" cellpadding="5">
<tr>

<td width="20%">Name</td>
<td width="2%">:</td>
<td width="78%">{USER_NAME}</td>
</tr>

<tr>
<td>Institution</td>
<td>:</td>
<td>{INSTITUTION}</td>
</tr>

<tr>
<td>Address</td>
<td>:</td>
<td>
{USER_ADDRESS}
</td>
</tr>

<tr>
<td>Paper ID</td>
<td>:</td>
<td>
{PAPER_ID}
</td>
</tr>

<tr>
<td>Author</td>
<td>:</td>
<td>
{AUTHOR}
</td>
</tr>

<tr>
<td>Co-Author</td>
<td>:</td>
<td>
{CO_AUTHOR}
</td>
</tr>

<tr>
<td>Paper Title</td>
<td>:</td>
<td>
{PAPER_TITLE}
</td>
</tr>

<tr>
<td>Date</td>
<td>:</td>
<td>
{ACCEPT_DATE}
</td>
</tr>

</table>
<br /><br />
<table cellpadding="5">
<tr>
<td style="border-bottom: 1px  solid #000000"><b>NOTIFICATION OF PAPER ACCEPTANCE</b></td>
</tr>
</table>
<br /><br />
<table cellpadding="5">
<tr>
<td>
Dear {USER_NAME},
<br /><br />
On behalf of the {CONF_ABBR} Committee, we are pleased to inform you that your submitted full paper ({PAPER_ID}) entitled "{PAPER_TITLE}", has been <b><u>ACCEPTED</u></b> for the conference. Congratulation!
<br /><br />
You may wish to update you Presenter Name. Simply Login > My Submission > Paper Submission > Click on "EDIT".
<br /><br />
Please be informed that Conference Fee shall be paid by now. (Login > My Payment). Upload your proof of payment in the system after the payment is made.

<br /><br />

As a reminder, the {CONF_NAME} will be held on {CONF_DATE} at {CONF_VENUE}. We look forward to seeing you at the conference.

<br /><br />

Please be reminded that the <b>Conference Fee shall be paid 2 weeks before the conference</b>.

<br /><br /><br />

Again, thank you very much for your submission.
<br /><br /><br /><br />
Secretariat {CONF_ABBR}<br />
Tel: {PHONE_CONTACT}<br />
Fax: {FAX_CONTACT}<br />
Email: {EMAIL_CONTACT}<br />
Website: {WEBSITE}

</td>
</tr>
</table>
<br /><br />
';

$url = 'https://site.confvalley.com/' . $this->conf->conf_url ;

$searchReplaceArray = array(
'{USER_NAME}' => $this->model->userTitleName, 
'{INSTITUTION}' => $this->model->user->associate->institution, 
'{CONF_DATE}' => $this->conf->getConferenceDateRange(true), 
'{USER_ADDRESS}' => nl2br($this->model->user->associate->assoc_address),
'{PAPER_ID}' => $this->model->paperRef,
'{AUTHOR}' => $this->model->firstAuthor,
'{CO_AUTHOR}' => $this->model->getCoAuthors(', '),
'{PAPER_TITLE}' => $this->model->pap_title,
'{ACCEPT_DATE}' => $this->model->acceptDateStr,
'{CONF_ABBR}' => $this->conf->conf_abbr,
'{CONF_NAME}' => $this->conf->conf_name,
'{CONF_VENUE}' => $this->conf->conf_venue,
'{PHONE_CONTACT}' => $this->conf->phone_contact,
'{EMAIL_CONTACT}' => $this->conf->email_contact,
'{FAX_CONTACT}' => $this->conf->fax_contact,
'{WEBSITE}' => '<a href="'.$url.'">'.$url.'</a>',
);

$html= str_replace(
  array_keys($searchReplaceArray), 
  array_values($searchReplaceArray), 
  $html
); 



$this->pdf->SetFont('helvetica', '', 9.5);
$tbl = <<<EOD
$html
EOD;
$this->pdf->writeHTML($tbl, true, false, false, false, '');
		
		
	}

	public function startPage(){
		// set document information
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('Administrator');
		$this->pdf->SetTitle('ACCEPTANCE LETTER '.$this->model->id);
		$this->pdf->SetSubject('ACCEPTANCE LETTER');
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
