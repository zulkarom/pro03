<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title= 'CONFERENCES';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confmanager/views/myasset');
?>



<div class="card">

            <div class="card-body">
			
			

<div class="table-responsive"><?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'conf_name',
            
            'conf_date:date',
  

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-pencil-alt"></span> Update',['conference/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
                   
                ],
            
            ],

        ],
    ]); ?></div>
	
				</div>
</div>