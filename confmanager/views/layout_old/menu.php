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
	['Fees', ['conference/fees', 'conf' => $confurl], 'dollar-sign', null],
	['Tentative', ['conference/tentative', 'conf' => $confurl], 'clock', null],
	//['Organized By', ['site/index'], 'bank', null],
	//['Secretariat', ['site/index'], 'phone', null]
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
                           <img src="<?=$dirAsset?>/images/icon/logo-confvalley.png" alt="CONFVALLEY" />
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
                   <img src="<?=$dirAsset?>/images/icon/logo-confvalley.png" alt="CONFVALLEY" />
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
					
					<li class="has-sub ">
                            <a class="js-arrow open" href="#">
                                <i class="fas fa-trophy"></i> <?=$conf->conf_abbr?>
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
					<?php 
					
					$controller = Yii::$app->controller->id;
					if($controller == 'paper'){
						$showpaper = 'block';
					}else{
						$showpaper = 'none';
					}
					
					?>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="display:block">
								<?php 
						
								foreach($sub as $s){
									if($s[0] == 'Papers'){
									echo '<li class="has-sub">';
									
									echo '<a class="js-arrow open" href="#">
                                <i class="fas fa-clone"></i> Papers <span class="badge badge-primary">'.$s[3].'</span>  
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list" style="display:'.$showpaper.'">
							';
							echo '<li><a href="'.Url::to(['paper/abstract', 'conf' => $confurl]).'"><i class="fas fa-file"></i> Abstract '.badge($conf->paperCountAbstract). '</a></li>';
							echo '<li><a href="'.Url::to(['paper/full-paper', 'conf' => $confurl]).'"><i class="fas fa-file-alt"></i> Full Paper '.badge($conf->paperCountFullPaper). '</a></li>';
							echo '<li><a href="'.Url::to(['paper/review', 'conf' => $confurl]).'"><i class="fas fa-search"></i> Review</a></li>';
							echo '<li><a href="'.Url::to(['paper/payment', 'conf' => $confurl]).'"><i class="fas fa-dollar-sign"></i> Payment '.badge($conf->paperCountPayment). '</a></li>';
							echo '<li><a href=""><i class="fas fa-check"></i> Complete</a></li>';
							
							echo '<li><a href="'.Url::to(['paper/overwrite', 'conf' => $confurl]).'"><i class="fas fa-edit"></i> Overwrite</a></li>';
							
							echo '</ul>';
									echo '</li>';
									
									
									}else{
										echo '<li>
											<a href="'.Url::to($s[1]).'">
												<i class="fas fa-'.$s[2].'"></i>'.$s[0].' <span class="badge badge-primary">'.$s[3].'</span></a>';
												
									
										echo '</li>';
									}
									
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