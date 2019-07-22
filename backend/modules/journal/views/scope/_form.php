<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Scope */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scope-form">

    <?php $form = ActiveForm::begin(); ?>

  <div class="card shadow mb-4">

            <div class="card-body">  <?= $form->field($model, 'scope_name')->textInput(['maxlength' => true]) ?></div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
