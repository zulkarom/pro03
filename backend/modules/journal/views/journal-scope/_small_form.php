<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\journal\models\Scope;
use backend\modules\journal\models\ScopeCat;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JournalScope */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-scope-form">

<?php $form = ActiveForm::begin(); ?>
 
 <div class="row">
<div class="col-md-4">
<?= $form->field($model, 'scope_cat')->dropDownList(ArrayHelper::map(ScopeCat::find()->all(),'id', 'cat_name'), ['prompt' => 'Please Category' ])->label(false) ?>
</div>

<div class="col-md-6">  
 <?= $form->field($model, 'scope_id')->dropDownList(ArrayHelper::map(Scope::find()->all(),'id', 'scope_name'), ['prompt' => 'Please Scope' ])->label(false)?>
</div>

<div class="col-md-2"><div class="form-group">
        <?php 
		
		if($model->id){
			$text='Update Scope';
		}else{
			$text='Add Scope';
		}
		
		echo Html::submitButton('<i class="fas fa-plus"></i> '.$text, ['class' => 'btn btn-primary btn-sm']) 
		
		?>
    </div></div>

</div>

    

    <?php ActiveForm::end(); ?>

</div>
