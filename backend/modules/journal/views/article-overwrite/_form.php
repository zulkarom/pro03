<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;
use backend\modules\journal\models\ArticleStatus;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\Scope;
use backend\modules\journal\models\ReviewForm;
use common\models\Upload;
use common\models\AuthAssignment;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\ArticleOverwrite */
/* @var $form yii\widgets\ActiveForm */

$model->file_controller = 'article-overwrite';

?>

<div class="card shadow mb-4">

            <div class="card-body"><div class="article-overwrite-form">

    <?php $form = ActiveForm::begin(); ?>
	
	
	 
	    
		
		<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'status')->dropDownList(ArticleStatus::getAllStatusesArray()) ?></div>

<div class="col-md-6"><?= $form->field($model, 'scope_id')->dropDownList(ArrayHelper::map(Scope::find()->all(), 'id', 'scope_name')) ?>
</div>

</div>
	
	<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'journal_id')->dropDownList(ArrayHelper::map(Journal::find()->all(), 'id', 'journal_abbr')) ?></div>

<div class="col-md-6">

<?php
$userDesc = empty($model->user_id) ? '' : User::findOne($model->user_id)->fullname;
$url = Url::to(['/user/user-list-json']);
echo $form->field($model, 'user_id')->widget(Select2::classname(), [
    'initValueText' => $userDesc, // set the initial display text
    'options' => ['placeholder' => 'Search for a user ...'],
'pluginOptions' => [
    'allowClear' => true,
    'minimumInputLength' => 3,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
]);

 ?>




</div>

</div>

   

    

   

  

    <?= $form->field($model, 'title')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'keyword')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'abstract')->textarea(['rows' => 3]) ?>

<?php 
if($model->id){
	echo Upload::fileInput($model, 'submission');
}
?>

<?php 
if($model->id){
	echo Upload::fileInput($model, 'payment');
}
?>  


    <?= $form->field($model, 'payment_note')->textarea(['rows' => 2]) ?>

 <?= $form->field($model, 'associate_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-associate-editor'),'user.id', 'user.fullname')
    ) ?>
	
	<?php 
if($model->id){
	echo Upload::fileInput($model, 'review');
}
?>


    <?= $form->field($model, 'pre_evaluate_note')->textarea(['rows' => 2]) ?>


    <?= $form->field($model, 'response_note')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'response_option')->dropDownList(ReviewForm::reviewOptions()) ?>


    <?= $form->field($model, 'correction_note')->textarea(['rows' => 2]) ?>

	<?php 
if($model->id){
	echo Upload::fileInput($model, 'correction');
}
?>

 <?= $form->field($model, 'associate_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-assistant-editor'),'user.id', 'user.fullname')
    ) ?>
	

    <?= $form->field($model, 'camera_ready_note')->textarea(['rows' => 2]) ?>
	
		<?php 
if($model->id){
	echo Upload::fileInput($model, 'cameraready');
}
?>

 
<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'withdraw_note')->textarea(['rows' => 2]) ?></div>

<div class="col-md-6"><?= $form->field($model, 'reject_note')->textarea(['rows' => 2]) ?>
</div>

</div>

   


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
