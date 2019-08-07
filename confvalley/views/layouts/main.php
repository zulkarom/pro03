<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

confvalley\assets\MainAsset::register($this);
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@confvalley/views/myasset');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?=$this->title?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?= Html::csrfMetaTags() ?>
  
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?=$dirAsset?>/img/favicon.png" rel="icon">
  <link href="<?=$dirAsset?>/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>
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

    <!--==========================
      About Section
    ============================-->

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2>About The System</h2>
            <p>A Conference Management System that is easy to use in managing paper submission, registration, payment and paper review. It helps the conference organizers to work systematically in monitoring and making decision because the main process of organizing a conference using this conference management system is automatic.</p>
          </div>
         
        </div>
      </div>
    </section>
	
	
	<section id="supporters" class="section-with-bg wow fadeInUp">
    <div class="container">
	
	<div class="section-header">
          <h2>Advantages</h2>
        </div>
		<style>
		.advantage{
			text-align:center;
		}
		.advantage-icon{
			font-size: 4.5rem;
		}
		.advantage-con{
			margin-bottom:20px;
		}
		</style>
		
      <div class="row">
        <div class="col-lg-3">
          <div  class="advantage">
            <div class="advantage-con">
			<i class="fa fa-desktop" style="font-size: 4.5rem;"></i>

            </div>
            <h3>Event Registration</h3>
            <p class="lead mb-0">Set up dynamic, online registration with our event planning system. Easy to use, easy to monitor.</p>
          </div>
        </div>
		<div class="col-lg-3">
          <div  class="advantage">
            <div class="advantage-con">
			<i class="fa fa-files-o" style="font-size: 4.5rem;"></i>

            </div>
            <h3>Online Submission</h3>
            <p class="lead mb-0">Set up dynamic, online registration with our event planning system. Easy to use, easy to monitor.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div  class="advantage">
            <div class="advantage-con">
			<i class="fa fa-envelope" style="font-size: 4.5rem;"></i>

            </div>
            <h3>Email Marketing</h3>
            <p class="lead mb-0">Personalise, send and track email invitations, reminders and other attendee communications.</p>
          </div>
        </div>
        <div class="col-lg-3">
          <div  class="advantage">
            <div class="advantage-con">
			<i class="fa fa-dollar" style="font-size: 4.5rem;"></i>

            </div>
            <h3>Payment Process</h3>
            <p class="lead mb-0">njoy fast and secure event payment processed online and delivered directly into your bank account.</p>
          </div>
        </div>
      </div>
    </div>
  </section>



    <!--==========================
      Schedule Section
    ============================-->
    <section id="schedule" class="section-with-bg">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>UPCOMING CONFERENCES</h2>
          <p>Here is the upcoming conferences hosted by us</p>
        </div>


        <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius
          necessitatibus voluptatem quis labore perspiciatis quia.</h3>

        <div class="tab-content row justify-content-center">

          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

            <div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>
			
			<div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>
			
			<div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>
			
			<div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>
			
			<div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>
			
			<div class="row schedule-item">
              <div class="col-md-3"><time>12th November 2019</time></div>
              <div class="col-md-9">
                <h4>International Seminar on Entrepreneurship and Business 2019</h4>
                <p>Hotel Perdana, Kota Bharu Kelantan Malaysia</p>
              </div>
            </div>


          </div>
		  
		  

        </div>
		
		<div align="center" style="margin-top:20px;"><a href="#about" class="btn btn-danger">More Conferences</a></div>
		
		
		

      </div>

    </section>

 
   
    <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Newsletter</h2>
          <p>Rerum numquam illum recusandae quia mollitia consequatur.</p>
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

    <!--==========================
      Buy Ticket Section
    ============================-->
    

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Nihil officia ut sint molestiae tenetur.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>


  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo.png" alt="TheEvenet">
            <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Confvalley.com</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>


  <?php $this->endBody() ?>
</body>

</html>


<?php $this->endPage() ?>