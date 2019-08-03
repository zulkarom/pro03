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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?= Html::csrfMetaTags() ?>
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$this->title?></title>
  
  <?php $this->head() ?>

 <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">confsite</a>
      <a class="btn btn-primary" href="#">Sign In</a>
    </div>
  </nav>

  <!-- Masthead -->
    <?=$content?>

  <!-- Image Showcases -->
  

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>


  
  <?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>