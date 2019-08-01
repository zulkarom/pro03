<?php 

use yii\helpers\Url;


$this->title= 'MEMBER PAGE';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confmanager/views/myasset');
?>


<?=$this->render('_img_user')?>


<div class="block-content">

		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">WELCOME TO IJEBOB</h2>
				</div>

			</div>
			<br />
			<div class="row">
			
			<div class="col-lg-12"><p></p></div>
				
				<br />
				
				
				
			
			</div>
			<br />
			
			<div class="form-group" align="center"><a href="<?=Url::to(['submission/create'])?>" class="btn btn-primary">SUBMIT NEW MANUSCRIPT</a> </div>

		</div>
	</div>
	
<br /><br /><br />