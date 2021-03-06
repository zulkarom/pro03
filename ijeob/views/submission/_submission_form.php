<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use backend\modules\journal\models\ArticleScope;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

<div class="row">
<div class="col-md-1"></div>

<div class="col-md-10">
 <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

	
	<?= $form->field($model, 'title', ['template' => '
            {label}:<br /><i style="font-size:12px">Capitalize First Letter for Each Word</i>
			{input}
			{error}
           '])->textarea(['rows' => 2])  ?>

	 
	
	<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.author-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-author',
        'deleteButton' => '.remove-author',
        'model' => $authors[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'firstname',
            'lastname',
			'email'
        ],
    ]); ?>
    
    <div class="form-group">
	<label>Authors</label><span style="color:red"> * </span>
    <table class="table">
        <thead>
            <tr>
                <th width="35%">First Name</th>
                <th width="35%">Last Name</th>
				<th width="35%">Email</th>
                <th class="text-center" style="width: 90px;">
                    
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($authors as $indexAu => $author): ?>
            <tr class="author-item">
            
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $author->isNewRecord) {
                            echo Html::activeHiddenInput($author, "[{$indexAu}]id");
                        }
                    ?>
                    <?= $form->field($author, "[{$indexAu}]firstname")->label(false) ?>
                </td>
                
                <td class="vcenter">
          
                    
                     <?=$form->field($author, "[{$indexAu}]lastname")->label(false);

                    ?>

                </td>
				
				<td class="vcenter">
          
                    
                     <?=$form->field($author, "[{$indexAu}]email")->label(false);

                    ?>

                </td>
                
                


                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-author btn btn-default btn-sm"><span class="fa fa-remove"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
        
        <tfoot>
            <tr>
                <td colspan="3">
                <button type="button" class="add-author btn btn-default btn-sm"><span class="fa fa-plus"></span> Add Author</button>
                
                </td>
                <td>
                
                
                </td>
            </tr>
        </tfoot>
        
    </table>
    </div>
    
    
    <?php DynamicFormWidget::end(); ?>


 

    <?= $form->field($model, 'abstract')->textarea(['rows' => 6]) ?>
 
 <?= $form->field($model, 'keyword', ['template' => '
            {label}:<br /><i style="font-size:12px">Capitalize Each Word & Separated by Comma, e.g. Performance, Determinants, Banks, Profitability</i>
			{input}
			{error}
           '])->textarea(['rows' => 2])  ?>
    

   
<br />
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-save"></i> SAVE AS DRAFT', ['class' => 'btn btn-default', 'name' => 'wfaction' , 'value' => 'btn-draft']) ?>
         <?= Html::submitButton('NEXT <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-warning', 'name' => 'wfaction' , 'value' => 'btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>

   

</div>
