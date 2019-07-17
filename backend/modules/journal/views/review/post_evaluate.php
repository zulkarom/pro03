<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Todo;


/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = 'Post Evaluation';//$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Review', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = $model->wfStatus;

if($status == 'post-evaluate'){
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
		if($status == 'post-evaluate'){
			$chk_galley = 'checked';
			$dis_galley = '';
		}
		
		
}


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
					return '<a href="'. Url::to(['review/download', 'attr' => 'correction', 'id' => $model->id]) .'" target="_blank"><i class="fa fa-download"></i> FILE</a>';
				}
			],
			

        ],
    ]) ?></div>
</div>


<?php 
if(($status == 'post-evaluate') and Todo::can('journal-managing-editor')){
	?>
	
	

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Choose an action</h6>
            </div>
            <div class="card-body"><div class="row">
<div class="col-md-12"><div class="form-group"><label><input type="radio" name="action" <?=$chk_galley?> value="3" id="select-galley" /> ACCEPT MANUSCRIPT <span class="glyphicon glyphicon-arrow-right"></span>  Send to Galley Proof </label></div></div>


<div class="col-md-12"><div class="form-group"><label><input type="radio" <?=$chk_assign?> name="action" value="1" id="select-assign" /> REVIEW BACK <span class="glyphicon glyphicon-arrow-right"></span> Assign Associate Editor </label></div></div>

</div></div>
</div>

<?php 
$this->registerJs('
$("#select-reject").click(function(){
	$("#con-assign").slideUp();
	$("#con-reject").slideDown();
	$("#con-galley").slideUp();
});

$("#select-assign").click(function(){
	$("#con-assign").slideDown();
	$("#con-reject").slideUp();
	$("#con-galley").slideUp();
});

$("#select-galley").click(function(){
	$("#con-assign").slideUp();
	$("#con-reject").slideUp();
	$("#con-galley").slideDown();
});

');
?>	
	
<div id="con-assign" <?=$dis_assign?>>
	<?=$this->render('_form_assign_associate', [
			'model' => $model_review,
	]);?>

</div>

<div id="con-galley" <?=$dis_galley?>>
	<?=$this->render('_form_galley', [
			'model' => $model,
	]);?>
</div>

<?php } ?>


