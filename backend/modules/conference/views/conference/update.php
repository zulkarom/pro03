<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\Conference */

$this->title = 'Update Conference: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conference-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
