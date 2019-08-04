<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

confsite\assets\MainAsset::register($this);
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@confsite/views/myasset');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	 <title><?=$this->title?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <?= Html::csrfMetaTags() ?>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	
	<?php $this->head() ?>
	
	

	
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1" style="height:80px">
		<!-- Header desktop -->
		<div class="container-menu-header">


			<div class="wrap_header">

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="index.html">Home</a>
				
							</li>

							<li>
								<a href="product.html">Submit Paper</a>
							</li>

							<li class="sale-noti">
								<a href="product.html">Login</a>
							</li>

							<li>
								<a href="cart.html">Register</a>
							</li>

					

							<li>
								<a href="contact.html">Contact Us</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					
					
					
					<div class="header-wrapicon2">
						<a href="#" class="header-icon1 js-show-header-dropdown">
						<img src="images/icons/icon-header-01.png"  alt="ICON">
						 Zulkarom </a>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown" style="width:240px">
							

							<div class="header-cart-total" style="text-align:left">
								Profile
							</div>

							<div class="header-cart-buttons">
						

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Log Out
									</a>
								</div>
							</div>
						</div>
					</div>

				
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">


					<li class="item-menu-mobile">
						<a href="index.html">Home</a>
					</li>

					<li class="item-menu-mobile">
						<a href="product.html">Submit Paper</a>
					</li>

					<li class="item-menu-mobile">
						<a href="product.html">Login</a>
					</li>

					<li class="item-menu-mobile">
						<a href="cart.html">Register</a>
					</li>

					<li class="item-menu-mobile">
						<a href="blog.html">Contact Us</a>
					</li>

					
				</ul>
			</nav>
		</div>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page flex-col-c-m">
		<img src="images/banner.jpg" width="100%" />
	</section>

	<!-- content page -->
	<section class="bgwhite">
		<div class="container">
			<div class="row">
			<div class="col-md-3 col-lg-3 p-b-75">
					<div class="rightbar">
						<!-- Search -->


						<!-- Categories -->
						<h4 class="m-text23 p-t-56 p-b-34">
							MENU
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									CALL FOR PAPERS
								</a>
							</li>
							
							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									SCOPES
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									IMPORTANT DATES
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
								VANUE & ACCOMMODATION
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									FEES AND PAYMENT
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									COMMITTEE
								</a>
							</li>
							
						</ul>
						
						<!-- Categories -->
						<h4 class="m-text23 p-t-56 p-b-34">
							RESOURCES
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									BROCHURES
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									TENTATIVE SCHEDULE
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
								SUBMISSION TEMPLATE
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									FREQUENLY ASKED QUESTIONS
								</a>
							</li>

							
						</ul>

					</div>
				</div>
				<div class="col-md-6 col-lg-6 p-b-75">
					<div class="p-r-50 p-r-0-lg">
						<!-- item blog -->
						<div class="item-blog p-b-80">
						

							<?=$content?>
						</div>

		
						
					</div>

				</div>
				
				<div class="col-md-3 col-lg-3 p-b-75">
					<div class="rightbar">
						<!-- Search -->


						<!-- Categories -->
						<h4 class="m-text23 p-t-56 p-b-34">
							ANNOUNCEMENTS
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									All of u invited to the conference, thank you
								</a>
							</li>
							
						
							
						</ul>
						
						<!-- Categories -->
						<h4 class="m-text23 p-t-56 p-b-34">
							IMPORTANT DATES
						</h4>

						<ul>
							<li class="p-t-6 p-b-8 bo6">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Early Bird Deadline: 23 August 2019
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
									Abstract Deadline: 28 August 2019
								</a>
							</li>

							<li class="p-t-6 p-b-8 bo7">
								<a href="#" class="s-text13 p-t-5 p-b-5">
								Full Paper Deadline: 30 October 2019
								</a>
							</li>

							
						</ul>

					</div>
				</div>

				
			</div>
		</div>
	</section>


	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		

		<div class="t-center p-l-15 p-r-15">
			
			<div class="t-center s-text8 p-t-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	
	<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>