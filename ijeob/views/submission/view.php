<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\modules\journal\models\ArticleStatus;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-content">

		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">Manuscript Submission </h2>
				</div>

			</div>
			<br /><div class="article-view">

<style>
table.detail-view th {
    width:15%;
}
</style>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'keyword',
            'abstract:ntext',
            
			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			],
			[
				'attribute' => 'pre_evaluate_at',
				'label' => 'Sumission Time',
				'format' => 'datetime'
			]
            ,
			[
				'attribute' => 'submission_file',
				'format' => 'raw',
				'value' => function($model){
					return '<a href="'. Url::to(['article/download', 'attr' => 'submission', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
				}
			],
        ],
    ]) ?>
	
	

<?php
/* if(in_array($model->getWorkflowStatus()->getId(), ArticleStatus::canWithdraw())){
	echo $this->render('_withdraw_form', [
	'model' => $model
	]);
} */
?>


</div>
			</div>
</div>