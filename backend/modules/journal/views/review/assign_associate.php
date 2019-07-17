<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Todo;


/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = 'Assign Associate Editor';//$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submission', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = $model->wfStatus;

if($status == 'assign-associate' or $status == 'post-evaluate'){
	$file = [
				'attribute' => 'submission_file',
				'format' => 'raw',
				'value' => function($model){
					return '<a href="'. Url::to(['submission/download', 'attr' => 'submission', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
				}
			];
		$chk_assign= '';$chk_galley= '';
		$dis_assign = 'style="display:none"';
		$dis_galley = 'style="display:none"';
		if($status == 'pre-evaluate'){
			$chk_assign = 'checked';
			$dis_assign = '';
		}
		if($status == 'post-evaluate'){
			$chk_galley = 'checked';
			$dis_galley = '';
		}
		
		
}else if($status == 'assign-reviewer'){
	$file = [
				'attribute' => 'review_file',
				'format' => 'raw',
				'value' => function($model){
					return '<a href="'. Url::to(['submission/download', 'attr' => 'review', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
				}
			];
}


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
				'attribute' => 'submit_at',
				'label' => 'Submit Time',
				'format' => 'datetime'
			],
			[
				'label' => 'Status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabel;
				}
			],
			$file,
			

        ],
    ]) ?>

</div></div>
</div>


<?php 
if(Todo::can('journal-managing-editor')){
	?>
	
	


<div>
	<?=$this->render('_form_assign_associate', [
			'model' => $model,
	]);?>

</div>


<?php } ?>




