<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Upload;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = 'Template Article';
$this->params['breadcrumbs'][] = ['label' => 'Journal List', 'url' => ['/journal/journal/index']];
$this->params['breadcrumbs'][] = 'Template';
$model->file_controller = 'journal-update';
?>
<div class="journal-update">


<div class="card shadow mb-4">

            <div class="card-body"><div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>
	

	<?=Upload::fileInput($model, 'template')?>	
<?=Upload::fileInput($model, 'template2') ?>	
	

    


    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Save Template', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

</div>
