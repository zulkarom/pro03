<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\JournalScopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scopes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-scope-index">


   

<div class="card shadow mb-4">

            <div class="card-body">    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			'scopeCat.cat_name',
            'scope.scope_name',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?></div>
</div>
</div>
