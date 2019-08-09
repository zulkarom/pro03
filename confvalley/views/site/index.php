<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title= 'CONFVALLEY - THE CONFERENCE MANAGEMENT SYSTEMS';

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confvalley/views/myasset');
?>
	<!-- Home -->


 <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="#main">CONFVALLEY</a></h1>
       <!--  <a href="#intro" class="scrollto"><img src="img/logo.png" alt="" title=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#about">About</a></li>
		  <li><a href="#schedule">Upcoming Conferences</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="#contact">Contact</a></li>
          <li class="buy-tickets"><a href="#buy-tickets">Register</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">The <span>Conference</span><br>Management System</h1>
      <p class="mb-4 pb-0">Effective Conference Management Event</p>
  
      <a href="#about" class="about-btn scrollto">About The System</a>
    </div>
  </section>

  <main id="main">

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2>About The System</h2>
            <p><?=$confv->about?></p>
          </div>
         
        </div>
      </div>
    </section>
	
	
	
	<?=$this->render('_advantages')?>

    <?=$this->render('_conferences')?>

 
   
    <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Newsletter</h2>
          <p>Sign up to EduSage Network newsletter and stay up to date and get notices about new journal developments, conferences and research opportunities.</p>
        </div>

        <form method="POST" action="#">
          <div class="form-row justify-content-center">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Enter your Email">
            </div>
            <div class="col-auto">
              <button type="submit">Subscribe</button>
            </div>
          </div>
        </form>

      </div>
    </section>


    <?=$this->render('_contact', ['confv' => $confv])?>

  </main>


 <?=$this->render('_footer', ['confv' => $confv])?>

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

