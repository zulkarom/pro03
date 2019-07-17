<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\account\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-content">
		<div class="container">
		
		<div class="row">
				<div class="col">
					<h3 class="section_title text-center">INVOICES</h3>
				</div>
		</div>
		
		
<div class="invoice-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'id', 
				'label' => 'Invoice No'
			]
			,
            'invoice_date:date'

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
                        return Html::a('<span class="fa fa-search"></span> View',['invoice/pdf/', 'id' => $model->id],['target'=>'_blank','class'=>'btn btn-warning btn-sm']);
                    },
				
                ],
            
            ]
        ],
    ]); ?>
</div>
</div>
	</div>