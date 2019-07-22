<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Scope */

$this->title = 'Update Scope: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Scopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scope-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
