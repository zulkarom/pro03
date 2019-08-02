<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

confmanager\assets\MainAsset::register($this);
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@confmanager/views/myasset');
$menu = [
	['List of Conference', ['site/index'], 'home'],
	['Dashboard', ['site/index'], 'tachometer-alt'],
	['Paper Submission', ['site/index'], 'chart-bar'],
	['Important Date', ['site/index'], 'table'],
	['Conference Fees', ['site/index'], 'check-square'],
]

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?= Html::csrfMetaTags() ?>
    <meta name="description" content="conference">
    <meta name="author" content="skyhint design">
    <meta name="keywords" content="conference manager">
     <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>

<body class="animsition">
<?php $this->beginBody() ?>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                           CONFVALLEY
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
                <a href="#">
                    CONFVALLEY
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

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?=$dirAsset?>/images/icon/avatar.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Manager</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?=$dirAsset?>/images/icon/avatar.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Manager</a>
                                                    </h5>
                                                    <span class="email">manager@confvalley.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                
                                            </div>
                                            <div class="account-dropdown__footer">

                                                    
													
													<?=Html::a('<i class="zmdi zmdi-power"></i>Logout</a>', ['site/logout'], ['data-method' => 'POST']);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
					
						<div class="row">
	<div class="col-md-2"></div>
<div class="col-md-8">	<?= Alert::widget() ?></div>
</div>

</div>

	
	
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1"><?=$this->title?></h2>
          
                                </div>
                            </div>
                        </div>
                        
                        <?=$content?>
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>


<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>