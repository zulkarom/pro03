<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\jui\JuiAsset;


/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\Journal */

$this->title = $model->journalIssueName;
$this->params['breadcrumbs'][] = ['label' => 'Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Volume ' . $model->volume . ' Issue ' . $model->issue;
?>
<div class="journal-articles">


<div class="card shadow mb-4">

            <div class="card-body"><?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<?=$form->field($model, 'updated_at')->hiddenInput(['value' => 1])->label(false)?>


<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.article-item',
        'limit' => 100,
        'min' => 0,
        'insertButton' => '.add-article',
        'deleteButton' => '.remove-article',
        'model' => $articles[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'publish_number',
        ],
    ]); ?>
    
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
				<th>#</th>
                <th>Titles</th>
				<th>Article Number</th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php 
		$i = 1;
		foreach ($articles as $indexExpe => $article): ?>
            <tr class="article-item">
				<td>
                    <?=$i?>. 
                </td>
				
				<td>
                    <?=$article->title ?><br />
					<i>Full PDF Paper: <a href="<?=$article->articleUrl ?>" target="_blank"><?=$article->articleUrl ?></a></i><br />
					<i>Article Page: <a href="<?=$article->articleUrlPage ?>" target="_blank"><?=$article->articleUrlPage ?></a></i>
                </td>
            
                <td>
                    <?= $form->field($article, "[{$indexExpe}]publish_number")->label(false) ?>
                </td>



            </tr>
         <?php 
		 $i++;
		 endforeach; ?>
        </tbody>
        
        
    </table>
    
    
    
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save Articles', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?></div>
</div>

