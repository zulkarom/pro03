<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
  <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="card shadow mb-4">

            <div class="card-body">
		<div class="role-index">
  
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'attribute' => 'ruleName',
                'label' => Yii::t('rbac-admin', 'Rule Name'),
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
			
            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 13%'],
                'template' => '{view} {update} {delete}',
                //'visible' => false,
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fas fa-edit"></span>',['update', 'id' => $model->name],['class'=>'btn btn-warning btn-sm']);
                    },
					'view' => function ($url, $model) {
                        return Html::a('<span class="fas fa-eye"></span>',['view', 'id' => $model->name],['class'=>'btn btn-success btn-sm']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fas fa-trash"></span>', ['delete-article', 'id' => $model->name], [
							'class' => 'btn btn-danger btn-sm',
							'data' => [
								'confirm' => 'Are you sure you want to delete this manuscript?',
								'method' => 'post',
							],
						]) ;
                    }
                ],
            
            ],

        ],
    ])
    ?>

</div>	
			
			</div>
</div>
