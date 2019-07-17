<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\EmailTemplate */

$this->title = 'Update Email Template';
$this->params['breadcrumbs'][] = ['label' => 'Email Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="card shadow mb-4">

            <div class="card-body"><h5>* <?=$model->description?></h5>
<br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?></div>
</div>

