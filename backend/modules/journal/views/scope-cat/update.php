<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\ScopeCat */

$this->title = 'Update: ';
$this->params['breadcrumbs'][] = ['label' => 'Scope Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scope-cat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
