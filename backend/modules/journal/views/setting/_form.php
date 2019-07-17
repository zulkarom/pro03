<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\Upload;

$model->file_controller = 'setting';

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JebSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow mb-4">

            <div class="card-body"><div class="jeb-setting-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class="row">
<div class="col-md-6"><?= $form->field($model, 'admin_url')->textInput() ?></div>



</div>
	
<?php /* Upload::fileInput($model, 'template')?>	
<?=Upload::fileInput($model, 'template2') */?>	


<div class="row">
<div class="col-md-6"><?= $form->field($model, 'pay_amount', [
    'addon' => ['prepend' => ['content'=>Yii::$app->formatter->currencyCode]]
])->label('Default Author Fee'); ?></div>
<div class="col-md-6">
<?= $form->field($model, 'pay_review', [
    'addon' => ['prepend' => ['content'=>Yii::$app->formatter->currencyCode]]
])->label('Default Review Payment'); ?>
</div>

</div>

<div class="row">
<div class="col-md-6"><?= $form->field($model, 'bank_name')->textInput() ?></div>
</div>
<div class="row">
<div class="col-md-6"><?= $form->field($model, 'account_no')->textInput() ?></div>
</div>
<div class="row">
<div class="col-md-6"><?= $form->field($model, 'account_name')->textInput() ?></div>
</div>


    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
