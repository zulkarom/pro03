<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\AuthAssignment;

$form = ActiveForm::begin(); ?>
 

<input type="hidden" name="form-choice" value="btn-approve" />


<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Assistant Editor Assignment</h6>
</div>
            <div class="card-body"><div class="row">
<div class="col-md-6"><?=$form->field($model, 'assistant_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-assistant-editor'),'user_id', 'user.fullname')
    ) 
 ?></div>

</div></div>
</div>


  <?=$form->field($model, 'post_evaluate_at')->hiddenInput(['value' => time()])->label(false)?>
  
 
<div class="form-group">

		
	<?=Html::submitButton('Accept Manuscript and Send to Camera Ready', ['class' => 'btn btn-success', 'name' => 'wfaction', 'value' => 'send-galley', 'data' => [
                'confirm' => 'Are you sure to send this manuscript to camera ready?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 


