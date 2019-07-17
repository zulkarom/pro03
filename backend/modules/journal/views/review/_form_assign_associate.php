<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\AuthAssignment;
use common\models\Upload;

$model->file_controller = 'review';


$form = ActiveForm::begin(); ?>
 
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Assignment Form</h6>
            </div>
            <div class="card-body">
<div class="box-body"> 

 <?= $form->field($model, 'associate_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-associate-editor'),'user.id', 'user.fullname')
    ) ?>




<div class="form-group">
<?=Upload::fileInput($model, 'review')?>
</div>


</div></div>
</div>

<input type="hidden" name="form-choice" value="btn-approve" />

  <?=$form->field($model, 'asgn_reviewer_at')->hiddenInput(['value' => time()])->label(false)?>
  
 




<div class="form-group">

		
	<?=Html::submitButton('Assign Associate Editor', ['class' => 'btn btn-success', 'name' => 'wfaction', 'value' => 'assign-associate', 'data' => [
                'confirm' => 'Are you sure to assign this associate editor?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 


