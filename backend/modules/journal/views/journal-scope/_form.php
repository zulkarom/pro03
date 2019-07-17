<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JournalScope */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-scope-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'journal_id')->textInput() ?>

    <?= $form->field($model, 'scope_id')->textInput() ?>

    <?= $form->field($model, 'scope_cat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
