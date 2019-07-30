<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = 'Submission Guideline';
$this->params['breadcrumbs'][] = ['label' => 'Journal List', 'url' => ['/journal/journal/index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-update">


<div class="card shadow mb-4">

            <div class="card-body"><div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>
	
	

<?= $form->field($model, 'submission_guideline')->widget(TinyMce::className(), [
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
	
	
<p>Template(EN) Link: <?=$model->journal_url?>/page/template-en</p>
<p>Template(BM) Link: <?=$model->journal_url?>/page/template-bm</p>  


    <div class="form-group">
        <?= Html::submitButton('Save Submission Info', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

</div>
