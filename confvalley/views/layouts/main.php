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
 <?=$content?>
  <?php $this->endBody() ?>
</body>

</html>


<?php $this->endPage() ?>