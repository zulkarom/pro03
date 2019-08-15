<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\JuiAsset;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */

$this->title = 'IMPORTANT DATES: ' . $model->conf_abbr;
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conference-update">

<div class="card">

            <div class="card-body">
<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?=$form->field($model, 'updated_at')->hiddenInput(['value' => time()])->label(false)?>

<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.date-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-date',
        'deleteButton' => '.remove-date',
        'model' => $dates[0],
        'formId' => 'dynamic-form',
        'formFields' => [
			'id',
            'date_name',
			'date_start'
        ],
    ]); ?>

    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%"></th>
                <th>Date Label</th>
                <th width="25%">Date</th>
                <th class="text-center" style="width: 90px;">
                    
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($dates as $i => $date): ?>
            <tr class="date-item">
                <td class="sortable-handle text-center vcenter" style="cursor: move;">
                        <i class="fas fa-arrows-alt"></i>
                    </td>
            
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $date->isNewRecord) {
                            echo Html::activeHiddenInput($date, "[{$i}]id");
                        }
                    ?>
                    <?= $form->field($date, "[{$i}]date_name")->label(false) ?>
                </td>
                
                <td class="vcenter">
          
                    
                     <?=$form->field($date, "[{$i}]date_start")->widget(DatePicker::classname(), [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            
                        ],
                        
                        
                    ])->label(false);

                    ?>

                </td>

                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-date btn btn-default btn-sm"><span class="fa fa-remove"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
        
        <tfoot>
            <tr>
            <td></td>
                <td colspan="2">
                <button type="button" class="add-date btn btn-default btn-sm"><span class="fa fa-plus"></span> New Dates</button>
                
                </td>
                <td>
                
                
                </td>
            </tr>
        </tfoot>
        
    </table>
    <?php DynamicFormWidget::end(); ?>
	
    <br />
    <div class="form-group">
        <?= Html::submitButton('Save Dates', ['class' => 'btn btn-primary']) ?>
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

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".container-items").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.6,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();

EOD;

JuiAsset::register($this);
$this->registerJs($js);
?>

