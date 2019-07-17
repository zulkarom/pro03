<?php
$this->title = 'Publish';
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Todo;
use backend\modules\journal\models\Journal;

/* $jfilter = ArrayHelper::map(Journal::find()->orderBy('id DESC')->all(),'id', 'journalName'); */

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card shadow mb-4">

            <div class="card-body"><?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'journal.journal_abbr',
				'label' => 'Journal'
			]
			,
			[
				'attribute' => 'id',
				'label' => 'M.script No.',
				'value' => function($model){
					return $model->manuscriptNo();
				}
			],
			[
			 'attribute' => 'title',
			 'contentOptions' => [ 'style' => 'width: 60%;' ],
			]
            ,

			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
				
			],

			
			
			
            ['class' => 'yii\grid\ActionColumn',
				 'contentOptions' => ['style' => 'width: 20%'],
				'template' => '{assign} {update}',
				//'visible' => false,
				'buttons'=>[
					'assign'=>function ($url, $model) {
								
					if(Todo::can('journal-managing-editor')){
						return '<a href="'.Url::to(['publish/assign/', 'id' => $model->id]).'" class="btn btn-warning btn-sm"> ASSIGN</a>';
						
					}
							
						
					},
					
					'update'=>function ($url, $model) {
								
					if(Todo::can('journal-managing-editor')){
						return '<a href="'.Url::to(['publish/update/', 'id' => $model->id]).'" class="btn btn-primary btn-sm">UPDATE</a>';
						
					}
							
						
					}
				],
			
			],
        ],
    ]); ?></div>
</div>
