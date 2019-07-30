<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use ijeob\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use ijeob\models\Stats;
use backend\modules\journal\models\Journal;

ijeob\models\MainAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@ijeob/views/myasset');

$journal_id = Yii::$app->params['journal_id'];
$journal = Journal::findOne($journal_id);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

	
	
</head>
<body>
<?php $this->beginBody() ?>


<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_phone"><span class="top_bar_title"> e-ISSN: <?=$journal->journal_issn?> | <i class="fa fa-envelope"></i> EMAIL: <?=$journal->journal_email?></div>
								<div class="top_bar_right ml-auto">
								
								

									<!-- Language -->
									<div class="top_bar_lang">
										<span class="top_bar_title">
										
			<?php 
			if(Yii::$app->user->isGuest){
				echo '<i class="fa fa-user"></i> <a href="' . Url::to(["/user/login"]) . '">LOGIN</a> OR <a href="'.Url::to(["/page/register"]) . '">REGISTER</a></span>';
			}else{
				
				echo Html::a('<i class="fa fa-user"></i> ' . Yii::$app->user->identity->fullname, ['user-setting/change-password'], ['data-method' => 'POST']);
				
				echo Html::a(' | LOGOUT', ['site/logout'], ['data-method' => 'POST']);
			}
			
			
			?>
										
										
										
										
									</div>

								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>
		
		
		<div class="top_bar2">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="top_bar2_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_phone"><span class="top_bar2_title"><?=$journal->journal_name?> <br /> <?=$journal->journal_name2?> </div>
								<div class="top_bar_right ml-auto">
								
								


								
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="top_bar2_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_phone"><span class="top_bar2_title" style="font-size:12px;"><i class="fa fa-bullhorn"></i>  Call for Paper <?=$journal->callingIssueName3?><br /> <a href="<?=Url::to(['site/public-submit'])?>" class="btn btn-danger btn-sm"><i class="fa fa-send"></i> Submit Manuscript</a></div>
								<div class="top_bar_right ml-auto">
								
								


								
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container mr-auto">
								
							<div class="logo_text" ><a href="<?=Url::to(['/site/index'])?>" style="color:#000000"><?=$journal->journal_abbr?></a></div>
								
							</div>
				<?php 
				
				function menu($mm = false){
					$lbl_logout = 'LOG OUT';
					if(Yii::$app->user->isGuest){
						$arr = [
							'ABOUT THIS JOURNAL' => Url::to(['/site/index']),
							'AIMS AND SCOPE' => Url::to(['/page/scope/']),
							'EDITORIAL BOARD' => Url::to(['/page/committee/']),
							'SUBMISSION' => Url::to(['/page/submission-guideline']),
							
							'PUBLICATION ETHICS' => Url::to(['/page/ethical-guideline']),
							'ARCHIVES' => Url::to(['/page/archive']),
					
						];
						if($mm){
							$arr['LOGIN'] = Url::to(['/user/login']);
							$arr['REGISTER'] = Url::to(['/page/register']);
						}
					}else{
						$submission = Stats::mySubmission();
						if($submission > 0){
							$color_sub = 'danger';
							$bdg_subm = '<span class="badge badge-danger">'.$submission.'</span>';
						}else{
							$bdg_subm = '';
						}
						$reviews = Stats::myReview();
						if($reviews > 0){
							$bdg_review = '<span class="badge badge-danger">'.$reviews.'</span>';
						}else{
							$bdg_review = '';
						}
						
						$arr = [
							'HOME' => Url::to(['/site/index']),
							'SUBMISSION '.$bdg_subm => Url::to(['/submission/index']),
							'REVIEW '.$bdg_review => Url::to(['review/index']),
							'TRANSACTION' => Url::to(['transaction/index']),
							//'EDITING' => Url::to(['editing/index']),
							'PROFILE' => Url::to(['user-setting/change-password']),
							$lbl_logout => Url::to(['site/logout']),
						
							
						];
					}
					
					$str = '';$cl = '';
					if($mm){
						$cl = ' class="menu_mm"';
					}
					foreach($arr as $label=>$url){
						$str .= '<li'.$cl.'>';
						if($label == $lbl_logout){
							$str .= Html::a($label, $url, ['data-method' => 'POST']);
						}else{
							$str .= '<a href="'.$url.'">'.$label.'</a>';
						}
						
						$str .= '</li>';
					}
					
					return $str;
				}
				
				?>
							<nav class="main_nav_contaner">
								<ul class="main_nav">
									<?=menu()?>
								</ul>
							</nav>
							<div class="header_content_right ml-auto text-right">
							

								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>

		<nav class="menu_nav">
			<ul class="menu_mm">
				<?=menu(true)?>
			</ul>
		</nav>

	</div>
	
	<div class="row">
	<div class="col-md-2"></div>
<div class="col-md-8">	<?= Alert::widget() ?></div>
</div>

</div>

	
	<?=$content?>


	<!-- Footer -->
<br /><br /><br />
	<footer class="footer">
		<div class="footer_body">
			<div class="container">
				<div style="color:#cccccc; font-size:14px" align="center">
				
				Address: <?=nl2br($journal->journal_address)?>
				
				<br /><?=$journal->phone1?>
				<br /><?=$journal->phone2?>
				<br />E-mail: <?=$journal->journal_email?>
				<br />Website: <?=Html::a($journal->journal_url,$journal->journal_url)?>
				
	

				
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="copyright_content d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">
							<div class="cr" style="text-right:center">
							
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a href="<?=$journal->journal_url?>" style="color:#a5a5a5"><?=$journal->journalName?> (<?=$journal->journal_abbr?>)</a> | All rights reserved | Made by <a style="color:#a5a5a5" href="http://skyhint.com" target="_blank">Skyhint Design</a> | Template by <a style="color:#a5a5a5" href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->


</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
