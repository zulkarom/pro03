<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Journals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="journal-index">


    <p>
        <?= Html::a('Create Journal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'journalName',
            'journal_abbr',
            'journal_url:url',

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('<i class="fas fa-pencil-alt fa-sm text-white-50"></i> UPDATE',['journal-update/update/', 'id' => $model->id],['class'=>'d-sm-inline-block btn btn-sm btn-primary shadow-sm']);
                    }
                ],
			]

			]
		]); 
	
	
	?>
	</div>
</div>
</div>
</div>