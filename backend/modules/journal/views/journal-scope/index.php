<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\JournalScopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scopes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-scope-index">

 <?= $this->render('_small_form', [
        'model' => $model
    ]) ?>

   

<div class="card shadow mb-4">

            <div class="card-body">    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			'scopeCat.cat_name',
            'scope.scope_name',
            

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update} {delete}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-edit"></span>',['/journal/journal-scope/update/', 'id' => $model->journal_id, 'scope' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
                    'delete'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-trash"></span>', ['/journal/journal-scope/delete', 'id' => $model->journal_id, 'scope' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this scope?',
                'method' => 'post',
            ],
        ]) 
;
                    }
                ],
            
            ],


        ],
    ]); ?></div>
</div>
</div>
