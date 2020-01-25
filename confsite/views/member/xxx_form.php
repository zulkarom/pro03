<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\ConfPaper */
/* @var $form yii\widgets\ActiveForm */

$model->file_controller = 'member';


?>

<div class="conf-paper-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'pap_title')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'pap_abstract')->textarea(['rows' => 6]) ?>
	
	


    <div class="form-group">
        <?= Html::submitButton('Submit Abstract', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
