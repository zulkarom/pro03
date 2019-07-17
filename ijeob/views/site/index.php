<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title= $journal->journalName .' - '. $journal->journal_abbr;
$current = $journal->currentIssue;
$calling = $journal->callingIssue;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@ijeob/views/myasset');
?>
	<!-- Home -->

	<div style="padding-top:35px; padding-bottom:15px; background-color:#f8f8f8">
	
<div class="container">
<div class="form-group">
		<?php $form = ActiveForm::begin([
        'action' => ['search/index'],
        'method' => 'get',
    ]); ?>
		<div class="row">
		<div class="col-md-4" style="text-align:center">
		<h4>Current Issues</h4>
		<?php 
		
		if($journal->currentIssue){
	echo '<p>'.$current->journalIssueName3 .'</p>
		<i>Published at: '.date('d M Y', strtotime($journal->currentIssue->published_at)) .'<br /></i>';
}else{
	
	echo '<div align="center">CALL FOR PAPER <br /><i>'.$journal->callingIssueName3 .'</i></div>';
}
		
		?>
		
		
		</div>
			<div class="col-md-6">
			<div class="form-group">
			
			 <?= $form->field($model, 'search_article')->textInput(['class' => 'form-control', 'style' => 'height:45px', 'placeholder' => 'Search articles in title, abstract or keywords...'])->label(false); ?>
			 <i><a href="<?=Url::to(['search/advanced-search'])?>">Advanced Search</a></i>
			 
			</div>
			</div>
			<div class="col-md-2">
			<div class="form-group">
			
			
		
			
			 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary', 'style' => 'height:45px']) ?>
			
			
			</div>
			</div>
		</div>
		 <?php ActiveForm::end(); ?>
		</div>

</div>
		
		
		

	</div>
	

	<!-- Language -->

	

	<!-- Courses -->

	<div class="aimjournal">
		<div class="container">
		
			<div class="row">
			
			<div class="col-lg-4">
			
			<table>
			<tr>
			<td><div class="form-group"><img width="90%" src="<?=$directoryAsset?>/img/book-cover.jpg" />
			</div>
			</td>
			<td><b><?=$journal->journal_name?></b><br />
			<?=$journal->journal_name2?>
			<br /><br />
			
			<b>ISSN online</b><br />
			1234-5678
			<br /><br />
			4 Issues per year</td>
			
			</tr>
			
			</table>
			
			
			</div>
			
		

			
			<div class="col-lg-8">
			<h3>ABOUT THIS JOURNAL</h3>
			<br />
			<p style="text-align:justify"><?=$journal->about?> </p></div>
			
			
				
				
				
			
			</div>
<br />
	

			
<br /><br />	


			
			
		</div>
	</div>
	


<div class="call_paper">
		<div class="container">
		
			<div class="row">
			
			
			<div class="col-lg-6 form-group">
			<h3>CALL FOR PAPER</h3>
			<br />
			<p style="text-align:justify">
			<?=$journal->journalName?>
			<br /><b>ISSN</b>: <?=$journal->journal_issn?> : <b>DOI</b> : <?=$journal->journal_doi?><br />
			<a href="<?=Url::to(['site/public-submit'])?>" class="btn btn-danger btn-sm"> Submission </a><br /><br />
			<a href="#"><b>Call For Paper <?=$journal->callingVolumeIssue?> </b></a><br />
			<b>Submission Deadlines</b><br />
			<b>Volume / Issue / Month</b> : <?=$journal->callingIssueName3?><br />
			Initial Submission : <?=$journal->callingSubmitStart?> - <?=$journal->callingSubmitEnd?><br />
			Submit Online: <a href="<?=Url::to(['site/public-submit'])?>">Click Here to Submit</a> <br />
			Submit Offline: <a href="http://?"><?=$journal->journal_email?></a> <br />
			
			
			
			</p></div>
			
			<div class="col-lg-6">
			<h3><i class="fa fa-envelope"></i> NEWSLETTER</h3>
			<br />
			<p style="text-align:justify">
Sign up to EduSage Network newsletter and stay up to date and get notices about new journal developments, conferences and research opportunities	
			</p><br />
			<?php $form = ActiveForm::begin(['action' => ['site/subscriber']]); ?>
			<div class="form-group">
			
<?= $form->field($subscriber, 'subs_email')->textInput(['class' => 'form-control' , 'placeholder' => 'Email Here']); ?>

			
			
			</div>
			
			<div class="form-group">
			<button type="submit" class="btn btn-primary">Subscribe</button>
			</div>
			<?php ActiveForm::end(); ?>
			
			</div>
			
			
				
				
				
			
			</div>
<br />
	

			
<br /><br />	


			
			
		</div>
	</div>


	
	<div class="front-issues" style="padding-bottom:10px;padding-top:50px">
		<div class="container">
		
		<div class="row">
				<div class="col">
					<h3 class="section_title text-center">CURRENT ISSUE</h3>
				</div>
		</div>
		
		<br />
		
<?php 

if($journal->currentIssue){
	echo $this->render('_list_articles', [
			'journal' => $journal->currentIssue,
	]);
}else{
	
	echo '<div align="center"><b>CALL FOR PAPER <br />'.$journal->callingIssueName .'</b></div>';
}
?>
		
		</div>
			

		</div>
	</div>
	
