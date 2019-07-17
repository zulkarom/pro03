<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = 'Publication Ethics';
$this->params['breadcrumbs'][] = ['label' => 'Journal List', 'url' => ['/journal/journal/index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-update">


<div class="card shadow mb-4">

<div class="card-body">

<div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>
	
	

<?= $form->field($model, 'publication_ethics')->widget(TinyMce::className(), [
    'options' => ['rows' => 20],
    'language' => 'en',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
	
	

    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

</div>
