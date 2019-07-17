<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JournalScope */

$this->title = 'Update Journal Scope: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journal Scopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-scope-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
