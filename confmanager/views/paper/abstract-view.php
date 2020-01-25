<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

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
  
        ],
    ]) ?>
	
</div>
</div>





<?php $form = ActiveForm::begin(); ?>



<div class="card">

            <div class="card-body">   

<?php 
	
	echo $form->field($model, 'abstract_decide')->radioList($model->abstractOptions, [ 'separator' => '<br />'])->label('Choose One:');


	?>

<div class="form-group">
        
<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>
	
	
</div>
</div>

<?php ActiveForm::end(); ?>

</div>
