<?php

use yii\helpers\Url;
use yii\grid\GridView;
$journal = $issue->journal;
$this->title = $journal-> journalName . ' ' . $journal->journal_name ;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@ijeob/views/myasset');
?>
<div class="block-content">
		<div class="container">
		
		
			<div class="row">
			
			<div class="col-lg-12">
			
			 <?=$this->render('../site/_list_articles', [
				'journal' => $issue
			 ])?>
			
			
			</div>
				
				
			
			</div>
			<br />

	
			
			
		</div>
	</div>