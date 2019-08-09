<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">

            <div class="card-body"><div class="conference-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'conf_name')->textInput(['maxlength' => true]) ?>
	
	<div class="row">
<div class="col-md-4"><?= $form->field($model, 'conf_abbr')->textInput(['maxlength' => true])->label('Abbreviation') ?></div>

<div class="col-md-4"> <?=$form->field($model, 'date_start')->widget(DatePicker::classname(), [
    'removeButton' => false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        
    ],
    
    
]);
?>
</div>

</div>

    
    <?= $form->field($model, 'conf_venue')->textInput(['maxlength' => true]) ?>
	
<?= $form->field($model, 'conf_background')->textarea(['rows' => 5])->label('Background') ?>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
