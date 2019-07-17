<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Todo;


/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = 'Pre Evaluation';//$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Submission', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = $model->wfStatus;

if($status == 'pre-evaluate' or $status == 'post-evaluate'){
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
				'attribute' => 'submit_at',
				'label' => 'Submit Time',
				'format' => 'datetime'
			],
			[
				'label' => 'Status',
				'format' => 'html',
				'value' => function($model){
					return $model->wfLabelBack;
				}
			],
			$file,
			

        ],
    ]) ?>

</div></div>
</div>


<?php 
if(($status == 'pre-evaluate' or $status == 'post-evaluate') and Todo::can('journal-managing-editor')){
	?>
	
	
<div class="box">
<div class="box-header">
<h3 class="box-title">Choose an action</h3>

</div>
<div class="box-body">

<div class="row">
<div class="col-md-3"><div class="form-group"><label><input type="radio" <?=$chk_assign?> name="action" value="1" id="select-assign" /> Acccept & Proceed to Payment </label></div></div>
<div class="col-md-2"><div class="form-group"><label><input type="radio" name="action" value="2" id="select-reject" /> Reject </label></div></div>
</div>


</div>
</div>
<?php 
$this->registerJs('
$("#select-reject").click(function(){
	$("#con-assign").slideUp();
	$("#con-reject").slideDown();
});

$("#select-assign").click(function(){
	$("#con-assign").slideDown();
	$("#con-reject").slideUp();
});


');
?>	
	
<div id="con-assign" <?=$dis_assign?>>
	<?=$this->render('_form_assign_associate', [
			'model' => $model,
	]);?>

</div>
<div id="con-reject" style="display:none">
	<?=$this->render('_form_reject', [
			'model' => $reject_model,
	]);?>
</div>


<?php } ?>




