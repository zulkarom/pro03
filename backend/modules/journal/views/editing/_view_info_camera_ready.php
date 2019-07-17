<?php

use yii\helpers\Url;
use yii\widgets\DetailView;


?>


<div class="card shadow mb-4">

            <div class="card-body"><style>
table.detail-view th {
    width:15%;
}
</style>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute' => 'id',
				'label' => 'Manuscript No.',
				'value' => function($model){
					return $model->manuscriptNo();
				}
			],
			'title:ntext',
			[
				'label' => 'Authors',
				'format' => 'html',
				'value' => function($model){
					return $model->authors;
				}
			],
			
			/* [
				'label' => 'Scope',
				'format' => 'html',
				'value' => function($model){
					return $model->scope->scope_name;
				}
			], */
			'abstract:ntext',
			'keyword',
			[
				'attribute' => 'correction_at',
				'label' => 'Correction Time',
				'format' => 'datetime'
			],
			[
				'label' => 'Status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			],
			[
				'attribute' => 'correction_file',
				'format' => 'raw',
				'value' => function($model){
					return '<a href="'. Url::to(['editing/download', 'attr' => 'correction', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> CORRECTION FILE</a>';
				}
			],
			

        ],
    ]) ?></div>
</div>
