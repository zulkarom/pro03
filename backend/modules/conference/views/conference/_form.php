<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'conf_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conf_abbr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conf_date')->textInput() ?>

    <?= $form->field($model, 'conf_venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conf_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
