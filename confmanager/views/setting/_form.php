<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;
use common\models\Country;
use common\models\UploadFile;
use dosamigos\tinymce\TinyMce;


$model->file_controller = 'setting';

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?=$model->conf_name?></h3>
							<p class="panel-subtitle"><a href="https://site.confvalley.com/<?=$model->conf_url?>"  target="_blank">https://site.confvalley.com/<?=$model->conf_url?></a></p>
						</div>
						<div class="panel-body">
			
			
			
			<div class="conference-form">
			


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
    
    
])->label('Date Start');
?>
</div>

<div class="col-md-4"> <?=$form->field($model, 'date_end')->widget(DatePicker::classname(), [
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
	


<!-- for image -->
<?=UploadFile::fileInput($model, 'banner', true)?>
<i>Dimensions (px) : 1349 x 316 </i>
<br /><br />
<div class="row">
<div class="col-md-3">
<?php 
if(empty($model->currency_int)){
	$model->currency_int = 'USD';
}
$arr_curr = ArrayHelper::map(Country::find()->all(), 'currency_code', 'currency_code');
echo $form->field($model, 'currency_int')->widget(Select2::classname(), [
    'data' => $arr_curr,
    'language' => 'en',
    'options' => ['multiple' =>false,'placeholder' => 'Select...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?>

</div>
<div class="col-md-3"><?php echo $form->field($model, 'currency_local')->widget(Select2::classname(), [
    'data' => $arr_curr,
    'language' => 'en',
    'options' => ['multiple' =>false,'placeholder' => 'Select...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?></div>



</div>
<br />
Invoice / Receipt Information
<hr />

<?=UploadFile::fileInput($model, 'logo', true)?>

<?= $form->field($model, 'conf_address')->textarea(['rows' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save Setting', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
