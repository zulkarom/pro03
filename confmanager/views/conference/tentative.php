<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

$this->title = 'Update Tentative';

/* @var $this yii\web\View */
/* @var $model backend\modules\project\models\Project */
/* @var $form ActiveForm */

?>

 
<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?=$this->title?></h3>
						</div>
						<div class="panel-body">
<div class="person-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

     <?=$form->field($model, 'updated_at')->hiddenInput(['value' => 1])->label(false)?>


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.day-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-day',
        'deleteButton' => '.remove-day',
        'model' => $days[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
   <div > <table class="table">

        <tbody class="container-items">
        <?php foreach ($days as $indexDay => $day): ?>
            <tr class="day-item">
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $day->isNewRecord) {
                            echo Html::activeHiddenInput($day, "[{$indexDay}]id");
                        }
                    ?>
					
					<div class="row">
<div class="col-md-3">


<?=$form->field($day, "[{$indexDay}]conf_date")->widget(DatePicker::classname(), [
						'removeButton' => false,
						'pluginOptions' => [
							'autoclose'=>true,
							'format' => 'yyyy-mm-dd',
							'todayHighlight' => true,
							
						],
						
						
					]);
					?></div>
					<div class="col-md-4">
					<div class="form-group">&nbsp;</div>
					
					<button type="button" class="remove-day btn btn-default btn-sm"><span class="fa fa-remove"></span> Remove Day</button></div>

</div>
					 

					
					
					
					<?= $this->render('_form-times', [
                        'form' => $form,
                        'indexDay' => $indexDay,
                        'times' => $times[$indexDay],
                    ]) ?>
					
                </td>
      
    
            </tr>
         <?php endforeach; ?>
        </tbody>
	<tfoot>
            <tr>
                <td colspan="2">
                <button type="button" class="add-day btn btn-default btn-sm"><span class="fa fa-plus"></span> Add Day</button>
                
                </td>
             
            </tr>
        </tfoot>
    </table></div>
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save Tentative', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
</div>


<?php

$js = <<<'EOD'

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    $( ".krajee-datepicker" ).each(function() {
       $(this).removeData().kvDatepicker('destroy');
        $(this).kvDatepicker(eval($(this).attr('data-krajee-kvdatepicker')));
  });          
});

jQuery(".dynamicform_inner").on("afterInsert", function(e, item) {

    $( ".krajee-timepicker" ).each(function() {
       $(this).removeData().timepicker('destroy');
        $(this).timepicker(eval($(this).attr('data-krajee-timepicker')));
  });          
});


EOD;

$this->registerJs($js);
?>



