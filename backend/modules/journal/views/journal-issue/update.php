<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = 'Volume ' . $model->volume . ' Issue ' . $model->issue;
$this->params['breadcrumbs'][] = ['label' => 'Journal Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
