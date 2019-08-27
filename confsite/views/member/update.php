<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use confsite\models\UploadFile;
/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\ConfPaper */

$this->title = 'Update Paper: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conf Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$model->file_controller = 'member';
?>
<div class="conf-paper-update">

    <h4 class="m-text23 p-b-34">Update Paper</h4>


<div class="conf-paper-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'pap_title')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'pap_abstract')->textarea(['rows' => 6]) ?>
	
	<?=UploadFile::fileInput($model, 'paper')?>
	
	

<br />
    <div class="form-group">
        <?= Html::submitButton('Update Paper Information', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
