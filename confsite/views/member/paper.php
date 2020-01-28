<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel confsite\models\ConfPaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Submission List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-paper-index">

    <p>
        <?= Html::a('Submit New Paper', ['create', 'confurl' => $conf->conf_url], ['class' => 'btn btn-success']) ?>
    </p>
	<br />

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['style' => 'width: 7%'],
			],

   [
				'label' => 'Titles',
				'value' => function($model){
					return $model->pap_title;
				}
				
			],
           
			
			[
				'attribute' => 'Status',
				'format' => 'html',
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
						$status = $model->status;
						switch($status){
							case 30:
							case 35:
							 return Html::a('<span class="fa fa-edit"></span> UPDATE ',['member/update/', 'confurl' => $model->conference->conf_url ,'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
							break;
							
							case 40:
							return Html::a('SUBMIT FULL PAPER ',['member/full-paper/', 'confurl' => $model->conference->conf_url ,'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
							break;
							
							case 80:
							return Html::a('ACCEPTANCE LETTER<br /> & INVOICE',['member/invoice-view/', 'confurl' => $model->conference->conf_url ,'id' => $model->id],['class'=>'btn btn-info btn-sm']);
							break;
							
						}
                       
                    }
                ],
            
            ],

        ],
    ]); ?>
</div>
