<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JournalScope */

$this->title = 'Create Journal Scope';
$this->params['breadcrumbs'][] = ['label' => 'Journal Scopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-scope-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
