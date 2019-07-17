<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\account\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="invoice-index">



    <p>
        <?= Html::a('Create Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoice_date:date',
			[
				'attribute' => 'client_id',
				'label' => 'Client', 
				'value' => function($model){
					return $model->client->fullname;
				}
			]
			,
			
			[
				'label' => 'Amount', 
				'format' => 'currency',
				'value' => function($model){
					return $model->invoiceAmount;
				}
			]
            ,
			
			[
				'label' => 'Status', 
				'format' => 'html',
				'value' => function($model){
					return $model->statusButton;
				}
			],

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fas fa-edit"></span> Edit',['invoice/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
				
                ],
            
            ]
        ],
    ]); ?>
</div></div>
</div>
