<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\account\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-content">
		<div class="container">
		
		<div class="row">
				<div class="col">
					<h3 class="section_title text-center">Transactions</h3>
				</div>
		</div>
		
<div class="transaction-index">


 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tran_date:date',
            'amount:currency',
			[
				'label' => 'Type',
				'format' => 'html',
				'value' => function($model){
					if($model->receipt){
						return '<span class="btn btn-outline-success">RECEIPT</span>';
					}
					if($model->invoice){
						return '<span class="btn btn-outline-danger">INVOICE</span>';
					}
				}
			
			],
			[
				'format' => 'raw',
				'value' => function($model){
					if($model->receipt){
						return '<a href="'.Url::to(['transaction/receipt', 'id' => $model->receipt->id]) .'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i> DOWNLOAD PDF</a>';
					}
					if($model->invoice){
						return '<a href="'.Url::to(['transaction/invoice', 'id' => $model->invoice->id]) .'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i> DOWNLOAD PDF</a>';
					}
				}
			
			]


           /// ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

		</div>
	</div>
