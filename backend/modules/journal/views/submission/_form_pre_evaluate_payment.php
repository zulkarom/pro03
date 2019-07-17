<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use common\models\AuthAssignment;
use common\models\Upload;
use backend\modules\journal\models\Setting;

$model->file_controller = 'submission';


$form = ActiveForm::begin(); ?>
 
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pre-Evaluate Form</h6>
            </div>
            <div class="card-body">
<div class="box-body"> 






<?=$form->field($model, 'pre_evaluate_note')->textarea(['rows' => '3']) ?>

<div class="row">
<div class="col-md-4"><?php 
$model->pay_amount = Setting::getOne()->pay_amount;
echo $form->field($model, 'pay_amount', [
    'addon' => ['prepend' => ['content'=>'RM']]
]); ?></div>


</div>



</div></div>
</div>

<input type="hidden" name="form-choice" value="btn-approve" />

  <?=$form->field($model, 'asgn_reviewer_at')->hiddenInput(['value' => time()])->label(false)?>
  
 




<div class="form-group">

		
	<?php 
	

		echo Html::submitButton('Accept & Proceed to Payment', ['class' => 'btn btn-success', 'name' => 'wfaction', 'value' => 'accept-manuscript', 'data' => [
                'confirm' => 'Are you sure to accept this manuscript?'
            ],
]);
	
	

?>

    </div>
<?php 

ActiveForm::end(); 


