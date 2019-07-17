<?php
$this->title = 'Submission List';
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Todo;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;



?>


<div class="card shadow mb-4">
          
            <div class="card-body"><div class="article-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'journal.journal_abbr',
				'label' => 'Journal'
			],
			[
				'attribute' => 'id',
				'label' => 'M.script No.',
				'value' => function($model){
					return $model->manuscriptNo();
				}
			]
			,
			
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
				 'contentOptions' => ['style' => 'width: 8.7%'],
				'template' => '{view}',
				
				//'visible' => false,
				'buttons'=>[
					'view'=>function ($url, $model) {
						if(Todo::can('journal-managing-editor')){
							$color = $model->getWorkflowStatus()->getMetadata('color');
						return '<a href="'.Url::to(['submission/pre-evaluate', 'id' => $model->id]).'" class="btn btn-'.$color.' btn-sm" ><span class="fas fa-pencil-alt"></span> PRE-EVALUATE</a>';
						}
						
						
						
					}
				],
			
			],
        ],
    ]); ?>
</div></div>
</div>

