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

<div class="card shadow mb-4">

            <div class="card-body"><div class="conference-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php
$userDesc = empty($model->user_id) ? '' : User::findOne($model->user_id)->fullname;
$url = Url::to(['/user/user-list-json']);
echo $form->field($model, 'user_id')->widget(Select2::classname(), [
    'initValueText' => $userDesc, // set the initial display text
    'options' => ['placeholder' => 'Search for a user ...'],
'pluginOptions' => [
    'allowClear' => true,
    'minimumInputLength' => 3,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
]);

 ?>


    <?= $form->field($model, 'conf_name')->textInput(['maxlength' => true]) ?>
	
	<div class="row">
<div class="col-md-4"><?= $form->field($model, 'conf_abbr')->textInput(['maxlength' => true]) ?></div>

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

    <?= $form->field($model, 'conf_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
