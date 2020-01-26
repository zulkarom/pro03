<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel confmanager\models\ConfPaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Overwrite Papers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

            <div class="card-body"><div class="conf-paper-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'fullname',
				'label' => 'Name',
				'value' => function($model){
					return $model->user->fullname;
				}
				
			],
            'pap_title:ntext',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function($model){
					return $model->paperStatus;
				}
				
			],
			

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
						return Html::a('UPDATE',['paper/overwrite-form/', 'conf' => $model->conf_id, 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                        
                    }
                ],
            
            ],

        ],
    ]); ?>
</div></div>
</div>
