<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Update Users (Author/Reviewer)';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>


<div class="card shadow mb-4">

            <div class="card-body"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?> * as updating username & password will be reset to email<br /><br />
<?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
<?= $form->field($assoc, 'institution')->textInput(['maxlength' => true]) ?>

<?= $form->field($assoc, 'country_id')->dropDownList(ArrayHelper::map(Country::find()->all(),'id', 'country_name'), ['prompt' => 'Please Select' ])  ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>
</div>


<?php ActiveForm::end(); ?>
	
	