<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\models\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
    
backend\assets\TmplAsset::register($this);
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@backend/views/assets/');
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

<meta charset="<?= Yii::$app->charset ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?= Html::csrfMetaTags() ?>

<title>EDUSAGE::<?= Html::encode($this->title) ?></title>

<?php $this->head() ?>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
</head>
<body id="page-top">
<?php $this->beginBody() ?>

<!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?= $this->render(
            'menu.php'
        ) ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?= $this->render(
            'top.php'
        ) ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
		
		

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($this->title) ?></h1>

<div class="content-bread">
<?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
</div>


          </div>
<?= Alert::widget() ?>
          <?=$content?>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; EduSage 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		  <?= Html::a(
                                    'Logout',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-primary']
                                ) ?>

        </div>
      </div>
    </div>
  </div>

 

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
