<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = 'Update Journal';
$this->params['breadcrumbs'][] = ['label' => 'Journal List', 'url' => ['/journal/journal/index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
