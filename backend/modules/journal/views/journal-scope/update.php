<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\JournalScope */

$this->title = 'Update Journal Scope: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journal Scopes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Header Name</h6>
            </div>
            <div class="card-body"><div class="journal-scope-update">

    <?=$this->render('_small_form', [
        'model' => $model,
    ]) ?>

</div></div>
</div>
