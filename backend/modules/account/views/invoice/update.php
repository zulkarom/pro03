<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\account\models\Invoice */

$this->title = 'Update: INV' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-update">

    <?= $this->render('_form', [
        'model' => $model,
		'items' => $items
    ]) ?>

</div>
