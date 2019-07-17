<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Todo;
use backend\modules\journal\models\Journal;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\staff\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Journal Issues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New Issue', ['create'], ['class' => 'btn btn-success']) ?>
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
				'label' => 'Journal',
				'filter' => Html::activeDropDownList($searchModel, 'journal_id', 		ArrayHelper::map(Journal::find()->all(), 'id', 'journal_abbr'),['class'=> 'form-control','prompt' => 'Choose Journal']),
				'value' => function($model){
					return $model->journal->journal_abbr;
				}
			],
			[
				'attribute' => 'issue_month',
				'label' => 'Month',
				'filter' => Html::activeDropDownList($searchModel, 'issue_month', 		$searchModel->monthList,['class'=> 'form-control','prompt' => 'Choose Month']),
				'contentOptions' => [ 'style' => 'width: 15%;' ],
			],
			[
				'attribute' => 'issue_year',
				'label' => 'Year',
				'contentOptions' => [ 'style' => 'width: 10%;' ],
			]
			,
			[
				'attribute' => 'volume',
				'label' => 'Vol.',
				'contentOptions' => [ 'style' => 'width: 8%;' ],
			]
            ,
			[
				'attribute' => 'issue',
				'label' => 'Iss.',
				'contentOptions' => [ 'style' => 'width: 8%;' ],
			]
           ,
			[
				'attribute' => 'status',
				'format' => 'html',
				'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->journalStatus(),['class'=> 'form-control','prompt' => 'Choose Status']),
				'value' => function($model){
					return $model->statusLabel();
				}
			]
            ,

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 18%'],
                'template' => '{article} {view}',
                //'visible' => false,
                'buttons'=>[
					'article' => function($url, $model){
						return Html::a('ARTICLES', ['journal-issue/article', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']);
					},
                    'view'=>function ($url, $model) {
						if(Todo::can('journal-managing-editor')){
							return '<a href="'.Url::to(['journal-issue/update/', 'id' => $model->id]).'" class="btn btn-primary btn-sm">UPDATE</a>';
						}
                        
                    }
                ],
            
            ],

        ],
    ]); ?></div>
</div>



</div>
