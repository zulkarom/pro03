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
        <div class="page-content--bge5">
            <div class="container">
					
<?=$content?>

</div>
</div>
</div>

	



<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>