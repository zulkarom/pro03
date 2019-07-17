<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\User;
use kartik\select2\Select2;
use yii\web\JsExpression;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\JuiAsset;
use backend\modules\account\models\Product;


/* @var $this yii\web\View */
/* @var $model backend\modules\account\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow mb-4">

            <div class="card-body"><div class="invoice-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
	
	

    
<div class="row">
<div class="col-md-8">


<?php
$userDesc = empty($model->client_id) ? '' : User::findOne($model->client_id)->fullname;
$url = Url::to(['/user/user-list-json']);
echo $form->field($model, 'client_id')->widget(Select2::classname(), [
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
        'data' => new JsExpression('function(params) { 
			return {
					q:params.term
					
					}; 
			
			}')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
]);

 ?>


</div>

<div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model->statusLabels()) ?>
</div>

</div>
    

   <div class="row">
<div class="col-md-3">

 <?=$form->field($model, 'invoice_date')->widget(DatePicker::classname(), [
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

 <?=$form->field($model, 'due_date')->widget(DatePicker::classname(), [
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


<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.row-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-item',
        'deleteButton' => '.remove-item',
        'model' => $items[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'product_id',
            'description',
            'price',
			'quantity'
        ],
    ]); ?>
    
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%"></th>
                <th>Product<br />Description</th>

                <th width="20%">Price</th>
                <th width="10%">Quantity</th>
				<th width="10%">Total</th>
                <th width="5%">
                    
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($items as $indexItem => $item): ?>
            <tr class="row-item">
                <td class="sortable-handle text-center vcenter" style="cursor: move;">
                        <i class="fas fa-arrows-alt"></i>
                    </td>
            
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $item->isNewRecord) {
                            echo Html::activeHiddenInput($item, "[{$indexItem}]id");
                        }
                    ?>
                    <?= $form->field($item, "[{$indexItem}]product_id")->dropDownList(
        ArrayHelper::map(Product::find()->all(),'id', 'product_name')) 
->label(false) ?>
<?= $form->field($item, "[{$indexItem}]description")->textarea()->label(false) ?>
                </td>

                
				<td class="vcenter">
                    <?= $form->field($item, "[{$indexItem}]price", [
						'addon' => ['prepend' => ['content'=>Yii::$app->formatter->currencyCode]]
					])->label(false) ?>

                </td>
				
				<td class="vcenter">
                    <?= $form->field($item, "[{$indexItem}]quantity")->label(false) ?>
                </td>
				
				<td class="vcenter sub-total" style="font-weight:bold">
					RM<span></span>
                </td>
				
	

                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-item btn btn-default btn-sm"><span class="fas fa-trash"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
        
        <tfoot>
		<tr>
            <td></td>
                <td colspan="3" align="right">
                <strong>Total</strong>
                
                </td>
				<td>
                <strong ><?=Yii::$app->formatter->currencyCode?><span id="grand-total"></span></strong>
                
                </td>
                <td>
                
                
                </td>
            </tr>
            <tr>
            <td></td>
                <td colspan="4">
                <button type="button" class="add-item btn btn-default btn-sm"><span class="fa fa-plus"></span> New Item</button>
                
                </td>
                <td>
                
                
                </td>
            </tr>
        </tfoot>
        
    </table>
    
    
    
    <?php DynamicFormWidget::end(); ?>


    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
	<div class="row">
<div class="col-md-6"><?= Html::submitButton('<i class="fas fa-save"></i> UPDATE INVOICE', ['class' => 'btn btn-success']) ?>
		 <?= Html::a('<i class="fas fa-download"></i> PDF', ['/account/invoice/pdf', 'id' => $model->id], ['class' => 'btn btn-info', 'target' => '_blank']) ?></div>

<div class="col-md-6" align="right">
<?= Html::a('<i class="fas fa-trash"></i> Delete', ['/account/invoice/delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'target' => '_blank', 'data' => [
                'confirm' => 'Are you sure to delete this invoice?'
            ]
]) ?>
</div>

</div>
	
        
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>


<?php

$js = <<<'EOD'

$('input').keyup(function(){
	calc();
});

function calc(){

	$("#grand-total").text(0);
	var rows= $('tr.row-item').length;
	var price = 0;
	var quantity = 0;
	var total = 0;
	var sub = 0;
	for(i=0;i<rows;i++){
		price = parseFloat($("#invoiceitem-" + i + "-price").val());
		quantity = parseFloat($("#invoiceitem-" + i + "-quantity").val());
		if(price && quantity){
			sub = price * quantity;
			$("#invoiceitem-" + i + "-quantity").parent().parent().parent().find('td.sub-total span').text(sub);
			total += sub;
			
		}
		
	}
	
	$("#grand-total").text(total);
	
}

calc();

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    calc();    
		$('input').keyup(function(){
	calc();
});
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e, item) {
    calc();     
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
		calc();
    }
}).disableSelection();

EOD;

JuiAsset::register($this);
$this->registerJs($js);
?>
