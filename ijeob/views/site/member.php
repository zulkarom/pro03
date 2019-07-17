<?php 

use yii\helpers\Url;


$this->title= 'MEMBER PAGE';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@ijeob/views/myasset');
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
			
			<div class="col-lg-12"><p>The International Journal of Entrepreneurship, Organization and Business (IJEOB) is an academic, refereed journal published quarterly (March, June, September and December). This journal provides open access to its content on the principle that making research journal and academic manuscript freely available to the public supports a greater global exchange of knowledge. IJEOB publishes articles and theoretical reviews. IJEOB aims to address conceptual paper, book & article review, theoretical and empirical research issues that impact the development of current business trends as an educational and scientific discipline, and promote its efficiency in the economic, social and cultural contexts.</p></div>
				
				<br />
				
				
				
			
			</div>
			<br />
			
			<div class="form-group" align="center"><a href="<?=Url::to(['submission/create'])?>" class="btn btn-primary">SUBMIT NEW MANUSCRIPT</a> </div>

		</div>
	</div>
	
<br /><br /><br />