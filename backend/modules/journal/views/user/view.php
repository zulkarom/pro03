<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use backend\modules\journal\models\Scope;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card shadow mb-4">

            <div class="card-body">    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'fullname',
            'email:email',
        ],
    ]) ?></div>
</div>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
<div class="col-md-6"><?php 

$model->user_fields = ArrayHelper::map($model->userScopes ,'id', 'scope_id');

echo $form->field($model, 'user_fields')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Scope::find()->all(),'id', 'scope_name'),
	'bsVersion' => '4.x',
	'theme' => Select2::THEME_KRAJEE_BS4,
    'language' => 'en',
    'options' => ['multiple' => true, 'placeholder' => 'Select a fields ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('User Fields');

?></div>
</div>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'what', 'value' => 'option1', ]) ?>




<?php ActiveForm::end(); ?>
