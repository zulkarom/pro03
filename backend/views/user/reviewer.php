<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviewers';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card shadow mb-4">

            <div class="card-body"><?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
            'email:email',
			[
				'label' => 'Fields',
				'format' => 'html',
				'value' => function($model){
					$str = '';
					$scopes = $model->userScopes;
					if($scopes){
						foreach($scopes as $scope){
							$str .= $scope->scope->scope_name . '<br />';
						}
					}
					return $str;
				}
			]
            ,

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{update}',
                //'visible' => false,
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('UPDATE',['/journal/user/view', 'id' => $model->id],['class'=>'btn btn-info btn-sm']);
                    }
                ],
            
            ],

        ],
    ]); ?></div>
</div>
