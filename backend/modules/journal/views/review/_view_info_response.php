<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="application-view">

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
				'label' => 'Status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			],
			[

				'label' => 'Review File',
				'format' => 'raw',
				'value' => function($model){
					if($model->review_file){
						return '<a href="'. Url::to(['review/download-review-file', 'attr' => 'review', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';	
					}else{
						return '<a href="'. Url::to(['submission/download', 'attr' => 'review', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
					}
					
				}
			]
			

        ],
    ]) ?>

</div></div>
</div>

