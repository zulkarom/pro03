<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel confmanager\models\ConfPaperSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Papers\' Overview';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?=$this->title?></h3>
						</div>
						<div class="panel-body">

<div class="conf-paper-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'pap_title:ntext',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function($model){
					return ucfirst(strtolower($model->paperStatus));
				}
				
			],
			[
				'attribute' => 'created_at',
				'label' => 'Date',
				'format' => 'date'
			],
			
            [
				'label' => 'Participant',
				'value' => function($model){
					return $model->user->fullname;
				}
				
			],
			[
				'attribute' => 'paper_file',
				'label' => 'Full Paper',
				'format' => 'raw',
				'value' => function($model){
					if($model->paper_file){
						return Html::a('Full Paper', ['paper/download-file', 'id' => $model->id, 'attr' => 'paper'], ['target' => '_blank']);
					}else{
						return 'NULL';
					}
					
				}
			],
			[
				'label' => 'Role',
				'value' => function($model){
					if($model->authorRole){
						return $model->authorRole->fee_name;
					}
					
				}
				
			],
			[
				'label' => 'Invoice',
				'format' => 'raw',
				'value' => function($model){
					if($model->payment_file){
						return '<a href="'.Url::to(['paper/invoice-pdf', 'id' => $model->id]).'" target="_blank"><span class="label label-danger">Invoice</span></a>';
					}else{
						return 'Issue Now';
					}
					
				}
				
			],
			[
				'label' => 'Amount',
				'value' => function($model){
					return $model->invoice_currency . ' ' . number_format($model->invoice_amount, 2);
					
				}
				
			],
			[
				'label' => 'Payment',
				'value' => function($model){
					if($model->receipt_ts == 0){
						return 'NO';
					}else{
						return 'YES';
					}
					
				}
				
			],
			[
				'label' => 'Attending',
				'value' => function($model){
					return '';
				}
				
			],
			
			

        ],
    ]); ?>
</div></div>
</div>
