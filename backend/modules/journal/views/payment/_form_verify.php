<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
 

<input type="hidden" name="form-choice" value="btn-approve" />

  <?=$form->field($model, 'reject_at')->hiddenInput(['value' => time()])->label(false)?>
  
 
<div class="form-group">

<?=Html::submitButton('Approve Payment', ['class' => 'btn btn-success', 'name' => 'wfaction', 'value' => 'verify', 'data' => [
                'confirm' => 'Are you sure to approve this payment?'
            ],
])?>  
		
	<?=Html::submitButton('Revert to Payment Pending', ['class' => 'btn btn-danger', 'name' => 'wfaction', 'value' => 'reject', 'data' => [
                'confirm' => 'Are you sure to revert the payment to pending?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 


