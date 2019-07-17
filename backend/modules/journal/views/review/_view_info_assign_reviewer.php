<?php

use yii\widgets\DetailView;


?>

<div class="card shadow mb-4">

            <div class="card-body"><?= DetailView::widget([
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
				'attribute' => 'pre_evaluate_at',
				'label' => 'Pre Evaluation Time',
				'format' => 'datetime'
			],
			[
				'label' => 'Status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			]
			

        ],
    ]) ?></div>
</div>

