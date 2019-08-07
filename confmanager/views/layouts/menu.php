<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;

$dirAsset = Yii::$app->assetManager->getPublishedUrl('@confmanager/views/myasset');
$menu = [
	['List of Conference', ['site/index'], 'home'],
	['Dashboard', ['site/index'], 'tachometer-alt'],
	['Paper Submission', ['site/index'], 'files-o'],
	['Important Date', ['site/index'], 'table'],
	['Conference Fees', ['site/index'], 'dollar-sign'],
	['Organized By', ['site/index'], 'bank'],
	['Secretariat', ['site/index'], 'phone'],
]
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
                                <i class="fas fa-'.$m[2].'"></i>'.$m[0].'</a>
                        </li>';
					}
					
					
					?>
                        
						
                      
                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

       