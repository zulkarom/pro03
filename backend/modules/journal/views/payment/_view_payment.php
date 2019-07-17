<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

?>
 


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
            </div>
            <div class="card-body"><style>
table.detail-view th {
    width:25%;
}
</style>

 <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'payment_note',
			'payment_submit_at:datetime',
			[
				'attribute' => 'payment_file',
				'format' => 'raw',
				'value' => function($model){
					if($model->payment_file){
						return '<a href="'. Url::to(['payment/download', 'attr' => 'payment', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> PAYMENT EVIDENCE</a>';
					}else{
						return 'No File';
					}
					
				}
			],
			

        ],
    ]) ?></div>
</div>

