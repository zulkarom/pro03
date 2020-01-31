<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title= 'CONFERENCES';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confsite/views/myasset');
?>



<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"></h3>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
			
			

<div class="table-responsive"><?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'conf_name',
            
            'date_start:date',
  

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-pencil-alt"></span> Update',['conference/update/', 'conf' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
                   
                ],
            
            ],

        ],
    ]); ?></div>
	
				</div>
</div>