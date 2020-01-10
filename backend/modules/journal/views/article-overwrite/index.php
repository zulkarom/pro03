<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\ArticleOverwriteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Overwrites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-overwrite-index">
    <p>
        <?= Html::a('New Manuscript', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="card shadow mb-4">

            <div class="card-body"><?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            [
				'attribute' => 'journal_id',
				'contentOptions' => ['style' => 'width:15%'],
				'value' => function($model){
					if($model->journal){
						return $model->journal->journal_abbr;
					}
					
				}
			]
			,
            'title:ntext',
			[
				'label' => 'Status',
				'format' => 'raw',
				'contentOptions' => ['style' => 'width:15%'],
				'value' => function($model){
					return $model->getWfLabel();
				}
			
			],

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-edit"></span> Update',['article-overwrite/update/', 'id' => $model->id],['class'=>'btn btn-warning']);
                    },
                ],
            
            ],

        ],
    ]); ?></div>
</div>
</div>
