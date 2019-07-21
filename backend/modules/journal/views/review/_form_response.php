<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\ReviewForm;
use backend\modules\journal\models\EmailTemplate;

$form = ActiveForm::begin(); ?>
 

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Response to Author Form</h6>
            </div>
            <div class="card-body">
			
<h5><b>Recommended disposition of the manuscript: check one.</b></h5>

<?php 
$options = ReviewForm::reviewOptions();
unset($options[0]);
echo $form->field($model, 'response_option')->radioList($options, ['encode' => false, 'separator' => '<br />']) ->label(false) ?>

<div class="row">
<div class="col-md-6">
<h5>Email Structure</h5>
e.g. for correction
<br /><br />
<p style="border:1px #000 dashed;padding:10px">
<?=nl2br(EmailTemplate::findOne(7)->notification)?>
</p>
</div>

<div class="col-md-6">
e.g. for response note to be filled in below.
<br /><br />
<p style="border:1px #000 dashed;padding:10px">
This is to inform you that after careful consideration, the editorial team has decided to consider for publication should you be prepared to incorporate Minor revisions. When preparing your revised manuscript, you are asked to carefully consider the reviewer comments and submit a list of responses to the comments.
<br /><br />
Please send the amended version of your paper by 01 Jan 2020 to consider for IJEOB June 2019 Issue.
</p>
</div>

</div>

<?=$form->field($model, 'response_note')->textarea(['rows' => '6']) ?>

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

