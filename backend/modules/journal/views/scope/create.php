<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Scope */

$this->title = 'Create Scope';
$this->params['breadcrumbs'][] = ['label' => 'Scopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
