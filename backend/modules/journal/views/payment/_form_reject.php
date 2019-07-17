<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
 
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Reject Form</h6>
            </div>
            <div class="card-body"><?=$form->field($model, 'reject_note')->textarea(['rows' => '3']) ?></div>
</div>


<input type="hidden" name="form-choice" value="btn-approve" />

  <?=$form->field($model, 'reject_at')->hiddenInput(['value' => time()])->label(false)?>
  
 
<div class="form-group">

		
	<?=Html::submitButton('Reject Manuscript', ['class' => 'btn btn-danger', 'name' => 'wfaction', 'value' => 'reject', 'data' => [
                'confirm' => 'Are you sure to reject this manuscript?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 


