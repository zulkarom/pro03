<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel confmanager\models\ConfRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?=$this->title?></h3>
						</div>
						<div class="panel-body">
			
			
			
			<div class="conf-registration-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'fullname',
				'label' => 'Name',
				'value' => function($model){
					return $model->user->fullname;
				}
				
			],
			[
				'attribute' => 'email',
				'label' => 'Email',
				'value' => function($model){
					return $model->user->email;
				}
				
			],
			
            'reg_at:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div>
</div>
