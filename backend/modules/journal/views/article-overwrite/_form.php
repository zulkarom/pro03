<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;
use backend\modules\journal\models\ArticleStatus;
use backend\modules\journal\models\Journal;
use backend\modules\journal\models\JournalIssue;
use backend\modules\journal\models\Scope;
use backend\modules\journal\models\ReviewForm;
use backend\models\UploadFile;
use common\models\AuthAssignment;
use wbraganca\dynamicform\DynamicFormWidget;
use richardfan\widget\JSRegister;

/* @var $this yii\web\View */
/* @var $model backend\modules\journal\models\ArticleOverwrite */
/* @var $form yii\widgets\ActiveForm */

$model->file_controller = 'article-overwrite';

?>
<?php $form = ActiveForm::begin(['id' => 'dynamic-form']);  ?>
<div class="card shadow mb-4">

            <div class="card-body"><div class="article-overwrite-form">

    
	
	
	 
	    
		
		<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'status')->dropDownList(ArticleStatus::getAllStatusesArray())->label('Select Manuscript Status') ?></div>

<div class="col-md-6"><?= $form->field($model, 'scope_id')->dropDownList(ArrayHelper::map(Scope::find()->all(), 'id', 'scope_name'))->label('Scope') ?>
</div>

</div>
	
	<div class="row">


<div class="col-md-10">

<?php
$userDesc = empty($model->user_id) ? '' : User::findOne($model->user_id)->fullname;
$url = Url::to(['/user/user-list-json']);
echo $form->field($model, 'user_id')->widget(Select2::classname(), [
    'initValueText' => $userDesc, // set the initial display text
    'options' => ['placeholder' => 'Search for a user ...'],
'pluginOptions' => [
    'allowClear' => true,
    'minimumInputLength' => 3,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
])->label('Select a User');

 ?>




</div>

</div>

   

    

   

  

    <?= $form->field($model, 'title')->textarea(['rows' => 3]) ?>
	
	
 <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.author-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-author',
        'deleteButton' => '.remove-author',
        'model' => $authors[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'firstname',
            'lastname',
			'email'
        ],
    ]); ?>
    
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="35%">Fist Name</th>
                <th width="35%">Last Name</th>
				<th width="35%">Email</th>
                <th class="text-center" style="width: 90px;">
                    
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($authors as $indexAu => $author): ?>
            <tr class="author-item">
            
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $author->isNewRecord) {
                            echo Html::activeHiddenInput($author, "[{$indexAu}]id");
                        }
                    ?>
                    <?= $form->field($author, "[{$indexAu}]firstname")->label(false) ?>
                </td>
                
                <td class="vcenter">
          
                    
                     <?=$form->field($author, "[{$indexAu}]lastname")->label(false);

                    ?>

                </td>
				
				<td class="vcenter">
          
                    
                     <?=$form->field($author, "[{$indexAu}]email")->label(false);

                    ?>

                </td>
                
                


                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-author btn btn-default btn-sm"><span class="fas fa-trash"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
        
        <tfoot>
            <tr>
                <td colspan="3">
                <button type="button" class="add-author btn btn-default btn-sm"><span class="fa fa-plus"></span> Add Author</button>
                
                </td>
                <td>
                
                
                </td>
            </tr>
        </tfoot>
        
    </table>
    
    
    
    <?php DynamicFormWidget::end(); ?>
	
	
	

    <?= $form->field($model, 'keyword')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'abstract')->textarea(['rows' => 3]) ?>

<?php 
if($model->id){
	echo UploadFile::fileInput($model, 'submission');
}
?>

<?php 
if($model->id){
	echo UploadFile::fileInput($model, 'payment');
}
?>  


    <?= $form->field($model, 'payment_note')->textarea(['rows' => 2]) ?>

 <?= $form->field($model, 'associate_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-associate-editor'),'user.id', 'user.fullname')
    ) ?>
	
	<?php 
if($model->id){
	echo UploadFile::fileInput($model, 'review');
}
?>


    <?= $form->field($model, 'pre_evaluate_note')->textarea(['rows' => 2]) ?>


    <?= $form->field($model, 'response_note')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'response_option')->dropDownList(ReviewForm::reviewOptions()) ?>


    <?= $form->field($model, 'correction_note')->textarea(['rows' => 2]) ?>

	<?php 
if($model->id){
	echo UploadFile::fileInput($model, 'correction');
}
?>

 <?= $form->field($model, 'associate_editor')->dropDownList(
        ArrayHelper::map(AuthAssignment::getUsersByAssignment('journal-assistant-editor'),'user.id', 'user.fullname')
    ) ?>
	

    <?= $form->field($model, 'camera_ready_note')->textarea(['rows' => 2]) ?>
	
		<?php 
if($model->id){
	echo UploadFile::fileInput($model, 'cameraready');
}
?>

 
<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'withdraw_note')->textarea(['rows' => 2]) ?></div>

<div class="col-md-6"><?= $form->field($model, 'reject_note')->textarea(['rows' => 2]) ?>
</div>

</div>



 <?= $form->field($model, 'doi_ref') ?>
   
<div class="row">
<div class="col-md-6"><?= $form->field($model, 'page_from') ?></div>

<div class="col-md-6"><?= $form->field($model, 'page_to') ?>
</div>

</div>

<div class="row">
<div class="col-md-6"> <?= $form->field($model, 'journal_id')->dropDownList(ArrayHelper::map(Journal::find()->all(), 'id', 'journal_abbr'), ['prompt' => 'Please Select' ])->label('Journal')?></div>

<div class="col-md-6">
</div>

</div>

<?=$form->field($model, 'journal_issue_id')->dropDownList(
        ArrayHelper::map(JournalIssue::listCompilingJournal($model->journal_id),'id', 'journalIssueName'), ['prompt' => 'Please Select' ]
    )->label('Choose Journal Volume & Issue');
?>


    

    

</div></div>
</div>

<div class="row">
<div class="col-md-6"><div class="form-group">
        <?= Html::submitButton('<span class="fas fa-save"></span> SAVE DATA', ['class' => 'btn btn-primary']) ?>
    </div></div>

<div class="col-md-6" align="right">
<?=Html::a('<span class="fas fa-trash"></span>', ['delete-article', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this manuscript?',
                'method' => 'post',
            ],
        ])?>
</div>

</div>


<?php ActiveForm::end(); ?>



<?php JSRegister::begin(); ?>
<script>
$("#articleoverwrite-journal_id").change(function(){
	putOption();
});

function putOption(){
	var target_id =  'articleoverwrite-journal_issue_id';
	var journal =  $('#articleoverwrite-journal_id').val();
	$('#' + target_id).html('<option>Loading...</option>');
	var url = '<?=Url::to(['publish/list-issues', 'journal' => '']) ?>' + journal ;
	
	console.log(url)
	
	$.ajax({url:  url, success: function(result){
	var str = '';
	if(result){
		var reviewer = JSON.parse(result);
		console.log(reviewer);
		
		for(var id in reviewer) {
		   str += '<option value=\"' + id +  '\">' + reviewer[id] + '</option>';
		}

	}
		
	$('#' + target_id).html(str);
	
	
    }});
	
}
</script>
<?php JSRegister::end(); ?>