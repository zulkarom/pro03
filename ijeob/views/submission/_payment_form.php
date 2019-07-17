<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\ReviewForm;
use backend\modules\journal\models\Setting;
use common\models\Upload;
use wbraganca\dynamicform\DynamicFormWidget;

$model->file_controller = 'submission';

$form = ActiveForm::begin(['id' => 'dynamic-form']); 
$setting = Setting::getOne();
?>
<br />

<h3>Payment Instruction</h3>

<div class="box-body"> 

Kindly transfer the amount to:<br /><br />
<p>
<i>Bank Name:</i> &nbsp;&nbsp; <?=$setting->bank_name?><br />
<i>Account Number:</i> &nbsp;&nbsp;<?=$setting->account_no?><br />
<i>Account Name:</i> &nbsp;&nbsp;<?=$setting->account_name?><br />
</p>


</div>

 
<br />

<p>After the payment kindly put your payment details below e.g. Bank Name, Amount, Payment Time, Reference etc.</p>
<br />
<div class="box-body"> 

 

	<?=$form->field($model, 'payment_note')->textarea(['rows' => '6'])->label('Payment Info') ?>
	

<?=Upload::fileInput($model, 'payment')?>

  <?=$form->field($model, 'payment_submit_at')->hiddenInput(['value' => time()])->label(false)?>
  






<div class="form-group">

		
	<?=Html::submitButton('Submit Payment', ['class' => 'btn btn-primary', 'name' => 'wfaction', 'value' => 'recommend', 'data' => [
                'confirm' => 'Are you sure to submit this payment  information?'
            ],
])?>

    </div>
<?php 

ActiveForm::end(); 

?>



