<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Upload;
use wbraganca\dynamicform\DynamicFormWidget;

$model->file_controller = 'editing';

$form = ActiveForm::begin(['id' => 'dynamic-form']);  ?>


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Manuscript</h6>
            </div>
            <div class="card-body">
			
<?= $form->field($model, 'title')->textarea(['rows' => 2]) ?>

 
  <?= $form->field($model, 'abstract')->textarea(['rows' => 6]) ?>
  
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
    
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="35%">Fist Name</th>
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
                    <button type="button" class="remove-author btn btn-default btn-sm"><span class="fas fa-trash"></span></button>
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
    
    
    
    <?php DynamicFormWidget::end(); ?>
  
 <?= $form->field($model, 'keyword')->textarea(['rows' => 2]) ?>	
			
			
			</div>
</div>
 
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Camera Ready Form</h6>
            </div>
            <div class="card-body"><div class="row">
<div class="col-md-8">	 



<?=$form->field($model, 'doi_ref') ?>
<div class="row">
<div class="col-md-6"><?=$form->field($model, 'page_from') ?></div>

<div class="col-md-6"><?=$form->field($model, 'page_to') ?>
</div>

</div>


<?=Upload::fileInput($model, 'cameraready')?>
<?=$form->field($model, 'camera_ready_note')->textarea(['rows' => '6']) ?>




	
	</div>

	
	
</div>

	
	

<div class="form-group">

		
	<?=Html::submitButton('Send to Publishing', ['class' => 'btn btn-primary', 'name' => 'wfaction', 'value' => 'recommend', 'data' => [
                'confirm' => 'Are you sure to send this article to journal?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 

?></div>
</div>

