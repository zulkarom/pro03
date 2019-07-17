<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\modules\journal\models\JournalScope;


/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Article */

$this->title = 'Advanced Search';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="padding-top:35px; padding-bottom:15px;">

<div class="container">
<div align="center">
<h3>Advanced Search</h3>
</div>
<br />
<div class="form-group">
		<?php $form = ActiveForm::begin([
		'action' => ['search/advanced-search'],
        'method' => 'get',
    ]); ?>
		<div class="row">
			<div class="col-md-6">

			
			 <?= $form->field($model, 'title', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control', 'placeholder' => 'Search in title'])->label('Title'); ?>

			 
	
			</div>
			<div class="col-md-6">

			 <?= $form->field($model, 'abstract', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control', 'placeholder' => 'Search in abstract'])->label('Abstract'); ?>

			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">

			
			 <?= $form->field($model, 'keyword', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control', 'placeholder' => 'Search in keywords'])->label('Keywords'); ?>

			 
	
			</div>
			<div class="col-md-6">

			 <?= $form->field($model, 'author', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control', 'placeholder' => 'Search in authors'])->label('Authors'); ?>

			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">

			
			 <?= $form->field($model, 'doi_ref', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control', 'placeholder' => 'Search in doi'])->label('DOI'); ?>

			 
	
			</div>
			<div class="col-md-6">

			 <?= $form->field($model, 'scope_id', ['template' => '<div class="row">
            <div class="col-sm-3">{label}:</div>
            <div class="col-sm-9">{input}{error}
            </div>
            </div>']
)->dropDownList(JournalScope::listScopeByJournal(Yii::$app->params['journal_id']), ['prompt' => 'Select Scope' ]
    
)->label('Scope');?>

			</div>
		</div>
		
		<div class="row">
		<div class="col-md-2"></div>
			<div class="col-md-4">

			
			 <?= $form->field($model, 'year_from', ['template' => '<div class="row">
            <div class="col-sm-4">{label}:</div>
            <div class="col-sm-6">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control'])->label('From Year'); ?>

			 
	
			</div>
			<div class="col-md-4">

			 <?= $form->field($model, 'year_to', ['template' => '<div class="row">
            <div class="col-sm-4">{label}:</div>
            <div class="col-sm-6">{input}{error}
            </div>
            </div>']
)->textInput(['class' => 'form-control'])->label('Until Year'); ?>

			</div>
		</div>
		
		
		<div align="center">
		
		 <?= Html::submitButton('<i class="fa fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
		 </div>
		 
		 <?php ActiveForm::end(); ?>
		</div>
		
		
		<br />
		<div class="row">
				<div class="col">
					<h3 class="section_title text-center">SEARCH RESULT</h3>
				</div>
		</div>
		
			<div class="row">
			
			<div class="col-lg-12">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'pager' => [
		'prevPageCssClass'=>'page-item', 
		'nextPageCssClass'=>'page-item',

        'linkOptions' => ['class' => 'page-link'],
		'disabledPageCssClass' => 'page-link',
		'activePageCssClass' => 'page-item active',


		],
		
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'title',
				'format' => 'raw',
				'label' => 'List of Articles',
				'value' => function ($model){
					return $model->title . '<br /><i>'.
					$model->stringAuthors . '</i><br/>' .
					$model->issueInfo . '<br /></i> <a href="'.Url::to($model->linkArticle()).'" target="_blank"><i class="fa fa-file-pdf-o"></i> Full Text</a>'
					;
				}
			]
           
        ],
    ]); ?>
</div>
				
				
			
			</div>
			<br />
		
		
		
		

</div>

</div>