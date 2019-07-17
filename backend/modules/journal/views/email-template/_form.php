<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\EmailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-template-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php 
	
	$roles = AuthItem::find()
	->where(['type' => 1])
	->andWhere(['like', 'name', 'journal-'])
	->orderBy('description ASC')
	->all();
	
	$data = ArrayHelper::map($roles, 'name', 'description');
	
	$model->target_role = json_decode($model->target_role);

echo $form->field($model, 'target_role')->widget(Select2::classname(), [
    'data' => $data,
    'options' => ['multiple' => true,'placeholder' => 'Select a target...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Targeted Roles');

?>

	
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'notification_subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notification')->textarea(['rows' => 10]) ?>
	

	
<strong>Availabel variable:</strong>
<br /><br />
{manuscript-number} - * also available in email subject<br />
{journal-abbr} - * also available in email subject<br />
{journal-full-name} - e.g. International Journal of Entrepreneurship<br />
{journal-url}<br />
{manuscript-information} <i> - manuscript number, title, abstract & keywords</i><br /> 
{manuscript-information-x} <i>- title, abstract & keywords</i><br /> 
{manuscript-title} {manuscript-abstract} {manuscript-keywords}<br />

{fullname} <i> - recipient  fullname</i><br /> 
{email} <i> - recipient  email</i><br /> 
{pre-evaluation-note} {correction-note} {reject-note} {withdraw-note}<br />
{login-admin-url} {author-fee-amount}<br />
{payment-note} {bank-name} {account-name} {account-number}
<br /><br />


    <div class="form-group">
        <?= Html::submitButton('SAVE TEMPLATE', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
