<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel confmanager\models\ConfPaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Submitted Papers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="conf-paper-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'pap_title:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div>
</div>
