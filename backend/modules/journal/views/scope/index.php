<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\ScopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scopes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-index">

    <p>
        <?= Html::a('Create Scope', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="card shadow mb-4">

            <div class="card-body"><?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'scope_name',

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> UPDATE',['/journal/scope/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    }
                ],
            
            ],

        ],
    ]); ?></div>
</div>
</div>
