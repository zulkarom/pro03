<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title= 'HOME';

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confsite/views/myasset');
?>

<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5"><?=$model->conf_name?></h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">

        </div>
      </div>
    </div>
  </header>
  
  
  

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-screen-desktop m-auto text-primary"></i>
            </div>
            <h3>Event Registration</h3>
            <p class="lead mb-0">Set up dynamic, online registration with our event planning system. Easy to use, easy to monitor.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-layers m-auto text-primary"></i>
            </div>
            <h3>Email Marketing</h3>
            <p class="lead mb-0">Personalise, send and track email invitations, reminders and other attendee communications.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-check m-auto text-primary"></i>
            </div>
            <h3>Payment Processing</h3>
            <p class="lead mb-0">njoy fast and secure event payment processed online and delivered directly into your bank account.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


