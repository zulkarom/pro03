<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scope Cats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-cat-index">

 

    <p>
        <?= Html::a('Create Scope Cat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="card shadow mb-4">

            <div class="card-body">    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cat_name',

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> UPDATE',['/journal/scope-cat/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    }
                ],
            
            ],

        ],
    ]); ?></div>
</div>
</div>
