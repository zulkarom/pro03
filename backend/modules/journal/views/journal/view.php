<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = $model->journal_abbr;
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="journal-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'journal_name',
			'journal_name2',
            'journal_abbr',
			'journal_issn',
			'journal_doi',
            'journal_url:url',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
</div>
</div>