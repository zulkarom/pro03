<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\ScopeCat */

$this->title = 'Create Scope Cat';
$this->params['breadcrumbs'][] = ['label' => 'Scope Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-cat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
