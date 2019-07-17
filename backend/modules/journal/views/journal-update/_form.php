<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow mb-4">

            <div class="card-body"><div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'journal_name')->textInput(['maxlength' => true])->label('Journal Name (Line 1)') ?>
	
	

	<?= $form->field($model, 'journal_name2')->textInput(['maxlength' => true])->label('Journal Name (Line 2)') ?>
	
		<div class="row">
<div class="col-md-6"><?= $form->field($model, 'journal_abbr')->textInput(['maxlength' => true]) ?></div>

<div class="col-md-6"><?= $form->field($model, 'journal_url')->textInput(['maxlength' => true]) ?>
</div>

</div>

		<div class="row">
<div class="col-md-6"><?= $form->field($model, 'journal_address')->textarea(['rows' => 6]) ?></div>

<div class="col-md-6">

<?= $form->field($model, 'journal_email')->textInput(['maxlength' => true]) ?>


<div class="row">
<div class="col-md-6"><?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?></div>

<div class="col-md-6"><?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>
</div>

</div>



</div>

</div>


		<div class="row">
<div class="col-md-6"><?= $form->field($model, 'journal_issn')->textInput(['maxlength' => true]) ?></div>

<div class="col-md-6"><?= $form->field($model, 'journal_doi')->textInput(['maxlength' => true]) ?>
</div>

</div>

    

    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>