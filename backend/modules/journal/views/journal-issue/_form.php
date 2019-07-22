<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\Journal;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow mb-4">

            <div class="card-body"><?php $form = ActiveForm::begin(); ?>

		<div class="row">
	<div class="col-md-9"><?= $form->field($model, 'journal_id')->dropDownList(ArrayHelper::map(Journal::find()->all(), 'id', 'journalName'))->label('Journal') ?></div>
</div>

		<div class="row">
		<div class="col-md-3"><?= $form->field($model, 'issue_month')->dropDownList($model->monthList) ?></div>
<div class="col-md-3"><?= $form->field($model, 'issue_year')->textInput() ?></div>
<div class="col-md-3"><?= $form->field($model, 'volume')->textInput() ?></div>
<div class="col-md-3"><?= $form->field($model, 'issue')->textInput() ?></div>
</div>
	
	<div class="row">
<div class="col-md-3">



 <?php 

if($model->submit_start == '0000-00-00'){
	$model->submit_start = date('Y-m-d');
}
 
 echo $form->field($model, 'submit_start')->widget(DatePicker::classname(), [
    'removeButton' => false,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        
    ],
    
    
]);
?>



</div>

<div class="col-md-3">



 <?php 

if($model->submit_end == '0000-00-00'){
	$model->submit_end = date('Y-m-d');
}
 
 echo $form->field($model, 'submit_end')->widget(DatePicker::classname(), [
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

    
<div class="row">
<div class="col-md-3"><?php 
if(!$model->id){
	$model->status = 0;
}
echo $form->field($model, 'status')->dropDownList(
        $model->journalStatus(), ['prompt' => 'Please Select' ]
    )
 ?>
 

 
 </div>
 <div class="col-md-3">
  <?php 

if($model->publish_date == '0000-00-00'){
	$model->publish_date = date('Y-m-d');
}
 
 echo $form->field($model, 'publish_date')->widget(DatePicker::classname(), [
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

<div class="row">
<div class="col-md-7">  <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?></div>


</div>


    <div class="form-group">
        <?php 
		
		if($model->id){
			$btn = 'Update Journal Issue';
		}else{
			$btn = 'Create Journal Issue';
		}
		
		echo Html::submitButton($btn, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?></div>
</div>
