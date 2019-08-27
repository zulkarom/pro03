<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\ConfPaper */

$this->title = 'Submit New Paper';
$this->params['breadcrumbs'][] = ['label' => 'Conf Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-paper-create">

<h4 class="m-text23 p-b-34">Submit New Paper</h4>

<div class="conf-paper-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'pap_title')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'pap_abstract')->textarea(['rows' => 6]) ?>
	
	


    <div class="form-group">
        <?= Html::submitButton('Submit Abstract', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
