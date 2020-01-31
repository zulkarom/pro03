<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use backend\modules\conference\models\Conference;
$conf = null;

$dirAsset = Yii::$app->assetManager->getPublishedUrl('@confmanager/views/myasset');
if(Yii::$app->getRequest()->getQueryParam('conf')){
$confurl = Yii::$app->getRequest()->getQueryParam('conf');

$conf = Conference::findOne(Yii::$app->getRequest()->getQueryParam('conf'));

$menu = [
	['List of Conference', ['site/index'], 'home', null],
];
$sub = [
	['Website', ['conference/update', 'conf' => $confurl], 'globe', null],
	['Registration', ['register/index', 'conf' => $confurl], 'users', $conf->userCount],
	['Papers', ['paper/index', 'conf' => $confurl], 'files-o', $conf->paperCount],
	['Important Date', ['conference/dates', 'conf' => $confurl], 'calendar', null],
	['Downloads', ['download/index','conf' => $confurl], 'download', null],
	['Fees', ['conference/fees', 'conf' => $confurl], 'dollar', null],
	['Tentative', ['conference/tentative', 'conf' => $confurl], 'clock-o', null],
	//['Organized By', ['site/index'], 'bank', null],
	//['Secretariat', ['site/index'], 'phone', null]
];

}else{
	$menu = [
	['List of Conference', ['site/index'], 'home', null],
];
}

?>
        <div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
					
					
						<li><a href="<?=Url::to(['site/index'])?>"><i class="lnr lnr-home"></i> <span>List of Conference</span></a></li>
						
						<?php if(Yii::$app->getRequest()->getQueryParam('conf')){?>
						
						
						
						
						
						
						<li><a href="#" class=""> &nbsp;&nbsp; <span><u><b><?=$conf->conf_abbr?></b></u></span></a></li>
						
					
						
						
						<?php 
						
						foreach($sub as $s){
							
								if($s[0] == 'Papers'){
									echo '<li class="has-sub">';
									
									echo '<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Papers <span class="badge badge-primary">'.$s[3].'</span></span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>';
									
									
                            echo '
							<div id="subPages" class="collapse ">
							<ul class="nav">
							';
							echo '<li><a href="'.Url::to(['paper/abstract', 'conf' => $confurl]).'"><i class="fa fa-file"></i> Abstract '.badge($conf->paperCountAbstract). '</a></li>';
							echo '<li><a href="'.Url::to(['paper/full-paper', 'conf' => $confurl]).'"><i class="fa fa-file-alt"></i> Full Paper '.badge($conf->paperCountFullPaper). '</a></li>';
							echo '<li><a href="'.Url::to(['paper/review', 'conf' => $confurl]).'"><i class="fa fa-search"></i> Review</a></li>';
							echo '<li><a href="'.Url::to(['paper/payment', 'conf' => $confurl]).'"><i class="fa fa-dollar"></i> Payment '.badge($conf->paperCountPayment). '</a></li>';
							echo '<li><a href=""><i class="fas fa-check"></i> Complete</a></li>';
							
							echo '<li><a href="'.Url::to(['paper/overwrite', 'conf' => $confurl]).'"><i class="fas fa-edit"></i> Overview Table</a></li>';
							
							echo '</ul>
							</div>
							';
									echo '</li>';
									
									
									}else{
										echo '<li>
											<a href="'.Url::to($s[1]).'">
												<i class="fa fa-'.$s[2].'"></i>'.$s[0].' </a>';
												
									
										echo '</li>';
									}
									
										
									
								}
						
						
						?>
						
						<?php } ?>
						
						
						

						
						
					</ul>
				</nav>
			</div>
		</div>

<?php 

function badge($count){
	if($count == 0){
		return '';
	}else{
		return '<span class="badge badge-danger">
		'.$count.'
		</span>';
	}
}

?>  