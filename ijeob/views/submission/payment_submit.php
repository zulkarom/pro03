<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Payment Infomation';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




?>



<div class="block-content">

		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center"><?= Html::encode($this->title) ?> </h2>
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
			[
				'attribute' => 'title',
				'label' => 'Manuscript'
			]
            ,
			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			],
			[
				'attribute' => 'invoice_id',
				//'format' => 'currency',
				'label' => 'Payment Amount',
				'value' => function($model){
					return Yii::$app->formatter->currencyCode . ' ' . number_format($model->invoice->invoiceAmount,2);
				}
			],
			[
				'value' => function($model){
					return '<a href="'.Url::to(['transaction/invoice', 'id' => $model->invoice->id]) .'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-download"></i> DOWNLOAD PDF</a>';
				},
				'format' => 'raw',
				'label' => 'Invoice'
			]
        ],
    ]) ?>

	

	<?=$this->render('_payment_form', [
			'model' => $model,

	]);
?>
	

</div>
</div>



</div>