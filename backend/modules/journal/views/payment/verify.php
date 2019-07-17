<?php


use common\models\Todo;
use yii\widgets\DetailView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = 'Verify Payment';//$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = $model->wfStatus;

?>

<div class="card shadow mb-4">

            <div class="card-body"><div class="application-view">
<style>
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
				'attribute' => 'submission_file',
				'format' => 'raw',
				'value' => function($model){
					return '<a href="'. Url::to(['submission/download', 'attr' => 'submission', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
				}
			],
			

        ],
    ]) ?>

</div></div>
</div>


<?php

echo $this->render('_view_payment', [
			'model' => $model
	]);



echo $this->render('_form_verify', [
			'model' => $model
	]);
?>

