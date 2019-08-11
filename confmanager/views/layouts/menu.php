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
	['Users', ['site/index'], 'users', 120],
	['Papers', ['site/index'], 'files-o', 12],
	['Important Date', ['conference/dates', 'conf' => $confurl], 'calendar', null],
	['Fees', ['site/index'], 'dollar-sign', null],
	['Organized By', ['site/index'], 'bank', null],
	['Secretariat', ['site/index'], 'phone', null]
];

}else{
	$menu = [
	['List of Conference', ['site/index'], 'home', null],
];
}

?>
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                           <img src="<?=$dirAsset?>/images/icon/logo.png" alt="CONFVALLEY" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
					
					<?php 
					
					foreach($menu as $m){
						echo '<li>
                            <a href="'.Url::to($m[1]).'">
                                <i class="fas fa-'.$m[2].'"></i>'.$m[0].'</a>
                        </li>';
					}
					
					
					?>
                      
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="<?=Url::to('site/index')?>">
                   <img src="<?=$dirAsset?>/images/icon/logo.png" alt="CONFVALLEY" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
					
					
					
					<?php 
					
					foreach($menu as $m){
						echo '<li>
                            <a href="'.Url::to($m[1]).'">
                                <i class="fas fa-'.$m[2].'"></i>'.$m[0].'</a> ';
						
						
                        echo '</li>';
					}
					
					
					?>
					
					
					<?php if(Yii::$app->getRequest()->getQueryParam('conf')){?>
					
					<li class="has-sub">
                            <a class="js-arrow open" href="#">
                                <i class="fas fa-trophy"></i> <?=$conf->conf_abbr?>
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="display:block">
								<?php 
						
								foreach($sub as $s){
									echo '<li>
										<a href="'.Url::to($s[1]).'">
											<i class="fas fa-'.$s[2].'"></i>'.$s[0].' <span class="badge badge-primary">'.$s[3].'</span></a>';
											
								
									echo '</li>';
								}


								
								?>
                                
                            </ul>
                        </li>
					
					<?php } ?>
					
					
                        
						
                      
                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

       