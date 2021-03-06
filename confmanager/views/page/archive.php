<?php

use yii\helpers\Url;
use yii\grid\GridView;
 
$this->title = 'ARCHIVE';

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@confsite/views/myasset');
?>


<div class="block-content">
		<div class="container">
		
		<div class="row">
				<div class="col">
					<h3 class="section_title text-center">ARCHIVES</h3>
				</div>
		</div>
		
			<div class="row">
			
			<div class="col-lg-12">
			
			  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'issue_name',
				'label' => 'Archived Journals'
			]
            ,
            'volume',
            'issue',

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{view}',
                //'visible' => false,
                'buttons'=>[
                    'view'=>function ($url, $model) {

                        return '<a href="'.Url::to(['page/journal/', 'id' => $model->id]).'" class="btn btn-info btn-sm"><span class="fa fa-book"></span> VIEW</a>';
                    }
                ],
            
            ],

        ],
    ]); ?>
			
			
			</div>
				
				
			
			</div>
			<br />

	
			
			
		</div>
	</div>