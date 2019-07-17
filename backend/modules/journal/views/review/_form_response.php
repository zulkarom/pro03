<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\ReviewForm;

$form = ActiveForm::begin(); ?>
 

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Response to Author Form</h6>
            </div>
            <div class="card-body"><?=$form->field($model, 'response_note')->textarea(['rows' => '6']) ?>
			
<h5><b>Recommended disposition of the manuscript: check one.</b></h5>

<?php 
$options = ReviewForm::reviewOptions();
unset($options[0]);
echo $form->field($model, 'response_option')->radioList($options, ['encode' => false, 'separator' => '<br />']) ->label(false) ?>


  <?=$form->field($model, 'response_at')->hiddenInput(['value' => time()])->label(false)?>
  


<div class="form-group">


<?=Html::submitButton('Send to Author', ['class' => 'btn btn-success', 'name' => 'wfaction', 'value' => 'correction', 'data' => [
                'confirm' => 'Are you sure to send the response to author?'
            ],
])?>  
	



    </div>
<?php 

ActiveForm::end(); 

?></div>
</div>

