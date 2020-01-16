<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

?>
 


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pre-Evaluation Note</h6>
            </div>
            <div class="card-body"><style>
table.detail-view th {
    width:25%;
}
</style>

 <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			[
				'attribute' => 'pre_evaluate_by',
				'value' => function($model){
					if($model->preEvaluateBy){
						return $model->preEvaluateBy->fullname;
					}
					
				}
			],
			'pre_evaluate_note',
			[
				'attribute' => 'review_file',
				'format' => 'raw',
				'value' => function($model){
					if($model->review_file){
						return '<a href="'. Url::to(['submission/download', 'attr' => 'review', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> REVIEW FILE</a>';
					}else{
						return 'No File';
					}
					
				}
			],
			

        ],
    ]) ?></div>
</div>
