<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\ActiveForm;
use richardfan\widget\JSRegister;

/* @var $this yii\web\View */
/* @var $model backend\modules\conference\models\ConfPaper */

$this->title = $model->pap_title;
$this->params['breadcrumbs'][] = ['label' => 'Conf Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="conf-paper-view">



<div class="card">

            <div class="card-body">    
			<style>
table.detail-view th {
    width:17%;
}
</style>

			
			<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute' => 'user_id',
				'label' => 'Submitted By',
				'value' => function($model){
					return $model->user->fullname;
				}
			],
			[
				'attribute' => 'created_at',
				'label' => 'Submitted Time',
				'format' => 'datetime'
			]
			,
            'pap_title:ntext',
			[
				'label' => 'Authors',
				'format' => 'html',
				'value' => function($model){
					return $model->authorString();
				}
				
			],
            'pap_abstract:ntext',
			'keyword:ntext',
			[
				'attribute' => 'myrole',
				'label' => 'Role Selection',
				'value' => function($model){
					if($model->authorRole){
						return $model->authorRole->fee_name;
					}
					
				}
				
			],
			[
				'attribute' => 'paper_file',
				'label' => 'Uploaded File',
				'format' => 'raw',
				'value' => function($model){
					return Html::a('DOWNLOAD FILE', ['paper/download-file', 'id' => $model->id, 'attr' => 'paper'], ['target' => '_blank']);
				}
			]
  
        ],
    ]) ?></div>
</div>


<?php $form = ActiveForm::begin(); ?>



<div class="card">
<div class="card-body">   

<?php 
	
	echo $form->field($model, 'full_paper_decide')->radioList($model->fullPaperOptions, [ 'separator' => '<br />'])->label('Choose One:');


	?>
</div>
</div>


<div class="card" id="con-invoice">
<div class="card-body">   

<div class="row">
<div class="col-md-3">

<?php 
$local = $model->conference->currency_local;
$int = $model->conference->currency_int;
$curr = [$local => $local, $int=>$int];

if($model->myrole){
	$model->invoice_currency = $model->authorRole->fee_currency;
	$model->invoice_amount = $model->authorRole->fee_amount;
}

echo $form->field($model, "invoice_currency")->dropDownList($curr);
 
 
?>


</div>
</div>

<div class="row">
<div class="col-md-3"><?= $form->field($model, 'invoice_amount'); ?></div>
</div>
<div class="form-group">
<?= Html::submitButton('Accept Full Paper & Issue Invoice', ['class' => 'btn btn-primary', 'name' => 'wfaction', 'value' => 'accept', 'data' => [
                'confirm' => 'Are you sure to accept this paper and issue an invoice?'
            ],
    ])?>

    </div>
	
	
</div>
</div>


<div class="card" id="con-reject" style="display:none">
<div class="card-body">  

<div class="row">
<div class="col-md-6"><?= $form->field($model, 'reject_note')->textarea(['rows' => '3']) ?></div>
</div>
<div class="form-group">
<?= Html::submitButton('Reject Paper', ['class' => 'btn btn-danger', 'name' => 'wfaction', 'value' => 'reject', 'data' => [
                'confirm' => 'Are you sure to reject this paper?'
            ],
    ])?>

    </div>
	
	
</div>
</div>

<?php ActiveForm::end(); ?>

</div>


<?php JSRegister::begin(); ?>
<script>
$("input[name='ConfPaper[full_paper_decide]']").click(function(){
	if($(this).val() == 1){
		$('#con-invoice').slideDown();
		$('#con-reject').slideUp();
	}else if($(this).val() == 0){
		$('#con-invoice').slideUp();
		$('#con-reject').slideDown();
	}
});
</script>
<?php JSRegister::end(); ?>